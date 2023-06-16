document.addEventListener('DOMContentLoaded', function () {
     const ctx = document.getElementById('salesChart').getContext('2d');
     new Chart(ctx, {
          type: 'line',
          data: {
               labels: ['7am', '8am', '9am', '10am', '11am', '12am'],
               datasets: [{
                    label: 'Sales',
                    data: [250, 400, 200, 450, 300, 350],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
               }]
          },
          options: {
               responsive: true,
               plugins: {
                    title: {
                         display: true,
                         text: 'Chart.js Line Chart - Cubic interpolation mode'
                    },
               },
               interaction: {
                    intersect: false,
               },
               scales: {
                    x: {
                         display: true,
                         title: {
                              display: true
                         }
                    },
                    y: {
                         display: true,
                         title: {
                              display: true,
                              text: 'Value'
                         },
                         suggestedMin: 0,
                         suggestedMax: 200
                    }
               }
          }
          // options: {
          //      // responsive: true,
          //      // scales: {
          //      //      y: {
          //      //           beginAtZero: true
          //      //      }
          //      // }
          //      plugins: {
          //           legend: {
          //                labels: {
          //                     usePointStyle: true,
          //                },
          //           }
          //      }
          // }
     });
});

$(document).ready(function () {
     $('#file-upload-form').on('submit', function (e) {
          e.preventDefault();

          var file_data = $('#sortpicture').prop('files')[0];
          var form_data = new FormData();
          form_data.append('file', file_data);

          $.ajax({
               url: 'utils/upload_contents.php', // <-- point to server-side PHP script
               dataType: 'text', // <-- what to expect back from the PHP script, if anything
               cache: false,
               contentType: false,
               processData: false,
               data: form_data,
               type: 'post',
               success: function (php_script_response) {
                    alert(php_script_response); // <-- display response from the PHP script, if any
               }
          });
     });
});

function trigger() {
     var xhr = new XMLHttpRequest();
     xhr.open('GET', 'utils/download_contents.php', true);
     xhr.responseType = 'blob'; // Set the response type to blob for downloading files
     xhr.send();

     xhr.onload = function () {
          if (xhr.status === 200) {
               var blob = new Blob([xhr.response], { type: 'text/csv' }); // Create a blob from the response
               var url = URL.createObjectURL(blob); // Create a temporary URL for the blob
               var a = document.createElement('a');
               a.href = url;
               a.download = 'output.csv';
               document.body.appendChild(a);
               a.click();
               document.body.removeChild(a);
               URL.revokeObjectURL(url); // Clean up the temporary URL
          }
     };
}






