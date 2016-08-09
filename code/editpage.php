<?php

session_start();

if(isset($_SESSION['user']))
{	
	
	$userid=$_SESSION['user'];
	if(@mysql_connect('localhost','root',''))
	{
		if(@mysql_select_db('db_afterhours'))
		{
			$query_run=mysql_query('SELECT * FROM tbl_users WHERE register= "'.$_SESSION['user'].'" ');
			while($row = mysql_fetch_assoc($query_run)) 
			{
				$name=$row['name'];
				$email=$row['email'];
				$phone=$row['phone'];
				$link=$row['link'];
				$about=$row['about'];
				$project=$row["projects"];
      		 	$certifications=$row['certifications'];
        		$publications=$row['publications'];
			}

			if(isset($_POST['submit']))
				{	if($_POST['password'])
						{
							$pass=$_POST['password'];
							$cpass=$_POST['cpassword'];
							if(strcmp($pass,$cpass)==0)
							{	
								if($fileupdate = mysql_query("UPDATE tbl_users SET name='".$_POST['username']."',email='".$_POST['email']."',phone='".$_POST['number']."',link='".$_POST['link']."',about='".$_POST['txt']."',password='".md5($pass)."'  WHERE register='".$_SESSION['user']."'" ))
								header('location:userprofile.php');
							}	
							else
							{
						 		echo '<script language="javascript">';
  						 		echo 'alert("Passwords Dont Match")';  //not showing an alert box.
  						 		echo '</script>';
							}
						}	
					else
						{
							echo '<script language="javascript">';
  							echo 'alert("Enter Password")';  //not showing an alert box.
  							echo '</script>';
						}
					
				}
			else if (isset($_POST['submitproject'])) 
				{

					$title=$_POST['projectname'];
					$desc=$_POST['protxt'];
					$t='project';
					if($proup=mysql_query('INSERT INTO tbl_accolades(register,type,description,name) values ("'.$userid.'","'.$t.'","'.$desc.'","'.$title.'")'))
					{	
						
						$project+=1;
						if($projcount=mysql_query("UPDATE tbl_users SET projects='".$project."'"))
						header('location:userprofile.php');
					}
				}
			else if (isset($_POST['submitpublication'])) 
				{
					$title2=$_POST['pubname'];
					$desc2=$_POST['pubtxt'];
					$t2='certification';
					if($proup2=mysql_query('INSERT INTO tbl_accolades(register,type,description,name) values ("'.$userid.'","'.$t2.'","'.$desc2.'","'.$title2.'")'))
					{
						$certifications+=1;
						if($projcount2=mysql_query("UPDATE tbl_users SET certifications='".$certifications."'"))
						header('location:userprofile.php');
				}
				}
			else if (isset($_POST['submitcert'])) 
				{
					$title3=$_POST['certname'];
					$desc3=$_POST['certtxt'];
					$t3='publication';
					if($proup3=mysql_query('INSERT INTO tbl_accolades(register,type,description,name) values ("'.$userid.'","'.$t3.'","'.$desc3.'","'.$title3.'")'))
					{ $publications+=1;
						if($projcount3=mysql_query("UPDATE tbl_users SET publications='".$publications."'"))
						header('location:userprofile.php');
				}
				}
		}
	}

	

}
else
header('Location:homepage.php');

?>

<html>
<head>

	<link rel="stylesheet" type="text/css" href="../css/editpage.css">
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
</head>
<body>
	<div id="headerkabaap">
          <div id="logo"><font color="white">< <font color="red">/</font> SRM afterHOURS ></font></div>

			<div id="searchbar">
				<input type="text" id="search" />
				<img src="../images/i1.png" onclick="myFunction()"/>
		</div>

		</div><!--headerkabaap-->	
	
		<div id="header">
		<div id="menubar">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="allfiles.php">Files</a></li>
				<li><a href="#">Edit</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
	
	</div><!--header-->

<h2 style="float:left;margin-left:70px;">Edit Profile</h2>
<div id="mainbody">
	
<ul class="list-group">
	<form action="editpage.php" method="post">
<li class="list-group-item"><input type="text" class="txtbox" placeholder="User Name" value="<?=$name?>" name="username"></li>
<li class="list-group-item"><input type="text" class="txtbox" placeholder="E-Mail" value="<?=$email?>" name="email"></li>
<li class="list-group-item"><input type="text" class="txtbox" placeholder="Contact No" value="<?=$phone?>" name="number"></li>
<li class="list-group-item"><input type="password" class="txtbox" placeholder="Password"  name="password"></li>
<li class="list-group-item"><input type="password" class="txtbox" placeholder="Confirm Password"  name="cpassword"></li>
<li class="list-group-item"><input type="text" class="txtbox" placeholder="Facebook Link"  value="<?=$link?>" name="link"></li>
<li class="list-group-item">
	<textarea id="txtcomment" placeholder="About Me..." name="txt" style="border-radius:7px; margin-left:30px;width:80%; height: 70px;" maxlength="300">
		<?=$about?>
	</textarea>
</li><br>
<input type="submit" name="submit" style="margin-left:170px; width:150px;" class="btn">
</form>

<form method="post" action="editpage.php">
<li class="list-group-item">
	<h3>Add Project</h3>
	<input type="text" class="txtbox" placeholder="Project Name" name="projectname"><br><br>
	
	<textarea id="txtcomment" placeholder="Description" name="protxt" style="border-radius:7px; margin-left:30px;width:80%; height: 70px;" maxlength="300"></textarea><br><br>
	<input type="submit" name="submitproject" style="margin-left:170px; width:150px;" class="btn">
</li>
</form>

<form method="post" action="editpage.php">
<li class="list-group-item">
	<h3>Add Paper Publications</h3>
	<input type="text" class="txtbox" placeholder="Published Name" name="pubname"><br><br>
	
	<textarea id="txtcomment" placeholder="Description" name="pubtxt" style="border-radius:7px; margin-left:30px;width:80%; height: 70px;" maxlength="300"></textarea><br><br>
	<input type="submit" name="submitpublication" style="margin-left:170px; width:150px;" class="btn">
</li>
</form>

<form method="post" action="editpage.php">
<li class="list-group-item">
	<h3>Add Certifications</h3>
	<input type="text" class="txtbox" placeholder="Certification Name" name="certname"><br><br>
	
	<textarea id="txtcomment" placeholder="Description" name="certtxt" style="border-radius:7px; margin-left:30px;width:80%; height: 70px;" maxlength="300"></textarea><br><br>
	<input type="submit" name="submitcert" style="margin-left:170px; width:150px;" class="btn">
</li>
</form>-->
</ul>


</div><!--mainbody-->






</body>
</html>