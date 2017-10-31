/*
 * Product class
 */
function Product(product) {
  // Attributes from database
  this.id = String(product.id);
  this.name = String(product.product_name);
  this.url = String(product.image);
  this.description = String(product.description);
  this.heat = parseInt(product.heat_id);
  this.review = String(product.review);
  this.price = parseFloat(product.price);
  this.quantity = parseInt(product.quantity);
  this.category = parseInt(product.cat_id);

  // Calculated attributes
  this.maxQuantity = parseInt(product.quantity);
}
Product.prototype.deplete = function(quantity) {
  if (quantity > this.quantity) {
    console.log("Buying too many: " + this.id);
    return 0;
  }
  this.quantity -= quantity;
  return 1;
}
Product.prototype.restock = function(quantity) {
  if (quantity+this.quantity > maxQuantity) {
    console.log("Restocking too many: " + this.id);
    return 0;
  }
  this.quantity += quantity;
  return 1;
}

/*
 * Cart class
 */
function Cart() {
  this.items = new Map(); // {productID: count in cart}
  this.count = 0; // total count of items in cart
  this.subtotal = 0.00;
}
Cart.prototype.add = function(product, quantity=1) {
  var cart = this.items;
  var id = product.id;

  if (cart.has(id) && product.deplete(quantity)) {
    cart.set(id, cart.get(id)+quantity);
    this.count += quantity;
    this.subtotal += quantity * product.price;
  } else if (product.deplete(quantity)) {
    cart.set(id, quantity);
    this.count += quantity;
    this.subtotal += quantity * product.price;
  } else {
    console.log("Failed to add " + id + " to cart");
    return 0;
  }
  return 1;
}
Cart.prototype.remove = function(product, quantity=1) {
  var cart = this.items;
  var id = product.id;

  if(cart.has(id) && product.restock(quantity)) {
    cart.set(id, cart.get(id)-quantity);
    this.count -= quantity;
    this.subtotal -= quantity * product.price;
    if (!cart.get(id)) {
      cart.delete(id);
    }
    return 1;
  } else {
    console.log("Failed to remove " + id + " from cart");
  }
  return 0;
}
Cart.prototype.restore = function(product, quantity) {
  var cart = this.items;

  cart.set(product.id, quantity);
  this.count += quantity;
  this.subtotal += quantity * product.price;
  return 1;
}

/*
 * Global variables...meh
 */
// Really global
var products = new Map(); // {productID: product}
var cart = new Cart(); // Customer cart

// Global in context of home page
var filters = new function() {
  this.count = 0;
  this.search = "";
  this.filters = new Map();
  this.filters.set("heat", new Set());
  this.filters.set("price", new Set());

  this.add = function(type, value) {
    this.count++;
    this.filters.get(type).add(parseInt(value));
  }
  this.remove = function(type, value) {
    this.count--;
    this.filters.get(type).delete(parseInt(value));
  }
  this.forEach = function(callback, thisArg) {
    this.filters.forEach(callback, thisArg);
  }
}

/*
 * PAGE SETUP
 */
$(document).ready(function() {
  // navbar
  if ($("#navbar").length) {
    setup_search();
  } else {
    console.log("NAVBAR MISSING!!! WHAT HAPPENED?!");
    return;
  }

  // home page
  if ($("#productGrid").length) {
    resolveSearchString();
    getProducts(populateProductGrid);
    setup_addCart();

    if ($("#filter").length) {
      setup_filter();
    }
  } else {
    getProducts();
  }

  // cart page
  if ($("#cartList").length) {
    getCart(populateCartList);
  } else { // get cart for count in navbar
    getCart();
  }

  // product page
  if ($("#productPage").length) {
    setup_addCart2();
  }
});

/*
 * SERVER CALLS
 */
function getGeneric(route, requestData, callback) {
  $.getJSON(route, requestData, function(data) {
    callback && callback(data);
  })
  .fail(function(jqXHR, textStatus, error) {
    var message = "<div class='message-text'><p class='font-weight-bold'>Looks like something went wrong!</p>"
                + "<p>Try refeshing.</p></div>";
    $(".message-text").remove();
    $(".message").append(message);
    $(".loader").remove();
  });
}

