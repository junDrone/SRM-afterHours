<?php
session_start();
$useridno=$_SESSION['user_id'];
require 'app/start.php';

list($accessToken)= $webAuth->finish($_GET);

$query="UPDATE users SET dropbox_token = '".$accessToken."' WHERE id='".$useridno."'";
$store=mysql_query($query);
header('Location:index.php');
?>