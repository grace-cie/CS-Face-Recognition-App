function refreshSync(event) {
     event.preventDefault();
     $.ajax({
          url: 'lib/handlers/refreshlist.php', // The form action URL
          type: 'POST', // The form method (POST)
          async: false,
          success: function (response) {
               // Handle the success response
               console.log(response);
               setTimeout(function () {
                    location.reload();
               });
          },
          error: function (xhr, status, error) {
               // Handle the error response
               console.log(error);
          }
     });
}