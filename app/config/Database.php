<?php
namespace DB;

use mysqli;

session_start();
class Database
{

     private $host = 'localhost';
     private $username = 'root';
     // private $password = 'KmJsYDN)vLSiLzwj';
     private $password = '';
     private $database = 'thesis';

     protected $connection;

     public function __construct()
     {

          if (!isset($this->connection)) {

               $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

               if (!$this->connection) {
                    echo 'Cannot connect to database server';
                    exit();
               }
          }

          // return $this->connection;
     }
}

// INSERT INTO main_directory (uuid, lastname, firstname, middlename, suffix, email, phone, address, nationality, disposition, guardian_fullname, guardian_email, guardian_phone, images)
// VALUES ('ca6ac594-4fca-4b17-be8d-9fcd3fca79d3', 'Doe', 'John', 'Smith', '', 'john.doe@example.com', '1234567890', '123 Main St', 'USA', 'Gr11', 'Jane Doe', 'jane.doe@example.com', '9876543210', null);