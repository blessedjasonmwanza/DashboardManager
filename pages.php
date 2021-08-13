<?php
@import_css_file(@'meka/msg.css','Messages Styling file is missing...');

function searchpage($pagename/*,$date*/)
	{
		
		@include 'connec.php';
		$msgs = "SELECT * FROM `pages` WHERE page LIKE '%$pagename%'";
		$msgq = mysqli_query($dbconnection, $msgs);
		$msgcount = mysqli_num_rows($msgq);
		if ($msgcount > 0) {
			echo '<div id="inbox">';
			if ($msgcount > 1) {
				report($msgcount.' Results Where found...');
			}elseif ($msgcount == 1) {
				report($msgcount.' Result was found...');
			}
			while ($msgdata = mysqli_fetch_assoc($msgq)) {
				$id = $msgdata['id'];
				$token =md5($id);
				$token2 =md5($token);
				$pagename = $msgdata['page'];
				
				$date = $msgdata['date'];
				echo '<div id="s1results">
				<label class="from"> Page: </label> <label class="name"><b>'.$pagename.'</b></label> <label class="date">'.$date.'</label><br>
				<label class="body">'.nl2br(htmlentities($msg)).'<br>
				<a href="?page=pages&re='.$token.'" class="reply"> <i class="fa fa-reply"></i> Read </a>
				<a href="?page=pages&d='.$id.'" class="delete"> <i class="fa fa-times"></i> Delete </a>
				</label>
				
			</div><br><br>';
			}
			echo '</div>';
		}else{
			report('No results Where found...');
		}
	}
?>

<form id="s1"  action=<?php echo '?page='.@$_GET['page']; ?> method="POST">
	<legend style="text-align: center;"><i class="fa fa-search" style="color: #c3c3c3; font-size: small;"></i> Find <i class="fa fa-" style="color: #c3c3c3; font-size: small;"> A Page</i> </legend>
	<input type="hidden" name="page" value="masseges">
	<input type="search" name="find-u" placeholder="Search by page name">
	<input type="hidden" name="find-d" placeholder=" Deactivated: Search by date exampl: 12 May, 2018" readonly="">
	<input type="submit" name="find-ud" value="Search">
</form>

<?php

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
	searchpage();
}

?>