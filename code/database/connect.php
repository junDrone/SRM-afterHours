<?php

$db= new mysqli('localhost','root','','db_afterhours');

if($db->connect_errno)
{
	die('Server issues');
}

?>