<?php

	if(isset($_POST['flogin']))
{
	$uname=$_POST['fuser'];
	$upass=md5($_POST['fpass']);
	if(@mysql_connect('localhost','root',''))
{
	if(@mysql_select_db('db_afterhours'))
	{

		$query="SELECT * FROM tbl_faculty WHERE register = '".$uname."' ";
		$query_run=mysql_query($query);
		while($row = mysql_fetch_assoc($query_run)) 
		{          
        $pass=$row["password"];
        if($upass==$pass)
        {
        	$_SESSION['fuser']=$uname;
        	header('Location: fuserprofile.php');
        }
    	}

		
		
	}
}


}


?>