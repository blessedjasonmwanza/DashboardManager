<?php
@import_css_file(@'meka/msg.css','messages Styling file is missing...');

?>
<form id="s1"  action=<?php echo '?page='.@$_GET['page']; ?> method="POST">
	<legend style="text-align: center;"><i class="fa fa-search" style="color: #c3c3c3; font-size: small;"></i> Search <i class="fa fa-" style="color: #c3c3c3; font-size: small;"> in messages</i> </legend>
	<input type="hidden" name="page" value="messages">
	<input type="search" name="find-u" placeholder="Search by username">
	<input type="hidden" name="find-d" placeholder=" Deactivated: Search by date exampl: 12 May, 2018" readonly="">
	<input type="submit" name="find-ud" value="Search">
</form>
<hr style="width: 100%; color: rgba(192, 192, 192, 0.3);">
<?php
if (!empty($_GET['d'])) {
	@include 'connec.php';
	$d = mysqli_escape_string($dbconnection, $_GET['d']);
	$msgs = "SELECT * FROM `messages` WHERE `id2` = '$d' LIMIT 1";
		$msgq = mysqli_query($dbconnection, $msgs);
		$msgcount = mysqli_num_rows($msgq);
		if ($msgcount > 0) {
			$msgdata = mysqli_fetch_assoc($msgq);
				$id = $msgdata['id'];
				$token =$msgdata['id2'];
				$from = $msgdata['frm'];
				$msg = $msgdata['msg'];
				$date = $msgdata['date'];
				$token2 =$msgdata['token'];
				if (!empty($_GET['d']) && !empty($_GET['token'])) {
					$d2 = mysqli_escape_string($dbconnection, $_GET['d']);
					$t = mysqli_escape_string($dbconnection, $_GET['token']);
					$msgs2 = "DELETE  FROM `messages` WHERE `messages`.id2 = '$d2' AND `messages`.token = '$t' LIMIT 1";
					if(mysqli_query($dbconnection, $msgs2)){
						report('Message Successfully Deleted. <a href="http://localhost/admin/?page=messages" style="color:#fff; background-color:rgb(11, 192, 192); padding:5px; margin-left:5px;font-weight:bold;border-radius:2px; height:inherit; margin-bottom:-1px;  text-align:center;"><i class="fa fa-back"></i>&nbsp; Return to inbox &nbsp; </a>');
						exit();
					}else{
						report("Message could not be deleted.");
						echo $d2.'<br>'.$t;
					}
				}
			}else{
				report("Message not found");
				exit();
			}
	deletemsg("Are you sure you want to delete this Message from <b>".$from."</b> ?", @'?page=messages&d='.$_GET['d'].'&token='.$token2, '?page=messages&re='.$_GET['d'] );
	searchmsgb4delete($_GET['d']);
	exit();
}
if (isset($_POST['find-ud']) ){
	$zu1 = $_POST['find-u'];
	$zu = str_replace(' ', '', $zu1);
	$zd1 = $_POST['find-d'];
	$zd = str_replace(' ', '', $zd1);
	if (strlen($zu)>2/* ||strlen($zd)>2*/){
		searchmsg($zu1/*, $zd1*/);
	}else{
		common_error('Keywords must not be less than two(2) Characters long...');
	}
}else{
	readmsg();
}



?>





	