function getProducts(callback) { // get all products
  getGeneric("getProducts", null, function(data) {
    if (data) {
      if (data.length) {
        for (var key in data) {
          var product = new Product(data[key]);

          products.set(product.id, product);
          callback && callback(product); // UI update for products
        }
      } else {
        $(".message").append("<span>0 items found</span>");
      }
      $(".loader").remove();
    }
  });
}

function getProduct(callback) { // get single product for product page
  getGeneric("getProduct", null, function(data) {
    if (data) {
      if (data.length) {
        for (var key in data) {
          var product = new Product(data[key]);

          products.set(product.id, product);
          callback && callback(product); // UI update for products
        }
      } else {
        $(".message").append("<span>Item " + product.id +" found</span>");
      }
      $(".loader").remove();
    }
  });
}

function getCart(callback) { // get customer cart
  getGeneric("getCart", null, function(data) {
    if (data) {
      for (var key in data) {
        var item = data[key];

        cart.restore(new Product(item.product), parseInt(item.count));
        callback && callback(item); // UI update for cart items
      }
      updateCartButton();
      showCartButtonCount();
      showCartSubtotal();
      $(".loader").remove();
    }
  });
}

function postCart(productID, quantity) { // update customer cart content
  $.post("postCart", {"id": productID, "quantity": quantity});
}

/*
 * NAVBAR
 */
function setup_search() {
  $("#searchText").keyup(function(e) {
    if (e.keyCode == 13) { // enter key
      if (!$("#searchString").length || $("#searchString").val().localeCompare($("#searchText").val())) {
        var newURL = location.origin + "/?" + $("#searchText").val();
        location.replace(newURL);
      }
    } else {
      toggleSearchClearImage();
    }
  });

  $("#searchClear").click(function() {
    $("#searchText").val("");
    $(this).addClass("invisible");

    if ($("#productGrid").length) {
      history.replaceState({}, "", location.origin);
      filters.search = "";
      $("#searchString").val("");
      products.forEach(function(product, key, map) {
        applyFilters(product);
      });
    }
  });
}

function updateCartButton() { // updates the cart button number
  if (cart.count < 10) {
    $("#cartButtonCount").css('left', 23);
  } else if (cart.count > 99) {
    $("#cartButtonCount").css('left', '');
  } else {
    $("#cartButtonCount").css('left', 18);
  }

  $("#cartButtonCount").text(cart.count);
}

function showCartButtonCount() {
  $("#cartButtonCount").toggleClass("d-none");
}

function toggleSearchClearImage() {
  if ($("#searchText").val()) {
    $("#searchClear").removeClass("invisible");
  } else {
    $("#searchClear").addClass("invisible");
  }
}

/*
 * HOME PAGE
 */
function setup_addCart() {
  $("#productGrid").on("click", ".btn-cart-add", function() {
    var itemID = this.parentElement.id;
    var product = products.get(itemID);

    if (cart.add(product)) {
      disableProductCard(product);
      updateCartButton();
      postCart(product.id, 1);
    }
  });
}

function setup_filter() {
  $("#filterButton").click(function() {
    $("#filterMenu").toggleClass("d-none");
    $("#filterMenu").toggleClass("d-flex");
    $("#filterMenu").toggleClass("flex-column");
  });

  $(".filter-item > input").change(function() {
    if (this.checked) {
      filters.add(this.name, this.value);
    } else {
      filters.remove(this.name, this.value);
    }
    products.forEach(function(product, key, map) {
      applyFilters(product);
    });
  });
}

function resolveSearchString() { // show search string in search box
  var str = $("#searchString").val();
  if (str) {
    $("#searchText").val(str);
    filters.search = str.toLowerCase();
    toggleSearchClearImage();
  }
}

