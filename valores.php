<?php
//include the file that loads the PhpSpreadsheet classes
require 'spreadsheet/vendor/autoload.php';

$path = "C:/xampp/htdocs/mpogLinel/excel/";
$fxls = $_POST['arq'];
$fullPath =  $path.$fxls;

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);

//read excel data and store it into an array
$xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);


echo $xls_data[1];
// echo "Arquivo: " . $_POST['arq'];

include "index.php" 
?>