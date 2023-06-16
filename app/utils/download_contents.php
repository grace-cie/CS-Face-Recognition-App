<?php
require '../../vendor/autoload.php';

$direcTory = new DirEctory\Directories();

$res = $direcTory->getAllDirectories();

$filename = "output.csv";
$file = fopen($filename, 'w');

$headers = [
     'ID',
     'UUID',
     'LASTNAME',
     'FIRSTNAME',
     'MIDDLENAME',
     'SUFFIX',
     'EMAIL',
     'PHONE',
     'ADDRESS',
     'NATIONALITY',
     'DISPOSITION',
     'GUARDIAN_FULLNAME',
     'GUARDIAN_EMAIL',
     'GUARDIAN_PHONE',
     'IMAGES'
];
fputcsv($file, $headers);

foreach ($res as $r) {
     fputcsv($file, $r);
}

fclose($file);

header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=\"$filename\"");
readfile($filename);
exit;