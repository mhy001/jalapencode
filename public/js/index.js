
$(document).ready(function() {

$.getJSON("products", function(data) {
  if (data.items) {
    for (var key in data.items) {
      var item = data.items[key];
      var card = "<div class='card rounded expand'>"
                  + "<a class='pointer_hand' href='product?id=" + item.id + "'>"
                    + "<img class='card-img-top' src='" + item.imageURL + "' alt='" + item.name + "'>"
                    + "<h4 class='card-title'>" + item.name + "</h4>"
                  + "</a>"
                  + "<div class='card-body'>"
                    + "<p class=''>" + item.description + "</p>"
                    + "<div>"
                      + "<span class='item_heatRating'>" + item.heatRating + "</span>"
                      + "<span class='text-danger float-right'>$" + item.price + "</span>"
                    + "</div>"
                  + "</div>"
                  + "<button class='btn btn-light'>Add to cart</button>"
                  + "<div class='d-none'>"
                    + "<span class='item_quantity'>" + item.quantity + "</span>"
                    + "<span class='item_reviewRating'>" + item.reviewRating + "</span>"
                  + "</div>"
                + "</div>";
      $(".product-grid").append(card);
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

});
