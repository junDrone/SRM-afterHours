<?php
session_start();
if(isset($_GET['facname']))
{
	$facname=$_GET['facname'];
	$_SESSION['facname']=$facname;
}

$array1= array();

	if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{
		$query1="SELECT register from tbl_faculty WHERE name= '".$_SESSION['facname']."'";
		$query_runs=mysql_query($query1);
		$rows = mysql_fetch_assoc($query_runs);
		$facreg=$rows['register'];

		$query="SELECT subject FROM tbl_notes where  register= '".$facreg."' GROUP BY subject ";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        array_push($array1, $row['subject']);
       
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
 			 <li class="active"><?= $_SESSION['facname'] ?></li>
		</ol>

	</div><!--breadcrumb-->

	<div id="filelist">

<ul class="list-group">

	<?php  foreach( $array1 as $city  ): ?>

		<li class="list-group-item"><a href="thefiles.php?subname=<?= $city ?>"><?= $city ?></a>
    		
    	</li>
    <?php endforeach; ?>
</ul>	

	</div><!---filelist->

</div><!--mainbody-->

</body>
</html>