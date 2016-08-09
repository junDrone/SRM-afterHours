<?php
session_start();

if(isset($_GET['subname']))
{
	$subname=$_GET['subname'];
	
	$_SESSION['subname']=$subname;
}
else
$subname=$_SESSION['subname'];

$array1= array();

	if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{
		

		$query="SELECT filename FROM tbl_notes where subject= '".$subname."'";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        array_push($array1, $row['filename']);
       
    	}

		
		
	}
}

?>

<html>
<head>
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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width" initil-scale="1.0">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<script src="javas/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>


<script>
	function myfun(){
		
		window.open('inc/tracker.php');
	}
</script>

<link rel="stylesheet" type="text/css" href="../css/allfiles.css">
</head>
<body>

<div id="titlebar">

<div id="logo"><font color="white">< <font color="red">/</font> SRM afterHOURS ></font></div>
<div id="searchbar">
				<input type="text" id="search" />
				<img src="../images/i1.png" onclick="myFunction()"/>
		</div>

</div><!--titlebar-->

<div id="mainbody">
	<div id="breadcrumb">

		<ol class="breadcrumb">
 			 <li><a href="allfiles.php">Faculty List</a></li>
 			 <li><a href="allfilesubjects.php"><?= $_SESSION['facname'] ?></a></li>
 			 <li class="active"><?= $_SESSION['subname'] ?></li>
		</ol>

	</div><!--breadcrumb-->

	<div id="filelist">

<ul class="list-group">

	<?php  foreach( $array1 as $city  ): ?>

<!--	<li class="list-group-item"><a href="dropboxapi/index.php?file=<?= $city ?>" ><?= $city ?></a> -->
	<li class="list-group-item"><a href="../userdata/<?= $city ?>" id="muid" onclick="myfun()" download  ><?= $city ?></a> 
    		
    	</li>
    <?php endforeach; ?>
</ul>	

	</div><!---filelist->

</div><!--mainbody-->

</body>
</html>