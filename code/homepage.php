
<?php
session_start();



if(isset($_POST['slogin']))
{
	$uname=$_POST['suser'];
	$upass=md5($_POST['spass']);
	if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{

		$query="SELECT * FROM tbl_users WHERE register = '".$uname."' ";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        $pass=$row["password"];
        if($upass==$pass)
        {
        	$_SESSION['user']=$uname;
        	$_SESSION['position']="s";
        	header('Location: userprofile.php');
        }
    	}

		
		
	}
}


}
	else if(isset($_POST['flogin']))
{
	$uname=$_POST['fuser'];
	$upass=md5($_POST['fpass']);
	if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{

		$query="SELECT * FROM tbl_faculty WHERE register = '".$uname."' ";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        $pass=$row["password"];
        if($upass==$pass)
        {
        	$_SESSION['user']=$uname;
        	$_SESSION['position']="f";
        	header('Location: fuserprofile.php');
        }
    	}

		
		
	}
}


}






?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/homepage.css">

<script type="text/javascript" src="../javas/jq.js"></script>
<script type="text/javascript" src="../javas/jquery-ui.min.js"></script>

<script type="text/javascript" >

function Sliderboy(){

	$(".slider #1").show("fade",500);
	$(".slider #1").delay(5000).hide("slide",{direction:"left"},500);

	var sc=$(".slider img").size();
	var count =2;
	setInterval(function(){

		$(".slider #"+count).show("slide",{direction:"right"},500);
		$(".slider #"+count).delay(5000).hide("slide",{direction:"left"},500);

	if(count==sc)
		{
			count=1;}
			else{count=count+1;}
		
	},6000);

}
</script>


</head>
<body onload="Sliderboy();">


<div id="mainbody">

<div id="longo">
<div id="logo">
	<h1><b><font color="white"> < </font><font color="red">/</font> </b><font color="white" face="arial black" >SRM</font><font color="white"> afterHours <b>></font></b></h1>
</div>

</div>
<div id="islide">


<div class="slider" >
   <img id="1" src="../images/srm1.jpg" border="0" alt="DeadPool" />
   <img id="2" src="../images/srm2.jpg" border="0" alt="Rorschach" />
   <img id="3" src="../images/srm3.jpg" border="0" alt="BlackWidow" />
</div><!--image slider-->

</div>

<div id="loginmenu">

<div class="container">
<ul class="accordian">
<li>
	<a href="#first" class="accordian-header">Faculty Login</a>
	<div class="accordian-content" id="first">
		<p>
			
			
			<form method="post" action="homepage.php">
				<input type="text" name="fuser" class="txtbox" placeholder="   UserID"><font color="red">*</font><br><br>
			<input type="password" name="fpass" class="txtbox" placeholder="   Password"><font color="red">*</font><br><br>
			<input type="submit" name="flogin" value="Login" class="btn" />
		</form>
			

		</p>

	</div>

</li>
<li>
	<a href="#second" class="accordian-header">Student Login</a>
	<div class="accordian-content" id="second">
		<form ation="homepage.php" method="post" ><p>
			<input type="text" name="suser" class="txtbox" placeholder="   UserID"><font color="red">*</font><br><br>
			<input type="password" name="spass" class="txtbox" placeholder="   Password"><font color="red">*</font><br><br>
			<input type="submit" name="slogin" value="Login" class="btn" />

		</p></form>

	</div>

</li>

</ul><!--accordian-->
</div><!--container-->
<div style="float:right; margin-top:10px;"><a href="register.php">New User ?</a>	</div>
</div><!--loginmenu-->

</div><!--mainbody-->

<div id="footer">

<div id="icons">

<img src="../images/facebook.png" class="ico">
<img src="../images/gmail.png" class="ico">

</div>

<div id="copy">
 aR|un 

</div>

</div>

</body>
</html>

