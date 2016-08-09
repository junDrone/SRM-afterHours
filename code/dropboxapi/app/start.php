<?php


$_SESSION['user_id']=3;
$userid=$_SESSION['user_id'];
require 'dropbox-sdk/dropbox-sdk/lib/Dropbox/autoload.php' ;

$dropboxkey='z5stpofinuebmsx';
$dropboxsecret='n25n9n4r66e2vb0';
$appName='afterhoursdata/1.0';
$appInfo=new Dropbox\AppInfo($dropboxkey,$dropboxsecret);

//store csrf token
$csrfTokenStore= new Dropbox\ArrayEntryStore($_SESSION,'dropbox-auth-csrf-token');

//define auth details
$webAuth = new Dropbox\webAuth($appInfo,$appName,'http://localhost/tuts/dropboxapi/dropbox_finish.php', $csrfTokenStore);



//user details


		if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('ff'))
	{

		$query="SELECT * FROM users WHERE id = '".$userid."' ";
		$query_run=mysql_query($query);
		$row = mysql_fetch_assoc($query_run);
		

		
		
	}
}

?>