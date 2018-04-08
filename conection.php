<?php
    function gravaBancoValores($valor_valores,$data_valores){
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

        $codigoEstacao = 16900000;
        $newDate = date("Y-m-d", strtotime($data_valores[0]));
        echo $newDate;
        

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

?>