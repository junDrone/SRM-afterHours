<?php
session_start();
$g=-1;
$array1=array();
$array2=array();
$type=$_GET['type'];
$userid=$_GET['regi'];
if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{
		$query='SELECT * FROM tbl_accolades where type="'.$type.'" AND register="'.$userid.'"';
		$query_run=mysql_query($query);
		while($row=mysql_fetch_assoc($query_run))
		{
			array_push($array1,$row['name']);
			array_push($array2,$row['description']);
		}

	}
}
?>
<html>
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width" initil-scale="1.0">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
		<script src="javas/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/accolades.css">
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
<body>
<div id="headerkabaap">
          <div id="logo"><font color="white">< <font color="red">/</font> SRM afterHOURS ></font></div>

			<div id="searchbar">
				<input type="text" id="search" list="dt1"/>
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

	<div id="mainbody">
		<h1><?=strtoupper($type);?></h1><br>
		<?php foreach($array1 as $a): ?>
		<?php $g+=1;?>
		<div class="mainbox">
			<div class="boxhead">
				<?=$a;?>
			</div>
			<h4>Description</h4>
			<div class="boxbody">

				<?=$array2[$g];?>
			</div>
		</div>
		<?php endforeach; ?>
	</div><!--mainbody-->
</body>
</html>