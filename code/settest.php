<?php

session_start();
require 'database/connect.php' ;
if(isset($_SESSION['user']))
{
	if(isset($_POST['next']))
	{
		$sub=$_POST['subject'];
		$nome=$_POST['tname'];
		if($update = $db->query("INSERT INTO test values ('".$nome."','".$sub."','".$_SESSION['user']."')"))
						{	$_SESSION['test_name']=$nome;
							$_SESSION['test_sub']=$sub;
							header('Location:test.php');
						}
		else
			echo 'Server Issues, please try again';
	}
}
else
header('Location:homepage.php');

?>

<html>
<head></head>
<body>

<form method="post" action="settest.php">
<input type="text" name="subject" placeholder="Subject">
<input type="text" name="tname" placeholder="Test Name">
<input type="submit" name="next">
</form>

</body>
</html>