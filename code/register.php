

<?php
session_start();
if(isset($_SESSION['user']))
{
  header('Location: userprofile.php');
}
else
if(isset($_POST['slogin']))
{
  $uname=$_POST['suser'];
  $upass=md5($_POST['spass']);
  if(@mysql_connect('localhost','root',''))
{
  if(@mysql_select_db('db_afterhours'))
  {

    $query=" SELECT * FROM tbl_users WHERE register = '".$uname."' ";
    $query_run=mysql_query($query);
    while($row = mysql_fetch_assoc($query_run)) 
    {          
        $pass=$row["password"];
        if($upass==$pass)
        {
          $_SESSION['user']=$uname;
          header('Location: userprofile.php');
        }
      }

    
    
  }
}


}


?>



<html>
<head>

<link rel="stylesheet" type="text/css" href="../css/register.css" > 

<script>
function validate() // connects to check.inc  
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
        document.getElementById("rvalue").innerHTML="The register number already exists";
      }
    else
    {
      document.getElementById("rvalue").style.color = "green";
      document.getElementById("rvalue").innerHTML="The register number is available";
    }
    


    }
  }
xmlhttp.open("GET","check.inc.php?search_text="+document.getElementById('regno').value,true);
xmlhttp.send();
}
</script>

</head>
<body >


<div id="mainbody">


<div id="longo">
<div id="logo">
	<h1><b><font color="white"> < </font><font color="red">/</font> </b><font color="white" face="arial black" >SRM</font><font color="white"> afterHours <b>></font></b></h1>
</div>

</div>
<div id="sometext"></div>
<form action="register.php" method="post" name="register">
<div id="reg">

<table style="width:100%">
  <tr>
    <td><br><input type="text" id="regno" class="txtbox" placeholder="  Register No" onblur="validate()"/></td>
    <td><div id="rvalue"></div></td> 
    
  </tr>
  <tr>
    <td><br><input type="text" id="name" class="txtbox" placeholder=" Full Name" /><br></td>
    
  </tr>
  <tr>
    <td><br><input type="text" id="email" class="txtbox" placeholder="  E-Mail" /></td>  
  </tr>
  <tr>
    <td><br><input type="radio" id="student" name="pos" value="student">Student
<input type="radio" id="student" name="pos" value="faculty">Faculty</td>
    <td><div id="rvalue"></div></td> 
    
  </tr>
  <tr>
    <td><br><input type="password" id="pass" class="txtbox" placeholder="  Password" /></td>
    
    
  </tr>
  <tr>
    <td><br><input type="password" id="cpass" class="txtbox" placeholder="  Confirm Password" onblur="passvalidate()"/></td>
    <td><div id="rvalue"></div></td> 
    
  </tr>
  <tr>
    <td><br><input type="text" id="year"  class="smtxtbox" placeholder="Year" />
    <input type="text" id="section" class="smtxtbox"  placeholder="Section" /></td> 
    
  </tr>
  <tr>
    <td>
    <br><input type="submit" name="enter" value="Submit" /></td> 
    
  </tr>
</table>

</div><!--reg-->
</form>


</div><!--mainbody-->

</body>
</html>