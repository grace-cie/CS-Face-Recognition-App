<?php
namespace NameAuth;

use DB\Database;

// require 'vendor/autoload.php';
// $db = new DB\Database();
class Auth extends Database
{
     public function __construct()
     {

          parent::__construct();
     }
     public function check_login($username, $password)
     {

          $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
          $query = $this->connection->query($sql);

          if ($query->num_rows > 0) {
               $row = $query->fetch_array();
               return $this->details($row['id']);
          } else {
               return false;
          }
     }
     public function details($sql)
     {

          $sqlQuery = "SELECT * FROM user WHERE id = '" . $sql . "'";

          $query = $this->connection->query($sqlQuery);

          $row = $query->fetch_array();

          return $row;
     }
     public function escape_string($value)
     {

          return $this->connection->real_escape_string($value);
     }
}