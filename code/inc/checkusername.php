<?php

session_start();

$q2="SELECT * from tbl_users WHERE register='".$regis."'";
				$q3="SELECT * from tbl_faculty WHERE register='".$regis."'";
				if(mysql_num_rows(mysql_query($q2))>0)
					{while($dd=mysql_fetch_assoc(mysql_query($q2)))
						$regisname=$dd['name'];
						header('location:messages.php?reg="'.$regis.'"');}

				else
					{while($dd=mysql_fetch_assoc(mysql_query($q3)))
						$regisname=$dd['name'];
						header('location:messages.php?reg="'.$regis.'"');	}

?>