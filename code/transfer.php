<?php

session_start();
$reg=$_GET['register'];
$subname=$_GET['subname'];
if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{
		$qr=mysql_query("SELECT name FROM tbl_faculty Where register='".$reg."' ");
		while($row=mysql_fetch_assoc($qr))
		{
			$namer=$row['name'];
			$_SESSION['facname']=$namer;
		}
	}
}

$_SESSION['subname']=$subname;

header("Location:thefiles.php");

?>