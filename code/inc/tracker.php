<?php
session_start();
$d=1;
if($_SESSION['user'])
{
	if($_SESSION['position']=='s')
	{
		$subname=$_SESSION['subname'];
		if(@mysql_connect('localhost','root',''))
		{
			if(@mysql_select_db('db_afterhours'))
			{	
				$query='SELECT * FROM tbl_hitcounter where subject="'.$subname.'"';
				if(mysql_num_rows(mysql_query($query))==1)
				{
					$row=mysql_fetch_assoc(mysql_query($query));
					$d=$row['no']+1;
					$query1='UPDATE tbl_hitcounter SET no="'.$d.'" WHERE subject="'.$subname.'"';
					if(mysql_query($query1))
						{
							echo  "<script type='text/javascript'>";
							echo "window.close();";
							echo "</script>";
						}
				}
				else
				{
					if($update = mysql_query('INSERT INTO tbl_hitcounter(subject,no) values ("'.$subname.'","'.$d.'")'))
					{
							echo  "<script type='text/javascript'>";
							echo "window.close();";
							echo "</script>";
					}

				}
			}
		}
	}
	else{
		echo  "<script type='text/javascript'>";
		echo "window.close();";
		echo "</script>";
	}
}
else
{
	echo  "<script type='text/javascript'>";
	echo "window.close();";
	echo "</script>";
}

?>