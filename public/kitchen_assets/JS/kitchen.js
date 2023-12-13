$(document).ready(function() {
    $(document).on("click", ".done-button", function() {
      // Get the order ID from the data attribute
      var orderId = $(this).data("order-id");
  
      // Hide and remove the modal
      $("#exampleModal" + orderId).modal("hide");
      $("#exampleModal" + orderId).on("hidden.bs.modal", function(e) {
        $(this).remove();
      });
  
      // Hide and remove the card
      $(this).closest(".card").hide();
      $(this).closest(".card").remove();
    });
  });


