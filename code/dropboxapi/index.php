<?php
session_start();
$filename=$_GET['file'];
require'app/start.php';
require 'app/dropbox_auth.php';

//upload files

//$file=fopen('files/us.png','rb');
//$size= filesize('files/us.png');

//$client->uploadFile('us.png',Dropbox\WriteMode::add(),$file,$size); 


//download files
$client->getFile('/titan.png',fopen('E:\\'.$filename,'wb'));
header('Location:../fuserprofile.php')
?>

