<?php
session_start();
$g=-1;
$array1=array();
$array2=array();
$array3=array();
if(isset($_SESSION['user']))
{	
	$userid = $_SESSION['user'];
		if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{

		$query="SELECT * FROM tbl_faculty WHERE register = '".$userid."' ";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        $profile=$row["profile"];
        $name=$row["name"];
        $email=$row['email'];
        $pno=$row['phone'];
        $_SESSION['fnumber']=$row['fnumber'];
        $activity=$row['about'];
        $projects=$row['projects'];
        $publications=$row['publications'];
        $certifications=$row['certifications'];
        $post=$row['post'];
        $link=$row['link'];
    	}

		
		$query2="SELECT * FROM tbl_accolades WHERE register = '".$userid."' LIMIT 5";
		$query_runs=mysql_query($query2);
		while($rows = mysql_fetch_assoc($query_runs))
		{
			array_push($array1,$rows['name']);
			array_push($array2,$rows['type']);
			array_push($array3,$rows['description']);
		} 
	}
}

}
else
header('Location: homepage.php');
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/fuserprofile.css">
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
				<input type="text" id="search" />
				<img src="../images/i1.png" onclick="myFunction()" />
		</div>

		</div><!--headerkabaap-->	
	
		<div id="header">
		<div id="menubar">
			<ul>
				<li><a href="fuserprofile.php">Home</a></li>
				<li><a href="allfiles.php">Files</a></li>
				<li><a href="editpage.php?type=f">Edit</a></li>
				<li><a href="logout.php" >Logout</a></li>
			</ul>
		</div>
		
	
	</div><!--header-->
<div id="mainbody">
	<div id="options">
		<div id="option1" class="op"><a href="allfiles.php"><img src="../images/file.png"></a></div>
		<div id="option2" class="op"><a href="check2.php"><img src="../images/menu.png"></a></div>
		<div id="option3" class="op"><a href="settest.php"><img src="../images/settings.png"></a></div>
	</div><!--options-->

	<div id="biodata">
		<div id="profimg">
			<img src="../images/profile/<?= $profile?>.png" class="profimage">
		</div><!--profimg-->
		<div id="otherdata">
			<h3><?= $name?></h3>
			<table>
				<tr>
					<td><img src="../images/post.png"></td>
					<td>&nbsp <?= $post?></td>
				</tr>
				<tr>
					<td><img src="../images/main.png"></td>
					<td>&nbsp <?= $email?></td>
				</tr>
				<tr>
					<td><img src="../images/phone.png"></td>
					<td>&nbsp <?= $pno?></td>
				</tr>
			</table>	

			<hr class="lines">
			

		</div><!--otherdata-->
	</div><!--biodata-->

	<div id="conetent1">

		<h2>Activity</h2>
		<hr class="lines">
		<p>
			 <?php echo $activity; ?></p>
		</p>
	</div><!--content1-->
	<div id="conetent2">

		<div class="contenthead">
			Honours
			
			<div id="chone">
			<div class="headd"><a href="accolades.php?regi=<?=$userid;?>&type=project">Projects</a><div class="num"><?php echo $projects; ?></div></div>
			

			</div>
			<div id="chtwo">
				<div class="headd"><a href="accolades.php?regi=<?=$userid;?>&type=certification">Certifications</a><div class="num"><?php echo $certifications; ?></div></div>
			
			</div>
			<div id="chthree">
				<div class="headd"><a href="accolades.php?regi=<?=$userid;?>&type=publication">Publications</a><div class="num"><?php echo $publications; ?></div></div>
			

			</div>
			
		</div><!--contenthead-->

	</div><!--content2-->
	<div id="linksbar">

		<ul>
			<li><img src="../images/facebook.png" style="float:left;"><a href="#" style="margin-left:7px; font-size:12px;color:black;"><?php echo $name; ?></a></li>
			<li><img src="../images/gmail.png" style="float:left;"><a href="#" style="margin-left:10px;font-size:12px; color:black;"><?php echo $email; ?></a></li>
		</ul>

	</div><!--linksbar-->
	<div id="conetent3">
		<h2></h2>
<?php foreach($array1 as $a): ?>
		<?php $g+=1;?>
		<div class="list-group">
  
    <h4 class="list-group-item-heading"><?=strtoupper($array2[$g]);?>:&nbsp<?=$a;?></h4>
    <p class="list-group-item-text"><?=$array3[$g];?></p>
  
</div>
		<?php endforeach; ?>
	</div><!--content3-->
</div><!--mainbody-->
</body>
</html>
