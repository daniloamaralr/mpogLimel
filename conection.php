<?php

function gravaBancoValores($valor_valores,$data_valores,$codigoEstacao){

    $dsn = "mysql:dbname=mpog_limel;host=127.0.0.1";
    $dbuser = "root";
    $dbpass = "";

    set_time_limit(100);

    try{
        $pdo = new PDO($dsn,$dbuser,$dbpass);
        //echo("Conexão estabelecida com sucesso");
    } catch(PDO_EXCEPTION $e){
        echo "Falhou: ".$e->getMessage();
    }

    //$codigoEstacao = 16900000;
    //$newDate = date("Y-m-d", strtotime($data_valores[0]));
    //echo $newDate;
    

    for ($i=0; $i < count($data_valores) ; $i++) { 
        try{
            $data  = date("Y-m-d", strtotime($data_valores[$i]));
            $valor = $valor_valores[$i];
    
            $sql = "INSERT INTO valores VALUES ('','$data',$valor, $codigoEstacao) ";
            $sql = $pdo->query($sql);
        }catch(PDO_EXCEPTION $e){
            echo "Falhou inserção: ".$e->getMessage();
        }

    }
    
} 

function gravaBancoValoresNovos($maior_data_ano,$maior_data_ano_valor,$codigoEstacao){

    $dsn = "mysql:dbname=mpog_limel;host=127.0.0.1";
    $dbuser = "root";
    $dbpass = "";

    try{
        $pdo = new PDO($dsn,$dbuser,$dbpass);
        //echo("Conexão estabelecida com sucesso");
    } catch(PDO_EXCEPTION $e){
        echo "Falhou: ".$e->getMessage();
    }

    //$codigoEstacao = 16900000;
    $grava_ano = [];
    $grava_valor = [];

    $i=0;
    foreach ($maior_data_ano as $ano) {
        $grava_ano[$i] = $ano;
        $i++;
    }
    
    $i=0;
    foreach ($maior_data_ano_valor as $valor) {
        $grava_valor[$i] = $valor;
        $i++;
    }

    for ($i=0; $i < count($grava_ano) ; $i++) { 
        try{
            $data  = date("Y-m-d", strtotime($grava_ano[$i]));
            $valor = $grava_valor[$i];
    
            $sql = "INSERT INTO valores_novo VALUES ('','$data',$valor, $codigoEstacao) ";
            $sql = $pdo->query($sql);
        }catch(PDO_EXCEPTION $e){
            echo "Falhou inserção: ".$e->getMessage();
        }

    }

}

function gravaLimel($media_limel,$codigoEstacao){

    $dsn = "mysql:dbname=mpog_limel;host=127.0.0.1";
    $dbuser = "root";
    $dbpass = "";

    try{
        $pdo = new PDO($dsn,$dbuser,$dbpass);
        //echo("Conexão estabelecida com sucesso");
    } catch(PDO_EXCEPTION $e){
        echo "Falhou: ".$e->getMessage();
    }

    try{
        $sql = "INSERT INTO limel VALUES ('',$media_limel, $codigoEstacao) ";
        $sql = $pdo->query($sql);
    }catch(PDO_EXCEPTION $e){
        echo "Falhou inserção: ".$e->getMessage();
    }


    
} 

?>