<?php
session_start();
if(isset($_SESSION['user']))
{
	$reg=$_GET['reg'];
	if(@mysql_connect('localhost','root',''))
	{
		if(@mysql_select_db('db_afterhours'))
		{
			$query1='SELECT * FROM tbl_users WHERE register="'.$reg.'"';
			$query1run=mysql_query($query1);
			if(mysql_num_rows($query1run)>0)
			{
				$a='location:visituserprofile.php?reg='.$reg;
				header($a);
			}
			else
			{
				$query1='SELECT * FROM tbl_faculty WHERE register="'.$reg.'"';
				$query1run=mysql_query($query1);
				if(mysql_num_rows($query1run)>0)
				{
					$a1='location:visitfuserprofile.php?reg='.$reg;
					header($a1);
				}


			}
		}
	}
}
else
header('location:homepage.php');
?>

<html>
<body>
<h1>User Not Found</h1>
</body>
</html>