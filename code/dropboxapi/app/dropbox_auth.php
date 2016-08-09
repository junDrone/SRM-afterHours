<?php

if($row['dropbox_token']){
	$client=new Dropbox\Client($row['dropbox_token'],$appName,'UTF-8');
	
}
else{
	$authURI =$webAuth->start();
	header('Location:'.$authURI);
	exit();
}
?>