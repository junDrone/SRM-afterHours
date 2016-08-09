<?php
session_start();
$g=-1;
$array1= array();
$array2=array();
$array3=array();
$array4=array();
$array5=array();
$array6=array();
$regisname="Select Chat";
if(isset($_SESSION['user']))
{	
	$userid = $_SESSION['user'];
	if(@mysql_connect('localhost','root',''))
	{
		if(@mysql_select_db('db_afterhours'))
		{
			if(isset($_GET['reg']))
			{	
				$regis=$_GET['reg'];
				//-----------------------------------------------------------------
				$q2="SELECT * from tbl_users WHERE register='".$regis."'";
				$q3="SELECT * from tbl_faculty WHERE register='".$regis."'";
				if(mysql_num_rows(mysql_query($q2))>0)
					{$dd=mysql_fetch_assoc(mysql_query($q2));
						$regisname=$dd['name'];
						}
				else
					{$dd=mysql_fetch_assoc(mysql_query($q3));
						$regisname=$dd['name'];	}
				//-----------------------------------------------------------------
				$querys="SELECT * FROM tbl_messages WHERE receiver = '".$userid."' GROUP BY sender ORDER BY time";
				$querys_run=mysql_query($querys);
				while($rows = mysql_fetch_assoc($querys_run))
				{
					if($rows['sender']!=$regis)
					{	
						$q2="SELECT * from tbl_users WHERE register='".$rows['sender']."'";
						$q3="SELECT * from tbl_faculty WHERE register='".$rows['sender']."'";
						if(mysql_num_rows(mysql_query($q2))>0)
							{
								$dd=mysql_fetch_assoc(mysql_query($q2));
								array_push($array5,$dd['name']);
							}
						else
							{$dd=mysql_fetch_assoc(mysql_query($q3));
							array_push($array5,$dd['name']);	}
					
					array_push($array1,$rows['sender']);
					}
				}

				$query2="SELECT * FROM tbl_messages WHERE (receiver = '".$userid."' AND sender='".$regis."')  OR (sender = '".$userid."' AND receiver='".$regis."')  ORDER BY time";
				$query2_run=mysql_query($query2);
				while($row2 = mysql_fetch_assoc($query2_run))
				{
					array_push($array3,$row2['value']);
					array_push($array2,$row2['sender']);
					if($row2['sender']==$regis)
						array_push($array4,$regisname);
					else if($row2['sender']==$userid)
						array_push($array4,$_SESSION['usersname']);
					
				}

			if(isset($_POST['submit']))
			{	if($_POST['newtext']!="")
				$r=mysql_query('INSERT INTO tbl_messages(sender,receiver,value) VALUES ("'.$userid.'","'.$regis.'","'.$_POST['newtext'].'") ');
				header('location:messages.php?reg='.$regis);
			}


			}
			else
			{
				$query="SELECT * FROM tbl_messages WHERE receiver = '".$userid."' GROUP BY sender ORDER BY time";
				$query_run=mysql_query($query);
				while($row = mysql_fetch_assoc($query_run)) 
				{          
       				array_push($array1,$row['sender']);
        		}
			}
		}
}

}
else
header('Location: homepage.php');




?>

<html>
	<head>	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width" initil-scale="1.0">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
		<script src="javas/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/messages.css">

		<script language="javascript">
			document.onkeypress = function(){
				if(event.keyCode == 13)document.newform.submit();
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
	</head>
	
	<body>


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


	<div id="content1">
		<div class="list-group">
			<a href="#" class="list-group-item active"><img src="../images/profile/<?=$regis?>.jpg"><?=$regisname?></a>
  			<?php  foreach( $array1 as $city  ): ?>
  			<?php $g+=1;?>
  			<a href="messages.php?reg=<?=$array1[$g];?>" class="list-group-item"><img src="../images/profile/<?=$array1[$g]?>.jpg"><?=$array5[$g];?></a>
  			<?php endforeach; ?>
		</div>
	</div><!--content1-->
	<div id="content2">
		<div id="oldmessages">
			<div class="list-group">
				<?php $g=-1;?>
  			<?php  foreach( $array3 as $c  ): ?>
  			<?php $g+=1;?>
  			<div class="list-group-item"><img src="../images/profile/<?=$array2[$g];?>.jpg" class="imgclass"><div class="messhead"><?=$array4[$g];?></div><?=$c?></div>
  			<?php endforeach; ?>
		</div>
		</div><!--oldmessages-->
		<div id="newmessages">
			<form method="post" action="messages.php?reg=<?=$regis;?>" name="newform">
			<input type="text" name="newtext" id="newtext" placeholder="Enter new message..."><input type="submit" id="enterbutton" name="submit" value="Enter">
		</form>
		</div><!--newmessages-->
	</div><!--content2-->


</body>
</html>