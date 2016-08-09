<?php
$g=-1;	
$array1= array();
$array2= array();
	if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{

		$query="SELECT * FROM tbl_faculty ORDER BY name";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        array_push($array1, $row['name']);
       array_push($array2, $row['fnumber']);
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
 			 <li class="active">Faculty List</li>
		</ol>

	</div><!--breadcrumb-->

	<div id="filelist">

<ul class="list-group">

	<?php  foreach( $array1 as $city  ): ?>
			<?php $g+=1;?>
		<li class="list-group-item"><a href="allfilesubjects.php?facname=<?= $city ?>"><?= $city ?></a>
    		<span class="badge"><?=$array2[$g] ?></span>
    	</li>
    <?php endforeach; ?>
</ul>	

	</div><!---filelist->

</div><!--mainbody-->

</body>
</html>