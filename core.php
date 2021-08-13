<?php

ob_start();
session_start();
$current_file = @$_SERVER[@'SCRIPT_NAME'];
$back = @$_SERVER[@"HTTP_REFERER"];
function logedin()
{
	if (@isset($_SESSION[@'ses']) && !empty($_SESSION[@'ses'])) {
		# code...
		return true;
	}else{
		return false;
	}
}

function ip()
{
	# code..
	$client_ip = @$_SERVER['HTTP_CLIENT_IP'];
	$fwd = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote = @$_SERVER['REMOTE_ADDR'];
	if (!empty($client_ip)) {
		$ip_adress = $client_ip;
		return $ip_adress;
	}elseif(!empty($fwd)){
		$ip_adress = $fwd;
		return $ip_adress;
	}else{
		$ip_adress = $remote;
		return $ip_adress;
	}
}

$s = "localhost";
$u = "root";
$p = "";
$db = "admin";
$conn = @mysqli_connect($s, $u, $p);
if ($conn) {
	if(@mysqli_select_db($conn, $db)){
		$newip = ip();
		$fp = "SELECT * FROM visitors WHERE ip = '$newip'";
		$fpq = mysqli_query($conn, $fp);
		if (@mysqli_num_rows($fpq) < 1) {
			$newip = ip();
			$newip = $newip;
			$stime = date("@ h:i A")." on ".date("jS F Y");
			$aq = "INSERT INTO `visitors` (`id`, `ip`, `date`) VALUES (NULL, '$newip', '$stime')";
			$addn = mysqli_query($conn, $aq) ;
			if($addn){
				//SUCCESSFULLY ADDED NEW IP
			}else{
				//COULD NOT ADD IP
			}

		}else{
			//IP ALREADY IN THE DB
		}
	}else{
		if (mysqli_query($conn, "CREATE DATABASE $db")) {
			@report(@'New Database created SUCCESSFULLY!');
		}else{
		@common_error(@'The System failed to create a New Database. This might be due to incorrect Server Authetication Information Suplied.');
		}
	}
	# code...
	

}else{
	die("<label style='display:block;overflow-x:hidden; width:99%; text-align:center; margin:0px; line-height:25px; background-color:rgb(125, 0, 192); color:#FFF;font-family:cambria; box-shadow:0px 1px 1px 0px;'><b>ERROR : </b> Could not connnect to the server... </label>");
}

function is_connected()
{
    $connected = @fsockopen("www.amabine.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}
if (is_connected()) {
	if (empty($_SESSION['connected'])) {
		session_start();
        $_SESSION['connected'] = md5('connectedn');
        @report(@"you are connected to the internet");
	}else{
		session_start();
        $_SESSION['connected'] = md5('connectedn');
	}
	
}else{
    unset($_SESSION["connected"]); 
	@common_error(@"You have no internet connection...");
	
}

global $AppName; $AppName = 'Dashboard Manager v1.0 [ALPHA] '

?>