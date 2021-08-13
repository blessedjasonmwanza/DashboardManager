<!-- this part of the programm and/or Code is a property of -->
<!--CompoundCode and was designed, Coded From Scratch and maitained by mwanza J. Blessed-->
<!-- email: Mwanzabj@gmail.com-->
<!-- cell: +260-971-943-638 -->
<!-- facebook: www.facebook.com/blessedjasonmwanza -->
<!-- Git-Hub: www.github.com/blessedjasonmwanza -->
<!-- you are not permited to copy or change any of the contents and/or any part of this code by law! -->
<!-- For inquries or help, contact the developer (blessed Jason Mwanza) using the above details -->
<?php
$s = "localhost";
$u = "root";
$p = "";
$db = "admin";
$dbconnection = @mysqli_connect($s, $u, $p);

if ($dbconnection) {
	# code...
	if(@mysqli_select_db($dbconnection, $db)){
		
	}else{
		die("<label style='display:block;overflow-x:hidden; width:99%; text-align:center; margin:0px; line-height:25px; background-color:rgb(125, 0, 192); color:#FFF;font-family:cambria; box-shadow:0px 1px 1px 0px;'><b style='color:#c3cc00;'>Problem Detected: </b>Database not Found... </label>");
	}
}else{
	die("<label style='display:block;overflow-x:hidden; width:99%; text-align:center; margin:0px; line-height:25px; background-color:rgb(125, 0, 192); color:#FFF;font-family:cambria; box-shadow:0px 1px 1px 0px;'><b style='color:#c3cc00;'>Problem Detected: </b>server connection failure... </label>");
}
?>
