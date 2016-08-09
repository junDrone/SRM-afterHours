<?php
session_start();
$g=-1;
$array1=array();
$array2=array();
$array3=array();
$array4=array();
$pageination="";
if(isset($_SESSION['user']))
{
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		if(mysql_connect('localhost','root',''))
		{
			if(mysql_select_db('db_afterhours'))
			{
				$picquery="SELECT * FROM tbl_discussion WHERE id='".$id."' ";
				$picrun=mysql_query($picquery);
				$rowreg=mysql_fetch_assoc($picrun);

				$pagequery="SELECT null FROM tbl_comment where id='".$id."'";
				$pageqrun= mysql_query($pagequery);
				$count=mysql_num_rows($pageqrun);
		if($count!=0)
		{
					if(isset($_GET['page']))
				{
				$page=preg_replace("#[^0-9]#","",$_GET['page'])	;
				}//if page
			else
				{
				$page=1;
				}//else page
			$perpage=10;
			$lastPage=ceil($count/$perpage);

			if($page<1)
				$page=1;
			else if($page>$lastPage)
				$page=$lastPage;
			$dk=($page-1)*$perpage;
			$limit="LIMIT ".$dk.",10";

			$pagequery2="SELECT * FROM tbl_comment where id='".$id."' ".$limit;
			$pageqrrun=mysql_query($pagequery2);
			if($lastPage!=1)
			{
				if($page!=$lastPage)
				{
					$next=$page+1;
					$pageination='<a href="comment.php?page='.$next.'">Next</a>';
				}
				if($page!=1)
				{
					$prev=$page-1;
					$pageination='<a href="comment.php?page='.$prev.'">Preevious</a>';
				}
			}	
			while($row=mysql_fetch_array($pageqrrun))
			{
			
				array_push($array1,$row['register']);
				array_push($array4,$row['name']);
				array_push($array2,$row['value']);
				array_push($array3,$row['time']);
			}
		}

if(isset($_POST['addnewcomment']))
			{					
			$addnewcomment='INSERT INTO tbl_comment(name,register,id,value) values("'.$_SESSION["usersname"].'","'.$_SESSION["user"].'","'.$id.'","'.$_POST["newvalue"].'")';
			$runner=mysql_query($addnewcomment);
				
			}
			if(isset($_POST['taguser']))
			{					
			$d=mysql_query('INSERT INTO tbl_messages (sender,receiver,value) VALUES ("'.$_SESSION['user'].'","'.$_POST['tagged'].'",You have been tagged to a post: comment.php?id="'.$id.'")');
				
			}
			}
		}



	}
	else
		header('location:discussion.php');
}
else
header('location:homepage.php');
?>
<html>
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width" initil-scale="1.0">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
		<script src="javas/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/comment.css">
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
				<img src="../images/i1.png" onclick="myFunction()" />
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
	</div>
	<form action="comment.php" method="post">
		<div id="taguser"><img src="../images/send.png"><input type="text" name="tagged" placeholder"TagUser"><input type="submit" value="Tag" name="taguser"></div></form>
		<div id="mainbody">
			<div id="topic">
				<div class="pimg"><img src="../images/profile/<?=$rowreg['register'];?>.jpg"></div>
				<div id="question"><?=$rowreg['topic']?>
					<div id="times"><?=$rowreg['time']?></div>
				</div>
				<div id="desc"><?=$rowreg['description']?>
					
				</div>
				<div id="addnewcom">
					<form action="comment.php?id=<?=$id;?>" method="post">
					<input type="text" id="txtbox" name="newvalue" placeholder="Add new comment..."><input type="submit" name="addnewcomment" id="btn" value="Enter">
				</form>
				</div><!--addnewcom-->
			</div><!--topic-->

			<div id="comments">
				
			
				<?php  foreach( $array1 as $city  ): ?>
				<?php $g+=1;?>
				<div class="comment">
					
				<div class="pcimg"><img src="../images/profile/<?=$city?>.jpg"></div>
					<div class="cname"><?=$array4[$g]?></div>
					<div class="ctime"><?=$array3[$g]?></div>
					<div class="cvalue"> <?=$array2[$g]?></div>
    		
				</div><!--comment-->
				
			
			<?php endforeach; ?>
			<div id="navigationfooter">
<?php echo $pageination;?>
		</div>

			</div><!--comments-->

		</div><!--mainbody-->

</body>
</html>		






    