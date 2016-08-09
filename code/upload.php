<?php
session_start();
error_reporting(0);
require 'database/connect.php' ;
$register=$_SESSION['user'];
function user_image($filetemp){
	$reg=$_SESSION['user'];
	$file_path='../images/profile/'.$reg.'.jpg';
	if(file_exists('../images/profile/'.$reg.'.jpg'))
		unlink('../images/profile/'.$reg.'.jpg');
	
	copy($filetemp,$file_path);
}

if(isset($_FILES['profile'])===true)
	{
		if(empty($_FILES['profile']['name'])===true)
		echo 'select a file';
		else
		{
			$allowed=array('jpg','png','gif','jpeg');
			$filename=$_FILES['profile']['name'];
			$fileextn=strtolower(end(explode('.',$filename)));
			$filetemp=$_FILES['profile']['tmp_name'];
			

			if(in_array($fileextn,$allowed)===true)
			{
				user_image($filetemp);
				if($update = $db->query("UPDATE tbl_users SET profile='".$register."' WHERE register='".$register."'" ))
						{
							header('Location: userprofile.php');
						}
				
			}
			else{

				echo 'Invalid file format';
				echo '   Allowed formats:'. implode(', ',$allowed);
			}
		}

	}
?>

