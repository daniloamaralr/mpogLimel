<?php
include 'conection.php';
//include the file that loads the PhpSpreadsheet classes
require 'spreadsheet/vendor/autoload.php';

$inputFileType = 'Xlsx';
//	$inputFileType = 'Xlsx';
//	$inputFileType = 'Xml';
//	$inputFileType = 'Ods';
//	$inputFileType = 'Gnumeric';

$path = "C:/xampp/htdocs/mpogLinel/excel/";
$fxls = $_POST['arq'];

//pegando codigo da estacao pelo nome do arquivo
$nome_arquivo = explode(" ",$fxls);
$codigoEstacao = intval($nome_arquivo[0]);

$fullPath =  $path.$fxls;

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);

// Carregando Worksheets do arquivo .xlsx
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
//echo 'Loading all WorkSheets<br />';
$reader->setLoadAllSheets();
$spreadsheet = $reader->load($fullPath);

//Pegando Worksheet(primeira - com codigo estacao)
//echo $spreadsheet->getSheetCount(), ' worksheet', (($spreadsheet->getSheetCount() == 1) ? '' : 's'), ' loaded<br /><br />';
$loadedSheetNames = $spreadsheet->getSheetNames();
//echo $loadedSheetNames[0];

$reader->setLoadSheetsOnly($loadedSheetNames[0]);
//$reader->setReadFilter($filterSubset);
$spreadsheet = $reader->load($fullPath);

$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);


//pegando data e valores
$data_valores = [];
$valor_valores = [];
for($i = 16; $i <= count($sheetData);$i++){
    array_push($valor_valores,$sheetData[$i]['G']);
    array_push($data_valores,$sheetData[$i]['C']);
} 
// $data = strtotime($data_valores[0]);
// echo $data;
// break;

gravaBancoValores($valor_valores,$data_valores,$codigoEstacao);
//print_r($valor_valores);
//print_r($data_valores);

//pegando os anos e maiores valores
$maior_data_ano = [];
$maior_data_ano_valor = [];
$valor_maior = 0;
$temp_year = 0;


//pegando os maiores valores em cada ano
for($i = 0; $i < count($data_valores);$i++){
    $data = date_create($data_valores[$i]);
    $year = date_format($data,"Y");
    if ($year != $temp_year ){
        $temp_year = $year;
        $valor_maior = 0;
    }

    if($valor_valores[$i] > $valor_maior && $year == $temp_year){
        $valor_maior = $valor_valores[$i];
        $data_maior = $data_valores[$i];
        $maior_data_ano_valor[$temp_year] = $valor_maior;
        $maior_data_ano[$temp_year] = $data_maior;
    }

}

gravaBancoValoresNovos($maior_data_ano,$maior_data_ano_valor,$codigoEstacao);

//vetor com indice sendo as datas e os seus respectivos valores
$vetor_certo = array_combine($maior_data_ano,$maior_data_ano_valor);

//ordenando mantendo correlação com indice (data)
arsort($vetor_certo);
//print_r($vetor_certo);

//calculando recorrencias
$recorrenciaTresAnos = round(count($vetor_certo) / 3);
$recorrenciaVinteAnos = round(count($vetor_certo) / 20);
$difRecorrencia = $recorrenciaTresAnos - $recorrenciaVinteAnos;

//pegando valores baseado na recorrencia
$valor_certo_recorrencia = array_slice($vetor_certo,$recorrenciaVinteAnos,$difRecorrencia + $recorrenciaVinteAnos);
//print_r($valor_certo_recorrencia);
//print_r($valor_certo_recorrencia);

//calculando media
$media = round(array_sum($valor_certo_recorrencia) / count($valor_certo_recorrencia)); 

gravaLimel($media,$codigoEstacao);



include "index.php" 
?>