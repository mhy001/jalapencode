// Global variables....meh
var products = new Map();
var cart = new Map();

$(document).ready(function() {
// navbar.html entry
if ($("#cart-list").length) {
  if (cart.size) {
    // TODO: re-add cart from server/cookie
  }
  $("#cart-list").on("click", ".cartIncrement", function(e) {
    cartIncrement(this.id.split("_")[1]);
    e.stopPropagation();
  });
  $("#cart-list").on("click", ".cartDecrement", function(e) {
    cartDecrement(this.id.split("_")[1]);
    e.stopPropagation();
  });
} else {
  console.log("NAVBAR MISSING!!! WHAT HAPPENED?!");
  return;
}

// index.html entry
if ($(".product-grid").length) {
  $("#main-container").append("<div class='loader'>Loading...</div>");

  getProductList();
  $(".product-grid").on("click", ".cartAddBtn", function() {
    addToCart(this.parentElement.id);
  });
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
                    + "<a class='pointer_hand' href='product?id=" + item.id + "'>"
                      + "<img class='card-img-top' src='" + item.imageURL + "' alt='" + item.name + "'>"
                      + "<h4 class='card-title ml-3'>" + item.name + "</h4>"
                    + "</a>"
                    + "<div class='card-body'>"
                      + "<p class=''>" + item.id + " " + item.description + "</p>"
                      + "<div>"
                        + "<span class='item_heatRating'>" + item.heatRating + "</span>"
                        + "<span class='text-danger float-right'>$" + item.price + "</span>"
                      + "</div>"
                    + "</div>"
                    + "<button class='cartAddBtn btn btn-secondary text-dark'>Add to cart</button>"
                  + "</div>";
        $(".product-grid").append(card);

        item.maxQuantity = item.quantity;
        products.set(String(item.id), item);
        if (item.quantity <= 0) {
          $("#"+item.id).hide();
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

function addToCart(itemID) {
  var item = products.get(itemID);

  if (cartIncrement(itemID)) {
    if (item.quantity <= 0) {
      $("#"+itemID).hide();
    }
  }
}

/*
 * manipulates navbar.html
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
  $("#cartIncBtn_"+itemID).prop("disabled", false);

  _updateSubtotal(item.price * -quantity);

  var updatedQuantity = cartCount - quantity;
  _updateCart(itemID, updatedQuantity);

  item.quantity += quantity;

  if (updatedQuantity == 0) {
    $("#cartItem_"+itemID).remove();
    cart.delete(itemID);
    if (cart.size == 0) {
      _displayCartDefault(true);
    }
  }
}

function cartIncrement(itemID, quantity=1) {
  var item = products.get(itemID);
  if (item.quantity-quantity < 0) {
    console.log("You're buying too many " + itemID + "!");
    return 0;
  }
  _updateSubtotal(item.price * quantity);

  var updatedQuantity = quantity;
  if (cart.has(itemID)) {
    updatedQuantity = cart.get(itemID) + quantity;
  } else {
    if ($("#cartDivider").hasClass("d-none")) {
      _displayCartDefault(false);
    }
    _addCartCard(item);
  }
  _updateCart(itemID, updatedQuantity);

  item.quantity -= quantity;
  if (item.quantity <= 0) {
    $("#cartIncBtn_"+itemID).prop("disabled", true);
  }

  return 1;
}

function _displayCartDefault(showOrHide) {
  // Never call directly, use cartIncrement or cartDecrement
  $("#emptyCart").toggleClass("d-none", !showOrHide);
  $("#cartDivider").toggleClass("d-none", showOrHide);
  $("#cartBottom").toggleClass("d-none", showOrHide);
}

function _addCartCard(item) {
  // Never call directly, use cartIncrement
  var card = "<div id='cartItem_" + item.id + "' class='dropdown-item border pl-1 pr-2 d-flex flex-row align-items-center'>"
              + "<img class='cartThumbnail img-thumbnail' src='" + item.imageURL + "'>"
              + "<span class='pl-2 mr-auto'>" + item.name + "</span>"
              + "<span id='cardCount_" + item.id + "'>" + 0 + "</span>"
              + "<div class='d-flex flex-column ml-2'>"
                + "<button id='cartIncBtn_" + item.id + "' class='cartIncrement btn btn-xs-custom btn-secondary text-dark rounded-circle'>+</button>"
                + "<button id='cartDecBtn_" + item.id + "' class='cartDecrement btn btn-xs-custom btn-secondary text-dark rounded-circle'>-</button>"
              + "</div>"
            + "</div>";
  $("#cart-list").prepend(card);
}

function _updateCart(itemID, quantity) {
  // Never call directly, use cartIncrement or cartDecrement
  var item = products.get(itemID);

  cart.set(itemID, quantity);
  $("#cardCount_"+itemID).text(quantity);
}

function _updateSubtotal(amount) {
  // Never call directly, use cartIncrement or cartDecrement
  var subtotal = parseFloat($("#cart-subtotal").text()) + amount;
  $("#cart-subtotal").text(subtotal.toFixed(2));
}

});
