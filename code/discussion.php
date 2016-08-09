<?php
session_start();
$g=-1;
$array1=array();
$array2=array();
$array3=array();
$array4=array();
$array5=array();
$array6=array();
$countarray=array();
$userid=$_SESSION['user'];

function countno($n)
{	
	$query="SELECT * FROM tbl_comment where id='".$n."'  ";
		$query_run=mysql_query($query);

		return(mysql_num_rows($query_run));
}
if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{

		$query='SELECT * FROM tbl_discussion ORDER BY time 	desc';
		$query_run=mysql_query($query);
		while($row=mysql_fetch_assoc($query_run))
		{
			array_push($array1,$row['topic']);
			array_push($array2,$row['description']);
			array_push($array3,$row['register']);
			array_push($array4,$row['time']);
			array_push($array5,$row['id']);
			array_push($array6,$row['name']);
			array_push($countarray,countno($row['id']));
		}

	}
}

if(isset($_POST['newsubmit']))
{
	if(@mysql_connect('localhost','root',''))
	{
	if(@mysql_select_db('db_afterhours'))
	{	
		$newq='INSERT INTO tbl_discussion(name,description,register,topic) values ("'.$_SESSION["usersname"].'","'.$_POST["newdesc"].'","'.$userid.'","'.$_POST["newtopic"].'")';
		$runner=mysql_query($newq);
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
		<link rel="stylesheet" type="text/css" href="../css/discussion.css">
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
				<li><a href="cats">Home</a></li>
				<li><a href="allfiles.php">Files</a></li>
				<li><a href="editpage.php">Edit</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
	
	</div><!--header-->
	<div class="sodal" id="cats">
	<div class="sodal-container">
		<p>
			<form action="discussion.php" method="post">
			
			<input type="text" name="newtopic" placeholder="topic" class="txtbox"><br><br>
			<textarea name="newdesc" placeholder="description" class="txtbox1"></textarea><br><br>
			<input type="submit" class="btn" name="newsubmit">
		</form>
		<a href="#">Close</a>
		</p>
	</div><!--cont-->
</div><!--modal-->
<div id="addnew"><a href="#cats"><img src="../images/addnew.jpg"></a></div>
	<div id="mainbody">

		<h1>Discussion Topics</h1><br>
		<?php foreach($array1 as $a): ?>
		<?php $g+=1;?>
		<div class="mainbox">
			<div class="boxhead">
				<?=$a?>
				<div class="by"><img src="../images/profile/<?=$userid?>.jpg"></div>
			</div>
			<div class="boxbody">
				<?=$array2[$g];?>
			</div>
			<div class="boxfoot">
				<a href="comment.php?id=<?=$array5[$g];?>">Comments</a> <span class="badge" id="badge"><?= $countarray[$g];?></span>
				
			</div>
			<h6>Posted on:<?=$array4[$g];?></h6>
		</div>
		<?php endforeach; ?>
	</div><!--mainbody-->
</body>
</html>