function applyFilters(product) { // apply search & filter to product card
  var show = true;

  if (filters.search) {
    show = product.name.toLowerCase().includes(filters.search);
  }

  if (filters.count) {
    filters.forEach(function(filter, key, map) {
      if (filter.size) {
        show &= filter.has(this[key]);
      }
    }, product);
  }

  if (show) {
    $("#"+product.id).removeClass("d-none");
  } else {
    $("#"+product.id).addClass("d-none");
  }
}

function populateProductGrid(product) { // create product card
  var heat = "";
  for (i = 0; i < product.heat; i++) {
    heat += "<svg class='fire' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'>"
            + "<path d='M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67zM11.71 19c-1.78 0-3.22-1.4-3.22-3.14 0-1.62 1.05-2.76 2.81-3.12 1.77-.36 3.6-1.21 4.62-2.58.39 1.29.59 2.65.59 4.04 0 2.65-2.15 4.8-4.8 4.8z'/>"
            + "<path d='M0 0h24v24H0z' fill='none'/>"
          + "</svg>";
  }
  var card = "<div id='" + product.id + "' class='PG-card card rounded expand d-none'>"
              //+ "<div id='overlay_" + product.id + "' class='PG-card-overlay'> </div>"
              + "<a class='pointer-hand' href='product?" + product.id + "'>"
                + "<img class='card-img-top PG-card-image' src='" + product.url + "' alt='" + product.name + "'>"
                + "<h4 class='card-title ml-3'>" + product.name + "</h4>"
              + "</a>"
              + "<div class='card-body'>"
                + "<p class='text-preview' title='" + product.description + "'>" + product.description + "<span>...</span>" + "</p>"
                + "<div>"
                  + "<span class=''>" + heat + "</span>"
                  + "<span class='text-danger float-right'>$" + product.price + "</span>"
                + "</div>"
              + "</div>"
              + "<button class='btn-cart-add btn btn-warning text-dark m-2'>Add to cart</button>"
            + "</div>";
  $("#productGrid").append(card);
  disableProductCard(product);
  applyFilters(product);
}

function disableProductCard(product) { // product out of stock
  if (product.quantity <= 0) {
    $("#"+product.id+"> .btn-cart-add").prop("disabled", true);
  } else {
    $("#"+product.id+"> .btn-cart-add").prop("disabled", false);
  }
}

/*
 * CART PAGE
 */
function populateCartList(item) { // create cart card
  var product = new Product(item.product);
  var card = "<tr id='" + product.id + "' class='border border-secondary border-left-0 border-right-0'>"
              + "<td>"
                + "<a class='pointer-hand' href='product?" + product.id + "'>"
                  + "<img class='cart-image ml-3' src='" + product.url + "' alt='" + product.name + "'>"
                  + "<span class='ml-5 h4'>" + product.name + "</span>"
                + "</a>"
              + "</td>"
              + "<td>"

              + "</td>"
              + "<td>"
                + "<span class='text-danger h5'>$" + product.price.toFixed(2) + "</span>"
              + "</td>"
              + "<td>"
                + "<span class='h5'>" + item.count + "</span>"
              + "</td>"
            + "</tr>"

  $("#cartList").append(card);
}

function showCartSubtotal() {
  $("#subtotalValue").text("$"+cart.subtotal.toFixed(2));
  $("#subtotal").removeClass("d-none");
}

/*
 * PRODUCT PAGE
 */
function setup_addCart2() {
  $(".btn-cart-add").click(function() {
    var itemID = $("#id").val();
    var product = products.get(itemID);

    if (cart.add(product)) {
      updateCartButton();
      updatePageQuantity(1);
      postCart(product.id, 1);
    }
  });
}

function updatePageQuantity(quantityChange) {
  var quantity = parseInt($("#productQuantity").text()) - quantityChange;

  if (quantity <= 0) {
    $(".btn-cart-add").prop("disabled", true);
  } else {
    $(".btn-cart-add").prop("disabled", false);
  }
  $("#productQuantity").text(quantity);
}
