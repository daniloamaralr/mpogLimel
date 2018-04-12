<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript" src="./src/jquery-3.3.1.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      console.log(this)

      function drawChart() {
        var jsonPieChartData = $.ajax({
            url: "grafico.php",
            data: "q="+num,
            dataType:"json",
            async: false
        }).responseText;

        var options = {
          title: 'Company Performance',
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

    <?php
    $dbuser="root";
    $dbname="mpog_limel";
    $dbpass="";
    $dbserver="127.0.0.1";
    
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
    // Execute query
    $result = mysql_query($sql_query) or die(mysql_error());
    //print_r($result);
    while ($row = mysql_fetch_array($result)){
      echo $row['maior_data'] . '>'. $row['maior_data_valor'] . '<br/>';
    }
    json_encode($result);
    mysql_close($con);

  ?>
  </body>
</html>

