<?php
session_start();
$userid=$_SESSION['user'];



function user_image($filetemp,$fileextn,$given_name){
	
	$file_path='../userdata/'.$given_name.'.'.$fileextn;
	
	if(move_uploaded_file($filetemp,$file_path))
		{
			$_SESSION['fnumber']=$_SESSION['fnumber']+1;
			return 1;
		}
	else
		return 2;
	
}

if(isset($_FILES['profile'])===true)
	{	$given_name=$_POST['filenames'];
$sub_name=$_POST['subject'];
$topic=$_POST['topic'];
		if(empty($_FILES['profile']['name'])===true)
		echo 'select a file';
		else
		{
			$allowed=array('pdf','doc','docx');
			$filename=$_FILES['profile']['name'];
			$fileextn=strtolower(end(explode('.',$filename)));
			$filetemp=$_FILES['profile']['tmp_name'];
			$savename=$given_name.'.'.$fileextn;

			if(in_array($fileextn,$allowed)===true)
			{
				$val=(user_image($filetemp,$fileextn,$given_name));
				if($val==1)
				{
						if(@mysql_connect('localhost','root',''))
						{
							if(@mysql_select_db('db_afterhours'))
							{

								if($update = mysql_query('INSERT INTO tbl_notes(register,subject,filename) values ("'.$userid.'","'.$sub_name.'","'.$savename.'")'))
								
								$tickerupdate = mysql_query("INSERT INTO tbl_ticker values ('".$userid."','".$sub_name."','Upload','".$topic."')");
								if($fileupdate = mysql_query("UPDATE tbl_faculty SET fnumber='".$_SESSION['fnumber']."' WHERE register='".$userid."'" ))
								{
								header('Location:allfiles.php');}

							}
						}
						
				
				}
			
				
			}
			else{

				echo 'Invalid file format';
				echo '   Allowed formats:'. implode(', ',$allowed);
			}
		}

	}
?>

<html>
<head>


<script>
function searchdb() // connects to check.inc  
{
  

var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      if(xmlhttp.responseText=='1')
      {
        document.getElementById("rvalue").style.color = "red";
        document.getElementById("rvalue").innerHTML="The file name number already exists";
      }
    else
    {
      document.getElementById("rvalue").style.color = "green";
      document.getElementById("rvalue").innerHTML="This file name number is available";
    }
    


    }
  }
xmlhttp.open("GET","inc/file_check.inc.php?search_text="+document.getElementById('file_name').value,true);
xmlhttp.send();
}
</script>


<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<script src="javas/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/check2.css">
</head>

<body>
<div id="titlebar">

<div id="logo"><font color="white">< <font color="red">/</font> SRM afterHOURS ></font></div>


</div><!--titlebar-->


<div id="upbody">

<div id="upbodyhead">Upload Files<span style="float:right;" class="glyphicon" aria-hidden="true"><img src="../images/upload.png" style="margin-right:10px;height:25px; width:25px;"></span></div>


	<form action="check2.php" method="post" enctype="multipart/form-data">
    <input type="text" class="txtbox" placeholder="File Name" id="file_name" onkeyup="searchdb()" onblur="searchdb()" name="filenames">
    	
    <input type="text" class="txtbox" name="subject" placeholder="Subject">
    <input type="text" class="txtbox" name="topic" placeholder="topic">
 	<input type="file" id="filebtn" name="profile">
 	<input type="submit" class="btn" value="Upload">
	</form>


</div>
<div id="rvalue"></div>
</body>
</html>

