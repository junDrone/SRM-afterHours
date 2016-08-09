<?php
session_start();
$g=-1;
$array1= array();
$array2=array();
$array3=array();
$array4=array();
$pageination="";
if(isset($_SESSION['user']))
{	
	$userid = $_SESSION['user'];
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

		//-------------------------------For counting the accolades----------------------------------------------------------------


		//-------------------------------------------pagination-------------------------------------------------------------------------------------------------------------------------

		$pagequery="SELECT null FROM tbl_notes";
		$pageqrun= mysql_query($pagequery);
		$count=mysql_num_rows($pageqrun);
		

		if(isset($_GET['page']))
		{
			$page=$_GET['page'];
		}//if page
		else
		{
			$page=1;
		}//else page
		$perpage=8;
		$lastPage=ceil($count/$perpage);

		if($page<1)
			$page=1;
		else if($page>$lastPage)
			$page=$lastPage;
		$dk=($page-1)*$perpage;
		$limit="LIMIT ".$dk.",8";

		$pagequery2="SELECT * FROM tbl_notes ".$limit;
		$pageqrrun=mysql_query($pagequery2);
		if($lastPage!=1)
		{
			if($page!=$lastPage){
				$next=$page+1;
				$pageination='<a href="userprofile.php?page='.$next.'#bottomOfPage">Next</a>';
			}
			if($page!=1){
				$prev=$page-1;
				$pageination='<a href="userprofile.php?page='.$prev.'#bottomOfPage">Preevious</a>';
			}
		}		
		while($row=mysql_fetch_array($pageqrrun))
		{
			$nameq="SELECT name FROM tbl_faculty where register= '".$row['register']."' ";
			$nameqrun=mysql_query($nameq);
			$namerow=mysql_fetch_assoc($nameqrun);
			array_push($array4,$namerow['name']);
			array_push($array1,$row['time_stamp']);
			array_push($array2,$row['subject']);
			array_push($array3,$row['register']);

		}	
		//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
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
		function myFunction() {
	var x=document.getElementById("search").value; 
	if(x!=""){
	var y="visitpagefinder.php?reg=";
	var res=y.concat(x);
    window.open(res);
}
}

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


	<div id="maincontent">

		<div id="profimg">

			<?php echo '<img src="../images/profile/'.$profile.'.jpg" />' ?>

		</div><!--profimg-->

			<div id="profmenu">
		<ul>
			<li><img src="../images/message.png" class="icons"><div class="set"><a href="messages.php">Messages</a><div></li>
			<li><img src="../images/project.png" class="icons"><div class="set"><a href="discussion.php">Discussion Group</a><div></li>
			<li><img src="../images/settings.png" class="icons"><div class="set"><a href="#" onclick="change()">Settings</a><div></li>
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
	<div id="content4">

<a name="bottomOfPage"></a>
		<ul class="list-group" >
			<?php  foreach( $array3 as $city  ): ?>
			<?php $g+=1;?>
			<li class="list-group-item"><a href="transfer.php?subname=<?= $array2[$g] ?>&register=<?=$city?>"><?= $array4[$g] ?> has uploaded a file for the subject <?= $array2[$g] ?> at <?=$array1[$g]?></a></li> 
    		<?php endforeach; ?>
    	</ul>
    

		<div id="navigationfooter">
<?php echo $pageination;?>
		</div>
	</div><!--content4-->

	





</div><!--mainbody-->



</body>
</html>