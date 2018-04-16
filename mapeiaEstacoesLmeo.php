<?php

include 'conection.php';
$sql = mapeiaEstacoes();

foreach ($sql as $row) {
    $result = achaDatasValores($row['Codigo']);
    $mediaLmeo = calculaLmeo($result,$row['Codigo']);
};


function calculaLmeo($result,$codigoEstacao){
    $data_valores = [];
    $valor_valores = [];

    foreach ($result as $row) {
        array_push($valor_valores,$row['Maxima']);
        array_push($data_valores,$row['Data']);
    };

    // print_r($data_valores);
    // print_r($valor_valores);
    // exit;

    //pegando os anos e maiores valores
    $maior_data_ano = [];
    $maior_data_ano_valor = [];
    $count_year = [];
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
    //print_r($vetor_certo);exit;
    
    //calculando recorrencias
    $recorrenciaTresAnos = round(count($vetor_certo) / 3);
    $recorrenciaVinteAnos = round(count($vetor_certo) / 20);
    $difRecorrencia = $recorrenciaTresAnos - $recorrenciaVinteAnos;

    //pegando valores baseado na recorrencia
    $valor_certo_recorrencia = array_slice($vetor_certo,$recorrenciaVinteAnos,$difRecorrencia + $recorrenciaVinteAnos);
    //print_r($valor_certo_recorrencia);exit;
    //print_r($valor_certo_recorrencia);

    //calculando media
    $media = round(array_sum($valor_certo_recorrencia) / count($valor_certo_recorrencia)); 

    gravaLimel($media,$codigoEstacao);
        

    } 
?>
