<?php
		$s = "localhost";
		$u = "root";
		$p = "";
		$db = "admin";
		$dbconnection = mysqli_connect($s, $u, $p);
		mysqli_select_db($dbconnection, $db);
?>