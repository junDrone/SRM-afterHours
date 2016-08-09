<?php




if(@mysql_connect('localhost','root','')){
	if(@mysql_select_db('db_afterhours')){



if(isset($_GET['search_text'])){
	$a=$_GET['search_text'];
	
	
}
		
		$query="SELECT * FROM tbl_users WHERE register = '".$a."'";
		$query_run=mysql_query($query);

		$num_rows = mysql_num_rows($query_run);
		if($num_rows > 0){
			echo '1';
		}
		else
			echo ' 2';
	}
}
?>