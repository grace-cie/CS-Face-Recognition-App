<?php
require '../../vendor/autoload.php';

$log = new LogsRecord\Logs();

if (isset($_POST['stu_num']) && isset($_POST['terminal']) && isset($_POST['date']) && isset($_POST['dateTime'])) {
     $stu_num = $_POST['stu_num'];
     $terminal = $_POST['terminal'];
     $date = $_POST['date'];
     $dateTime = $_POST['dateTime'];

     $res = $log->logUser($stu_num, $terminal, $date, $dateTime, $reason = null);

     if ($res) {
          echo json_encode($res);
     } else {
          echo json_encode('something went wrong');
     }
}