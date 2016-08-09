<?php
if(isset($_SESSION['user']))
{
	if(@mysql_connect('localhost','root',''))
	{
		if(@mysql_select_db('db_afterhours'))
		{
			$d=mysql_query('INSERT INTO tbl_messages (sender,receiver,value) VALUES ("'.$userid.'","'.$_POST['upreceive'].'","'.$_POST['newtext'].'")')
		}
	}
}
?>