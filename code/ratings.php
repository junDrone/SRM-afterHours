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
        <link rel="stylesheet" type="text/css" href="../css/ratings.css">
            <script>
function myFunction() {
    var x=document.getElementById("search").value; 
    if(x!=""){
    var y="visitpagefinder.php?reg=";
    var res=y.concat(x);
    window.open(res);
}
}
        </script>
    </head>
    
<body style="border: 0 none;">
    <div id="headerkabaap">
          <div id="logo"><font color="white">< <font color="red">/</font> SRM afterHOURS ></font></div>

            <div id="searchbar">
                <input type="text" name="searchtext" id="search" list="dt1"/>
                <img src="../images/i1.png" onclick="myFunction()"/>
        </div>

        </div><!--headerkabaap-->   
    
        <div id="header">
        <div id="menubar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="allfiles.php">Files</a></li>
                <li><a href="editpage.php">Edit</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        
    
    </div><!--header-->
    <!-- where the chart will be rendered -->
    <div id="thebody"><h1>Usage Tracker For The Uploaded Files</h1></div>
    <div id="visualization"></div>
 
    <?php
    $result = mysql_query($query);
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
                draw(data, {title:"Usage of materials by subject."});
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
 
    }else{
        echo "No subjects found in the database.";
    }
    ?>
    
</body>
</html>