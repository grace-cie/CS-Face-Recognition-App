<?php
require '../../vendor/autoload.php';

$direcTory = new DirEctory\Directories();

$res = $direcTory->updateImgUrls();

echo json_encode($res);