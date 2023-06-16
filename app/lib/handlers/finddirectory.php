<?php
require '../../vendor/autoload.php';

$direcTory = new DirEctory\Directories();

if (isset($_POST['uuid'])) {
     $res = $direcTory->getDirectory($direcTory->escape_string($_POST['uuid']));
     echo json_encode($res);
}