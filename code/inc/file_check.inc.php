<?php




if(@mysql_connect('localhost','root','')){
	if(@mysql_select_db('db_afterhours')){



if(isset($_GET['search_text'])){
	$a=$_GET['search_text'];
	$apdf=$a.'.pdf';
	$adoc=$a.'.doc';
	$adocx=$a.'.docx';
	
}
		
		$query="SELECT * FROM tbl_notes  WHERE filename = '".$apdf."' OR filename = '".$adoc."' OR filename = '".$adocx."'       ";
		$query_run=mysql_query($query);

		$num_rows = mysql_num_rows($query_run);
		if($num_rows > 0){
			echo '1';
		}
		else
			echo '2';
	}
}
?>