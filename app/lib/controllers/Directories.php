<?php
namespace DirEctory;

use DB\Database;

class Directories extends Database
{
     public function __construct()
     {
          parent::__construct();
     }

     public function getDirectory($uuid)
     {
          $sql = "SELECT * FROM main_directory WHERE uuid = '$uuid'";
          $query = $this->connection->query($sql);

          if ($query->num_rows > 0) {
               $row = $query->fetch_assoc();
               return $row;
          } else {
               return false;
          }
     }

     public function getAllDirectories()
     {
          $sql = "SELECT * FROM main_directory";
          $query = $this->connection->query($sql);

          if ($query->num_rows > 0) {
               $data = array();
               while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
               }
               return $data;
          } else {
               return false;
          }
     }

     public function getLimDirectory()
     {
          $sql = "SELECT * FROM `main_directory` LIMIT 12";
          $query = $this->connection->query($sql);

          if ($query->num_rows > 0) {
               $data = array();
               while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
               }
               return $data;
          } else {
               return false;
          }
     }

     public function addDirectories($csvFile)
     {
          // Read the CSV file
          $file = fopen($csvFile, "r");
          $headers = fgetcsv($file); // Assuming the first row contains column headers

          // Prepare the SQL statement
          $tableName = "main_directory"; // Replace with the actual table name
          $columns = implode(",", $headers);
          $placeholders = implode(",", array_fill(0, count($headers), "?"));
          $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
          $stmt = $this->connection->prepare($sql);

          // Bind parameters dynamically based on the number of columns
          $columnCount = count($headers);
          $bindParams = array_fill(0, $columnCount, "");
          $bindParamsReferences = array();
          foreach ($bindParams as &$param) {
               $bindParamsReferences[] = &$param;
          }
          array_unshift($bindParamsReferences, str_repeat("s", $columnCount));
          call_user_func_array(array($stmt, 'bind_param'), $bindParamsReferences);

          // Insert data row by row
          while (($data = fgetcsv($file)) !== false) {
               // Skip the 'id' column
               $index = array_search('ID', $headers);
               if ($index !== false) {
                    unset($data[$index]);
               }

               for ($i = 0; $i < $columnCount; $i++) {
                    $bindParams[$i] = $data[$i];
               }
               $stmt->execute();
          }

          // Close the file and the prepared statement
          fclose($file);
          $stmt->close();
     }

     public function updateImgUrls()
     {
          // Read the folder names in the "assets/labels" directory
          $labelsDirectory = '../../assets/labels';
          $folders_in_labels = scandir($labelsDirectory);

          // Remove . and .. from the array
          $folders_in_labels = array_diff($folders_in_labels, array('.', '..'));

          // Variable to track if any updates were made
          $updatesMade = false;

          // Update the rows in the database
          // Retrieve all the UUIDs from the main_directory table
          $sql = "SELECT UUID FROM main_directory";
          $result = $this->connection->query($sql);

          // Iterate over the UUIDs and check if corresponding folder exists
          while ($row = $result->fetch_assoc()) {
               $uuid = $row['UUID'];

               // Check if the folder exists in the labels directory
               if (in_array($uuid, $folders_in_labels)) {
                    // Folder exists, update the corresponding row in the "IMG_URLS" column
                    $sql = "UPDATE main_directory SET IMG_URLS = '$labelsDirectory/$uuid' WHERE UUID = '$uuid'";
                    $this->connection->query($sql);
                    $updatesMade = true;
               } else {
                    // Folder doesn't exist, set IMG_URLS to empty
                    $sql = "UPDATE main_directory SET IMG_URLS = '' WHERE UUID = '$uuid'";
                    $this->connection->query($sql);
                    $updatesMade = true;
               }
          }

          // Return appropriate message based on updatesMade flag
          if ($updatesMade) {
               return "IMG_URLS updated successfully.";
          } else {
               return "The table is up to date.";
          }
     }


     public function findStudentNumById($id)
     {
          $sql = "SELECT uuid FROM main_directory WHERE id = '$id'";
          $query = $this->connection->query($sql);

          if ($query->num_rows > 0) {
               $row = $query->fetch_assoc();
               return $row;
          } else {
               return false;
          }
     }


     public function escape_string($value)
     {
          return $this->connection->real_escape_string($value);
     }
}
// composer dump-autoload