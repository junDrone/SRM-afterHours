<?php
session_start();
if(isset($_SESSION['test_name']))
{
	if (isset($_POST['submit']))
 	{
		if(isset($_POST['radio']))
		{	
			$ques=$_POST['ques'];
			$ans1=$_POST['op1'];
			$ans2=$_POST['op2'];
			$ans3=$_POST['op3'];
			$ans4=$_POST['op4'];
			$ans=$_POST['radio'];
			echo $ans;
		
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Select an answer")';
			echo '</script>';
		}
	}//submit

}
else
header('Location:homepage.php');

?>

<html>
<head>


	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" initil-scale="1.0">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/test.css">
	<script src="javas/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>

<form action="test.php" method="post">
<div id="content">	
	<div id="question">
		<input type="text"name="ques" id="q">
	</div><!--question-->	
<ul class="list-group">
<li class="list-group-item"><input type="radio" name="radio" value="a"><input type="text" name="op1"></li>
<li class="list-group-item"><input type="radio" name="radio" value="b"><input type="text" name="op2"></li>
<li class="list-group-item"><input type="radio" name="radio" value="c"><input type="text" name="op3"></li>
<li class="list-group-item"><input type="radio" name="radio" value="d"><input type="text" name="op4"></li>
	<input type="submit" name="submit" value="Submit" class="btn"/><input type="submit" name="next" value="Next" class="btn"/>
</ul>
</div><!--content-->
</form>

</body>
</html>