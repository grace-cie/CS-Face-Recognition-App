<?php
namespace LogsRecord;

use DB\Database;

class Logs extends Database
{
     public function __construct()
     {
          parent::__construct();
     }

     public function logUser($stu_num, $terminal, $date, $dateTime, $reason)
     {
          // Check if the data already exists
          $query = "SELECT id FROM logs WHERE stud_num = ? AND terminal = ? AND date = ?";
          $stmt = $this->connection->prepare($query);
          $stmt->bind_param("iss", $stu_num, $terminal, $date);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows === 0) {
               // Data doesn't exist, proceed with insertion
               $insertQuery = "INSERT INTO logs (stud_num, terminal, date, datetime, reason) VALUES (?, ?, ?, ?, ?)";
               $insertStmt = $this->connection->prepare($insertQuery);
               $insertStmt->bind_param("issss", $stu_num, $terminal, $date, $dateTime, $reason);
               $insertStmt->execute();

               if ($insertStmt) {
                    return 'Logged';
               }
          } else {
               return 'This user already logged';
          }

          $stmt->close();
     }

}