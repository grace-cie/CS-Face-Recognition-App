<?php
session_start();
require '../../vendor/autoload.php';
// include_once('../controllers/User.php');
$auth = new NameAuth\Auth();

if (isset($_POST['logg'])) {
     $username = $auth->escape_string($_POST['username']);
     $password = $auth->escape_string($_POST['password']);

     $check = $auth->check_login($username, $password);

     if (!$check) {
          $_SESSION['error'] = 'Invalid credentials';
          header('location: ../../index.php');
          exit();
     } else {
          $_SESSION['user'] = $check;
          header('location: ../../index.php');
     }
} else {
     $_SESSION['message'] = 'You need to login first';
}