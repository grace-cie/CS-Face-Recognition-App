<?php
require 'vendor/autoload.php';

$db = new DB\Database();

$globalCss = array(
     // 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css'
     'assets/css/flowbite-1.6.5.min.css',
     'assets/css/style.css',
     'assets/js/jquery.min.js'
);

$initJs = array(
     'assets/js/flowbite-1.6.5.min.js'
);

$globalJs = array(
     // 'assets/js/flowbite-1.6.5.min.js'
);

$local_css = array();
$local_js = array();
$data = array();

$page = (isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : '');
$file = "";

if ($page === 'register') {
     $file = 'pages/register.php';
} else {
     $addphoto = "addphoto";
     if (isset($_SESSION['user'])) {
          $usertype = $_SESSION['user']['usertype'];
          // if (strpos($page, $addphoto) !== false) {

          // }
          if (strpos($page, $addphoto) !== false) {
               $local_css = [
                    'assets/js/addphoto.js',
               ];
               $data = [
                    'title' => 'Add Photo',
                    'page' => 'add photo'
               ];
               $file = 'pages/addphoto.php';
          } elseif ($page === 'reports') {
               if ($usertype != 'admin') {
                    header('location: templates/unknownpage.php');
               } else {
                    $local_css = [
                         'assets/js/report.js',
                         'assets/js/chart.js',
                    ];
                    $data = [
                         'title' => 'Reports',
                         'page' => 'reports'
                    ];
                    $file = 'pages/reports.php';
               }
          } elseif ($page === 'records') {
               $local_css = [
                    'assets/js/refresh.js',
               ];
               $data = [
                    'title' => 'Records',
                    'page' => 'records'
               ];
               $file = 'pages/records.php';
          } elseif ($page === 'logout') {
               session_destroy();
               header('location: index.php');
          } else {
               if ($usertype != 'guard') {
                    $local_css = [
                         'assets/js/report.js',
                         'assets/js/chart.js',
                    ];
                    $data = [
                         'title' => 'Reports',
                         'page' => 'reports'
                    ];
                    $file = 'pages/reports.php';
               } else {
                    $local_css = [
                         'assets/js/face-api.min.js',
                         'assets/js/faceRec.js',
                         'assets/js/req.js',
                    ];
                    $data = [
                         'title' => 'Terminal',
                         'page' => 'terminal'
                    ];
                    $file = 'pages/home.php';
               }
          }

     } else {
          $data = [
               'title' => 'Login',
               'page' => 'login'
          ];
          $file = 'pages/login.php';
     }
}



$css = array_merge($globalCss, $local_css, $initJs);
$js = array_merge($globalJs, $local_js);

include "templates/content.php";