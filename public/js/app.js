/*
 * Product class
 */
function Product(product) {
  this.id = String(product.id);
  this.name = String(product.name);
  this.url = String(product.imageURL);
  this.description = String(product.description);
  this.heat = String(product.heatRating);
  this.review = String(product.reviewRating);
  this.price = parseFloat(product.price);
  this.quantity = parseInt(product.quantity);
  this.category = parseInt(product.category);
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
}
Cart.prototype.add = function(product, quantity=1) {
  var cart = this.items;
  var id = product.id;

  if (cart.has(id) && product.deplete(quantity)) {
    cart.set(id, cart.get(id)+quantity);
    this.count += quantity;
  } else if (product.deplete(quantity)) {
    cart.set(id, quantity);
    this.count += quantity;
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
  return 1;
}

// Global variables....meh
var products = new Map(); // {productID: product}
var cart = new Cart(); // Customer cart

/*
 * PAGE SET-UP
 */
$(document).ready(function() {
  // navbar.html
  if ($("#navbar").length) {
    getCart(populateCartList);
  } else {
    console.log("NAVBAR MISSING!!! WHAT HAPPENED?!");
    return;
  }

  // index.html
  if ($("#productGrid").length) {
    getProducts(populateProductGrid);

    $("#productGrid").on("click", ".btn-cart-add", function() {
      var itemID = this.parentElement.id;
      var product = products.get(itemID);

      if (cart.add(product)) {
        toggleProductCard(product);
        updateCartButton();
        postCart(product.id, 1);
      }
    });
  }

  // cart.html
  if ($("#cartList").length) {
  }
});

/*
 * SERVER CALLS
 */
function getGeneric(route, callback) {
  $.getJSON(route, function(data) {
    callback && callback(data);
  })
  .fail(function(jqXHR, textStatus, error) {
    var message = "<p class='font-weight-bold'>Looks like something went wrong!</p>"
                + "<p>Try refeshing.</p>";
    $(".message").append(message);
    $(".loader").remove();
  });
}

function getProducts(callback) {
  getGeneric("getProducts", function(data) {
    if (data) {
      for (var key in data) {
        var product = new Product(data[key]);

        products.set(product.id, product);
        callback && callback(product); // UI update for products
      }
      $(".loader").remove();
    }
  });
}

function getCart(callback) {
  getGeneric("getCart", function(data) {
    if (data) {
      for (var key in data) {
        var item = data[key];

        cart.restore(new Product(item.product), parseInt(item.count));
        callback && callback(item); // UI update for cart items
      }
      updateCartButton();
      showCartButton();
      $(".loader").remove();
    }
  });
}

function postCart(productID, quantity) {
  $.post("postCart", {"id": productID, "quantity": quantity});
/*
  var currentCart = JSON.stringify([...(cart.items)]);
  $.post("postCart", {"cart": currentCart});
*/
}

/*
 * NAVBAR.HTML
 */
function updateCartButton() {
  $("#cartButtonCount > span:first").text(cart.count);
}

function showCartButton() {
  $("#cartButton").toggleClass("d-flex");
  $("#cartButton").toggleClass("d-none");
}

/*
 * INDEX.HTML
 */
function populateProductGrid(product) {
  var heat = "";
  for (i = 0; i < product.heat; i++) {
    heat += "<svg class='fire' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'>"
            + "<path d='M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8C20 8.61 17.41 3.8 13.5.67zM11.71 19c-1.78 0-3.22-1.4-3.22-3.14 0-1.62 1.05-2.76 2.81-3.12 1.77-.36 3.6-1.21 4.62-2.58.39 1.29.59 2.65.59 4.04 0 2.65-2.15 4.8-4.8 4.8z'/>"
            + "<path d='M0 0h24v24H0z' fill='none'/>"
          + "</svg>";
  }
  var card = "<div id='" + product.id + "' class='card rounded expand'>"
              + "<a class='pointer-hand' href='product?" + product.id + "'>"
                + "<img class='card-img-top' src='" + product.url + "' alt='" + product.name + "'>"
                + "<h4 class='card-title ml-3'>" + product.name + "</h4>"
              + "</a>"
              + "<div class='card-body'>"
                + "<p class=''>" + product.description + "</p>"
                + "<div>"
                  + "<span class=''>" + heat + "</span>"
                  + "<span class='text-danger float-right'>$" + product.price + "</span>"
                + "</div>"
              + "</div>"
              + "<button class='btn-cart-add btn btn-warning text-dark m-2'>Add to cart</button>"
            + "</div>";
  $("#productGrid").append(card);

  toggleProductCard(product);
}

function toggleProductCard(product) {
  if (product.quantity <= 0) {
    $("#"+product.id).hide(); // TODO: maybe overlay an out-of-stock instead
  } else {
    $("#"+product.id).show();
  }
}

/*
 * CART.HTML
 */
function populateCartList(item) {
  var product = item.product;
  var card = "<div id='" + product.id + "' class='d-flex flex-row'>"
              + "<img class='' src='" + product.imageURL + "' alt='" + product.name + "'>"
              + "<span class=''> Name: " + product.name + "</span>"
              + "<span class=''> Count: " + item.count + "</span>"
            + "</div>";

  $("#cartList").append(card);
}
