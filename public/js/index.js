
$(document).ready(function() {

$.getJSON("products", function(data) {
  if (data.items) {
    for (var key in data.items) {
      var item = data.items[key];
      var card = "<div class='card rounded expand'>"
                + "<img class='card-img-top' src='" + item.url + "' alt='" + item.name + "'>"
                  + "<div class='card-body' title='" + item.name + "'>"
                    + "<h4 class='card-title'>" + item.name + "</h4>"
                    + "<p class='card-text'>" + item.description + "</p>"
                    + "<div class=''>"
                      + "<span class='item-rating'>" + item.heatRating + "</span>"
                      + "<span class='text-danger float-right'>$" + item.price + "</span>"
                    + "</div>"
                  + "</div>"
                  + "<button class='btn'>Action</button>"
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
