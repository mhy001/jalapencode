// Global variables....meh
// TODO: implement checkoutBtn functions
var products = new Map();
var cart = new Map();
var cartSubtotal = 0.00;

$(document).ready(function() {
/*
 * Event-binding & DOM set-up
 */
// navbar.html entry
if ($("#cartList").length) {
  // TODO: restore cart from server/cookie
  $("#cartList").on("click", ".cart-increment", function(e) {
    var itemID = this.id.split("_")[1];
    if (cartIncrement(itemID)) {
      updateCartUI(itemID);
    }
    e.stopPropagation();
  });
  $("#cartList").on("click", ".cart-decrement", function(e) {
    var itemID = this.id.split("_")[1];
    if (cartDecrement(itemID)) {
      updateCartUI(itemID);
    }
    e.stopPropagation();
  });
} else {
  console.log("NAVBAR MISSING!!! WHAT HAPPENED?!");
  return;
}

// index.html entry
if ($(".product-grid").length) {
  $("#mainContainer").append("<div class='loader'>Loading...</div>");

  getProductList();
  $(".product-grid").on("click", ".btn-cart-add", function() {
    var itemID = this.parentElement.id;
    if (cartIncrement(itemID)) {
      updateCartUI(itemID);
    }
  });
}


/*
 * non-UI logic
 */
/* cart */
// TODO: add server & cookie calls
function cartDecrement(itemID, quantity=1) {
  var cartCount = cart.get(itemID);
  if (!cartCount || quantity > cartCount) {
    console.log("Removing too many " + itemID);
    return 0;
  }
  var item = products.get(itemID);
  if (item.quantity+quantity > item.maxQuantity) {
    console.log(itemID + " inventory count maximum reached!");
    return 0;
  }

  item.quantity += quantity;

  if (cartCount - quantity) {
    cart.set(itemID, cartCount - quantity);
  } else {
    cart.delete(itemID);
  }

  cartSubtotal -= item.price * quantity;

  return 1;
}

function cartIncrement(itemID, quantity=1) {
  var item = products.get(itemID);
  if (item.quantity-quantity < 0) {
    console.log("You're buying too many " + itemID + "!");
    alert("You're buying too many " + item.name + "!");
    return 0;
  }

  item.quantity -= quantity;

  var newQuantity = quantity;
  if (cart.has(itemID)) {
    newQuantity = cart.get(itemID) + quantity;
  }
  cart.set(itemID, newQuantity);

  cartSubtotal += item.price * quantity;

  return 1;
}


/*
 * manipulates index.html
 */
 /* product grid */
function getProductList() {
  $.getJSON("products", function(data) {
    if (data.items) {
      for (var key in data.items) {
        var item = data.items[key];
        var card = "<div id='" + item.id + "' class='card rounded expand'>"
                    + "<a class='pointer-hand' href='product?id=" + item.id + "'>"
                      + "<img class='card-img-top' src='" + item.imageURL + "' alt='" + item.name + "'>"
                      + "<h4 class='card-title ml-3'>" + item.name + "</h4>"
                    + "</a>"
                    + "<div class='card-body'>"
                      + "<p class=''>" + item.id + " " + item.description + "</p>"
                      + "<div>"
                        + "<span class=''>" + item.heatRating + "</span>"
                        + "<span class='text-danger float-right'>$" + item.price + "</span>"
                      + "</div>"
                    + "</div>"
                    + "<button class='btn-cart-add btn btn-secondary text-dark'>Add to cart</button>"
                  + "</div>";
        $(".product-grid").append(card);

        item.maxQuantity = item.quantity;
        products.set(String(item.id), item);
        if (item.quantity <= 0) {
          $("#"+item.id).hide(); // TODO: maybe overlay an out-of-stock instead
        }
      }
    }
    $(".loader").remove();
  })
  .fail(function(jqXHR, textStatus, error) {
    var message = "<p class='font-weight-bold'>Looks like something went wrong!</p>"
                + "<p>Try refeshing.</p>";
    $(".message").append(message);
    $(".loader").remove();
  });
}


/*
 * manipulates navbar.html
 */

function updateCartUI(itemID) {
  _updateCartDropdown();
  _updateCartCard(itemID);
  _updateSubtotalUI();
}

function _updateCartDropdown() {
  if (cart.size) {
    if ($("#cartDivider").hasClass("d-none")) {
      _displayCartDefault(false);
    }
  } else {
    _displayCartDefault(true);
  }
}

function _displayCartDefault(showOrHide) {
  $("#emptyCart").toggleClass("d-none", !showOrHide);
  $("#cartDivider").toggleClass("d-none", showOrHide);
  $("#cartBottom").toggleClass("d-none", showOrHide);
}

function _updateCartCard(itemID) {
  var item = products.get(itemID);
  var quantity = cart.get(itemID);

  if ($("#cartCount_"+itemID).length) {
    if (quantity) {
      $("#cartCount_"+itemID).text(quantity);

      if (item.quantity <= 0) {
        $("#cartIncBtn_"+itemID).prop("disabled", true);
      } else {
        $("#cartIncBtn_"+itemID).prop("disabled", false);
      }
    } else {
      $("#cartItem_"+itemID).remove();
    }
  } else {
    _addCartCard(itemID);
  }
}

function _addCartCard(itemID) {
  var item = products.get(itemID);
  var card = "<div id='cartItem_" + item.id + "' class='dropdown-item border pl-1 pr-2 d-flex flex-row align-items-center'>"
              + "<img class='cart-thumbnail img-thumbnail' src='" + item.imageURL + "'>"
              + "<span class='pl-2 mr-auto'>" + item.name + "</span>"
              + "<span id='cartCount_" + item.id + "'>" + cart.get(itemID) + "</span>"
              + "<div class='d-flex flex-column ml-2'>"
                + "<button id='cartIncBtn_" + item.id + "' class='cart-increment btn btn-xs-custom btn-secondary text-dark rounded-circle'>+</button>"
                + "<button id='cartDecBtn_" + item.id + "' class='cart-decrement btn btn-xs-custom btn-secondary text-dark rounded-circle'>-</button>"
              + "</div>"
            + "</div>";
  $("#cartList").prepend(card);
}

function _updateSubtotalUI() {
  $("#cartSubtotal").text(cartSubtotal.toFixed(2));
}

});
