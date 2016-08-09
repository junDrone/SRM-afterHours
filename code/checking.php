<?php

$userid=1201110011;
$sub_name='SQM';
$savename=1;

if(@mysql_connect('localhost','root',''))
		{
			if(@mysql_select_db('db_afterhours'))
			{
				$query='SELECT *from tbl_hitcounter';
			}
	}

?>
<!DOCTYPE html">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        
    </head>
    
<body style="font-family: Arial;border: 0 none;">
    <!-- where the chart will be rendered -->
    <div id="visualization" style="border:1px solid red;width: 600px; height: 400px;"></div>
 
    <?php
 
    
    
 
    //execute the query
    $result = mysql_query($query);
 
    //get number of rows returned
    $num_results = mysql_num_rows($result);
 
    if( $num_results > 0){
 
    ?>
        <!-- load api -->
        <script type="text/javascript" src="../javas/jsap.js"></script>
        
        <script type="text/javascript">
            //load package
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['PL', 'Ratings'],
                    <?php
                    while( $row = mysql_fetch_assoc($result) ){
                        $d=$row['subject'];
                        $e=$row['no'];
                        echo "['{$d}', {$e}],";
                    }
                    ?>
                ]);
 
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, {title:"Tiobe Top Programming Languages for June 2012"});
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
 
    }else{
        echo "No programming languages found in the database.";
    }
    ?>
    
</body>
</html>