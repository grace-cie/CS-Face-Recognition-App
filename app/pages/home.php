<?php
// echo $file;
// echo '<pre>';
// var_dump($css);
// var_dump($js);
// echo '</pre>';
// echo 'heklansdnasd';
?>
<div id="status-container" class="status bg-yellow-400 text-center text-white">
     <h2 id="status-text">Detecting Face...</h2>
</div>
<div class="container">
     <div class="camera flex-1 bg-gray-200">
          <!-- Content for the left container -->
          <!-- <h1 class="text-3xl font-bold text-center p-4">Left Container</h1> -->
          <video id="video" class="video" width="600" height="450" autoplay></video>
     </div>
     <div class="flex-1 bg-gray-300">
          <!-- Content for the right container -->
          <h1 class="text-3xl font-bold text-center p-4">Right Container</h1>

          <div id="card-cont" class="card-cont mt-7 mb-7 max-w-xs mx-auto bg-white rounded-lg shadow-md text-center">
               <!-- <div class="flex items-center justify-center h-20 rounded-full">
                    <img class="h-16 w-16 rounded-full" src="assets/img/images.jpg" alt="Profile Picture">
               </div>
               <div class="px-6 py-4">
                    <h3 class="text-xl font-semibold text-gray-800">John Doe</h3>
                    <p class="mt-2 text-base text-gray-600">ca6ac594-4fca-4b17-be8d-9fcd3fca79d3</p>
                    <p class="mt-2 text-sm text-gray-500">Time In: 9:00 AM</p>
               </div> -->
          </div>

          <div class="inputs flex justify-center items-center">
               <div class="w-full max-w-sm">
                    <div class="mb-6">
                         <label for="large-input"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Id</label>
                         <input type="text" id="user-id"
                              class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              disabled readonly>
                    </div>
                    <div class="mb-6">
                         <label for="large-input"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">QR Id</label>
                         <input type="text" id="qr-id"
                              class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              minlength="3" autofocus>
                    </div>
               </div>
          </div>


     </div>
</div>