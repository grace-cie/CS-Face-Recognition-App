<?php

$directory = '../assets/labels';
$folders = [];

if (is_dir($directory)) {
     $files = scandir($directory);

     foreach ($files as $file) {
          if ($file !== '.' && $file !== '..' && is_dir($directory . '/' . $file)) {
               $folders[] = $file;
          }
     }
}

echo json_encode($folders);