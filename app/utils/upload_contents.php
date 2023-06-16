<?php

require '../../vendor/autoload.php';

use DirEctory\Directories;

if (isset($_FILES['file'])) {
     $csvFile = $_FILES['file']['tmp_name'];

     $directory = new Directories();
     $directory->addDirectories($csvFile);
}