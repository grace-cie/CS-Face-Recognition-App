<?php
require '../vendor/autoload.php';
$direcTory = new DirEctory\Directories();
if (isset($_POST['id'])) {
     $id = $_POST['id'];
     $res = $direcTory->findStudentNumById($id);
     // Specify the target directory to store the uploaded images
     $stu_num = $res['uuid'];
     $targetDirectory = "../assets/labels/$stu_num/";

     // Create the directory if it doesn't exist
     if (!file_exists($targetDirectory)) {
          mkdir($targetDirectory, 0755, true);
     }

     $counter = 1;

     // Loop through each uploaded file
     foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
          // Generate the filename with an incrementing counter
          $filename = $counter . '.png';

          // Specify the destination path for the image
          $destination = $targetDirectory . $filename;

          // Move the uploaded file to the destination path
          if (move_uploaded_file($tmpName, $destination)) {
               $message = 'Image ' . $index . ' successfully uploaded and stored as ' . $filename . '<br>';
          } else {
               $message = 'Error uploading image ' . $index . '<br>';
          }

          $counter++; // Increment the counter for the next image
     }
}