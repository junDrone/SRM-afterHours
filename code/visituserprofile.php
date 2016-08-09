<?php
session_start();
$g=-1;
$array1= array();
$array2=array();
$array3=array();

$pageination="";
if(isset($_SESSION['user']))
{	
	$userid = $_GET['reg'];
		if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{

		$query="SELECT * FROM tbl_users WHERE register = '".$userid."' ";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        $profile=$row["profile"];
        $name=$row["name"];
        $_SESSION['usersname']=$name;
        $project=$row["projects"];
        $about=$row['about'];
        $certifications=$row['certifications'];
        $publications=$row['publications'];
        $number=$row['phone'];
        $email=$row['email'];
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
		<title>
			Welcome <?php echo $name; ?>
		</title>
		
		<script>

			function change()
				{
					document.getElementById('mainbody').className += ' slideout';
				}
			function changeback()
				{
					document.getElementById('mainbody').className = 'menu';
				}
				function changelist()
				{
					document.getElementByName('listid').className = 'list-group-item-model';
				}

		</script>	
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
<link rel="stylesheet" type="text/css" href="../css/usrprofile.css">
	</head>
	
	<body>

		<div id="mainbody" class="menu">
			<nav class="slider">
		
				<input type="button" value="Close -->"class="changeback" onclick="changeback()">


				<div id="menulist">

					<ul>
						<li><div class="set1"><a href="#">Edit Profile</a></li>
						<li><div class="set1"><a href="#picture" onclick="changelist()">Change Picture</a></li>
						<li><div class="set1"><a href="#">Something</a></li>
						<li><div class="set1"><a href="#">Logout</a></li>
					</ul>
					<div class="sodal" id="picture">
							<div class="popup">
									
										
									<a href="#">Close</a>

									<div id="sodalcontent">

										<form action="upload.php" method="post" enctype="multipart/form-data">

											<input type="file" name="profile" class="upfilebtn"><br><br>
											<input type="submit" name="Uplaod" class="upbtns">
										</form>

									</div>
									
							</div><!--cont-->
					</div><!--modal-->

				</div>
			</nav>

		<div id="headerkabaap">
          <div id="logo"><font color="white">< <font color="red">/</font> SRM afterHOURS ></font></div>

			<div id="searchbar">
				<input type="text" id="search" list="dt1"/>
				<img src="../images/i1.png" onclick="myFunction()" />
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

	<div class="sodal" id="cats">
							<div class="popup">	
									<a href="#">Close</a>
										<form action="newmessage.php" method="post" >
											<input type="text" name="upreceive" placeholder="Register Number" class="uptext"><br><br>
											<textarea name="uptext" placeholder="Message..." class="uptext"></textarea><br><br>
											<input type="submit" name="upbutton" class="upbutton">
										</form>
							
					</div><!--modal-->

	<div id="maincontent">
		

		<div id="profimg">

			<?php echo '<img src="../images/profile/'.$profile.'.jpg" />' ?>

		</div><!--profimg-->

			<div id="profmenu">
		<ul>
			<li><img src="../images/message.png" class="icons"><div class="set"><a href="#cats">Messages</a><div></li>
			<li><img src="../images/project.png" class="icons"><div class="set"><a href="discussion.php">Discussion Group</a><div></li>
			
		</ul>
			
		</div><!--profmenu-->

		

	</div><!--maincontent-->
	<div id="content1">

		<div id="profilename">
			<?php echo $name;?>
		</div><!--profilename-->
		<div id="aboutme">
			<p>
			<?=$about;?>
		</p>
		</div>

	</div><!--content1-->
	<div id="content2">

		<div class="contenthead">
			Honours
			
			<div id="chone">
			<div class="headd"><a href="accolades.php?regi=<?=$userid;?>&type=project">Projects</a></div>
			<div class="num"><?=$project?></div>

			</div>
			<div id="chtwo">
				<div class="headd"><a href="accolades.php?regi=<?=$userid;?>&type=certification">Certifications</a></div>
			<div class="num"><?=$certifications?></div>
			</div>
			<div id="chthree">
				<div class="headd"><a href="accolades.php?regi=<?=$userid;?>&type=publication">Publications</a></div>
			<div class="num"><?=$publications?></div>

			</div>
			
		</div><!--contenthead-->

	</div><!--content2-->
	<div id="content3">
			<ul>
				<li>Contact: <?=$number?></li>
				<li>Mail: <?=$email?></li>
				<li><a href="<?=$link?>">Facebook Link</a></li>
			</ul>
	</div><!--content3-->
	<div id="content41">

<?php foreach($array1 as $a): ?>
		<?php $g+=1;?>
		<div class="list-group">
  
    <a href="accolades.php?regi=<?=$userid;?>&type=<?=$array2[$g];?>"><h4 class="list-group-item-heading"><?=strtoupper($array2[$g]);?>:&nbsp<?=$a;?></h4>
    <p class="list-group-item-text"><?=$array3[$g];?></p></a>
  
</div>
		<?php endforeach; ?>
	</div><!--content4-->

	





</div><!--mainbody-->



</body>
</html>