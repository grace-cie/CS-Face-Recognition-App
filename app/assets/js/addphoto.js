
$(document).on('submit', '#uploadForm', function (e) {
     e.preventDefault(); // Prevent the form from submitting normally

     var formData = new FormData(this); // Create a FormData object with the form data

     $.ajax({
          url: $(this).attr('action'), // The form action URL
          type: $(this).attr('method'), // The form method (POST)
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
               // Handle the success response
               console.log(response);
          },
          error: function (xhr, status, error) {
               // Handle the error response
               console.log(error);
          }
     });
});