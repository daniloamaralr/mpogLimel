<?php
    $dbuser="root";
    $dbname="mpog_limel";
    $dbpass="";
    $dbserver="127.0.0.1";

    $codigoEstacao = 16900000;
    
    // Make a MySQL Connection
    $con = mysql_connect($dbserver, $dbuser, $dbpass) or die(mysql_error());
    mysql_select_db($dbname) or die(mysql_error());
    // Create a Query
    $sql_query = "SELECT DISTINCT data as maior_data, valor as maior_data_valor
                  from valores
                  where valor in (    SELECT MAX(valor) as maior_valor_ano 
                                      FROM `valores` 
                                      GROUP BY YEAR(data)
                                 )
                                GROUP BY YEAR(data)
                                order by data";

    $sql_query2 = "SELECT media_limel
                   from limel
                   where codigo_estacao =  $codigoEstacao ";
    
    // Execução query que retorna limel
    $result2 = mysql_query($sql_query2) or die(mysql_error());
    $media_limel =  mysql_result($result2,0);
    
    // Execução query valores
    $values =[];
    $result = mysql_query($sql_query) or die(mysql_error());
    
    //print_r($result);
    while ($row = mysql_fetch_array($result)){
      //echo $row['maior_data'] . '>'. $row['maior_data_valor'] . '<br/>';
      array_push($values, array("maior_data" => $row['maior_data'], "maior_data_valor" => $row['maior_data_valor'],"media_limel" => $media_limel));
    }
    $countArray = count($values);
    //echo $countArray;
    mysql_close($con);

?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript" src="./src/jquery-3.3.1.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Data');
        data.addColumn('number', 'Valor');
        data.addColumn('number', 'Média Limel');

    data.addRows([

    <?php
    for($i=0;$i<$countArray;$i++){
        echo "['" . $values[$i]['maior_data'] . "'," . $values[$i]['maior_data_valor'] . "," . $values[$i]['media_limel'] . "],";
    } 
    ?>
    ]);

        var options = {
          title: 'Limel',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>

