
<?php include 'core.php'; ?>
<!DOCTYPE html>
<!-- this part of the programm and/or Code is a property of CompoundCode and was designed, Coded From Scratch and maitained by mwanza J. Blessed-->
<!-- email: Mwanzabj@gmail.com-->
<!-- cell: +260-971-943-638 -->
<!-- facebook: www.facebook.com/blessedjasonmwanza -->
<!-- Git-Hub: www.github.com/blessedjasonmwanza -->
<!-- Linkedin: www.linkedin.com/in/blessedjasonmwanza -->

	<link href="compoundcode.png" rel="icon" type="image/png" />
	<link href="compoundcode.jpg" rel="icon" type="image/jpg" />
	<link rel="stylesheet" type="text/css" href="mwanza/web-fonts-with-css/css/fontawesome-all.css">  
  	<link rel="stylesheet" type="text/css" href="mwanza2/css/font-awesome.css">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0 ">
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  	<meta name="referrer" content="default" id="meta_referrer">
  	<meta property="og:url"           content="DashboardManager" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Dashboard Manager" />
	<meta property="og:description"   content="Welcome to One of the website by Compounde Code" />
	<meta property="og:image"         content="compoundcode.jpg" />

<?php
	function common_error($msg)
	{
		echo('<label style="display:block;overflow-x:hidden; width:100%; text-align:center; margin:0px; line-height:25px; background-color:rgb(125, 0, 192); color:#FFF;font-family:cambria; box-shadow:0px 1px 1px 0px;"><b style="color:#c3cc00;">Problem Detected: </b>'.$msg.'</label>');
	}
	function report($msg)
	{
		echo('<label style="display:block;overflow-x:hidden; width:100%; text-align:center; margin:0px; line-height:25px; background-color:rgba(0, 132, 192, 1) !important; color:#FFF;font-family:cambria; box-shadow:0px 1px 1px 0px;"><b style="color:#c3cc00;">Report: </b>'.$msg.'</label>');
	}
	function deletemsg($msg, $link, $link2)
	{
		echo('<label style="display:block;overflow-x:hidden; width:100%; text-align:center; margin:0px; line-height:25px; background-color:rgba(0, 55, 192, 1) !important; color:#FFF;font-family:cambria; box-shadow:0px 1px 1px 0px;"><b style="color:#c3cc00;">Confirm: </b>'.$msg.'<a href="'.$link.'" style="color:#fff;background-color:#c80000; font-weight:bold;border-radius:2px;padding:3px;margin-left:5px; height:inherit; margin-bottom:-1px;"><i class="fa fa-check"></i>&nbsp; yes &nbsp;</a><a href="'.$link2.'" style="color:#fff; background-color:rgb(11, 192, 192); padding:5px; margin-left:5px;font-weight:bold;border-radius:2px; height:inherit; margin-bottom:-1px;  text-align:center;"><i class="fa fa-times"></i>&nbsp; No &nbsp; </a></label>');
	}
	function importfile($file)
	{
		if(file_exists($file)){
			@require $file;
			return true;
		}else{
			return false;
		}
	}

	
function searchmsgb4delete($d2d)
	{
		
		@include 'connec.php';
		$msgs = "SELECT * FROM `messages` WHERE id2 = '$d2d'";
		$msgq = mysqli_query($dbconnection, $msgs);
		$msgcount = mysqli_num_rows($msgq);
		if ($msgcount == true && $msgcount > 0) {
			$msgcount > 1 ? report($msgcount.' Results Where found...') : report($msgcount.' Result was found...');
	
			while ($msgdata = mysqli_fetch_assoc($msgq)) {
				$id = $msgdata['id'];
				$token =$msgdata['id2'];
				$token2 =$msgdata['id2'];
				$from = $msgdata['frm'];
				$msg = $msgdata['msg'];
				$date = $msgdata['date'];
				echo '<div id="s1results">
				<label class="from"> From: </label> <label class="name"><b>'.$from.'</b></label> <label class="date">'.$date.'</label><br>
				<label class="body">'.nl2br(htmlentities($msg)).'<br>
				<a href="?page=messages&re='.$token.'" class="reply"> <i class="fa fa-reply"></i> Read </a>
				<a href="?page=messages&d='.$token.'" class="delete"> <i class="fa fa-times"></i> Delete </a>
				</label>
				
			</div><br><br>';
			}
			echo '</div>';
		}else{
			report("Message not found...");
		}
	}



	function  import_css_file($file, $msg)
	{
			echo '<style type="text/css">';
			$header_style = importfile($file);
		echo '</style>';

		if($header_style){
			
		}else{
			die(common_error($msg));
		}
	}

	function visitors()
	{
		@include 'connec.php';
		echo @mysqli_num_rows(@mysqli_query($dbconnection, "SELECT * FROM `visitors`"));
	}

	function msgtotal()
	{
		@include 'connec.php';
		echo @mysqli_num_rows(@mysqli_query($dbconnection, "SELECT * FROM `messages`"));
	}
	
	function searchmsg($from/*,$date*/)
	{
		
		@include 'connec.php';
		$msgs = "SELECT * FROM `messages` WHERE frm LIKE '$from%'";
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
				$token =$msgdata['id2'];
				$token2 =$msgdata['id2'];
				$from = $msgdata['frm'];
				$msg = $msgdata['msg'];
				$date = $msgdata['date'];
				echo '<div id="s1results">
				<label class="from"> From: </label> <label class="name"><b>'.$from.'</b></label> <label class="date">'.$date.'</label><br>
				<label class="body">'.nl2br(htmlentities($msg)).'<br>
				<a href="?page=messages&re='.$token.'" class="reply"> <i class="fa fa-reply"></i> Read </a>
				<a href="?page=messages&d='.$token.'" class="delete"> <i class="fa fa-times"></i> Delete </a>
				</label>
				
			</div><br><br>';
			}
			echo '</div>';
		}else{
			report('No results Where found...');
		}
	}

	function readmsg()
	{
		$id2 = md5(md5($id));
		include 'connec.php';
		$msgs = "SELECT * FROM `messages` ORDER BY id DESC";
		$msgq = mysqli_query($dbconnection, $msgs);
		$msgcount = mysqli_num_rows($msgq);
		if ($msgcount > 0) {
			echo '<div id="inbox">';
			while ($msgdata = mysqli_fetch_assoc($msgq)) {
				$id = $msgdata['id'];
				$token =$msgdata['id2'];
				$from = $msgdata['frm'];
				$msg = $msgdata['msg'];
				$date = $msgdata['date'];
				$token2 =$msgdata['token'];
				
				echo '<div id="s1results">
				<label class="from"> From: </label> <label class="name"><b>'.$from.'</b></label> <label class="date">'.$date.'</label><br>
				<label class="body">'.nl2br(htmlentities($msg)).'<br>
				<a href="?page=messages&re='.$token.'" class="reply"> <i class="fa fa-reply"></i> Reply </a>
				<a href="?page=messages&d='.$token.'" class="delete"> <i class="fa fa-times"></i> Delete </a>
				</label>
				
			</div><br><br>';
			}
			echo '</div>';
		}else{
			report($msgcount.' You currently have no message in your inbox.');
		}
	}
?>

<?php
	import_css_file('meka/header.css', "Styling file is Missing...");
	import_css_file('meka/index.css', "Styling file is Missing...");

?>

<center>
<label class="title">
	<i class="fa fa-dashboard fa-dashboardlabel" style="float: left;"> <b style="font-family: 'cambria math', cambria, serif;"><?php echo $AppName; ?></b> </i>  
	<div class="titleimg" align="right">
		<img src="compoundcode.png">
		<label class="mn">
			<a href="http://localhost/DashboardManager/"><i class="fa fa-dashboard"></i> Dashboard</a>
			<a href="#"> <i class="fa fa-user" style="margin-right: 10px;"></i> Account </a>
			<a href="#"><i class="fa fa-sign-out"></i> Sign Out</a>

		</label>

	</div>
</label>
</center>
<body>


	<div id="mob">
		<a href="http://localhost/DashboardManager/" 
		<?php 
		if (empty(@$_GET['page']) || !@$_GET['page']) {
			echo 'class="ac"';}
		?> 
		><i class="fa fa-desktop"></i> Dashboard </a>
		<a href="#"> <i class="fa fa-globe"></i> website</a>
		<a href="#"> <i class="fa fa-lock"></i> Account</a>
		<a href="#"> <i class="fa fa-users"></i> Users </a>
		<a href="#"> <i class="fa fa-arrows"></i> Visitors </a>
		<a href="#"> <i class="fa fa-sitemap"></i> Admins </a>
		<a href="#"> <i class="fa fa-file"></i> Files </a>
		<a href="#"> <i class="fa fa-inbox"></i> Inbox </a>
		<a href="#"> <i class="fa fa-bell"></i> Notifications </a>
		<a href="#"> <i class="fa fa-rss"></i> Feed </a>
		<a href="#"> <i class="fa fa-facebook-square"></i> Facebook </a>
		<a href="#"> <i class="fa fa-twitter"></i> Twitter </a>
		<a href="#"> <i class="fa fa-linkedin"></i> Linked In </a>
		<a href="#"> <i class="fa fa-plus"></i> Option2 </a>
		<a href="#"> <i class="fa fa-plus"></i> Option3 </a>
		<a href="#" style="border-bottom-color: transparent;"> <i class="fa fa-plus"></i> Option4 </a>
	</div>
	<div id="des">

		<label class="hdlb"><i class="fa fa-th"> </i> Dashboard :  <i class="fa fa-clock-o"> <?php echo date('l, j'); echo '<sup>';echo date('S');echo'</sup>'; echo date(' F, Y');?></i></label>
		<?php
		if(!empty($page = @$_GET['page'])){
			$page = @$_GET['page'];
		}else{
			$page = @$_POST['page'];
		}
		@include 'connec.php';

		if (!empty($page)) {
				$q1 = "SELECT * FROM `admin`.`pages` WHERE page = '".@mysqli_escape_string($dbconnection, $page)."' LIMIT 1";
				if($p = @mysqli_query($dbconnection, $q1)){
					if (@mysqli_num_rows($p) == 1) {
								$pdata = @mysqli_fetch_assoc($p);
								$pagetitle = $pdata['title'];
								$pagename = $pdata['page'];
							if(@importfile(@$page.'.php')){
								echo "<title>".$pagename." : ".$pagetitle."</title>";
							}else{
								
								echo "<title>".$pagename." : ".$pagetitle."</title>";
								common_error("The File for this Page might have been deleted or Removed from the server...");

							}
					}else{
						@common_error(@"Page not found...");
						echo "<title>Error</title>";
					}	
				}else{
					@common_error(@"Could not fetch pages...");
					echo "<title>Error</title>";
				}
		}else{
			if(@importfile(@'main.php')){
				echo "<title>Dashboard Manager</title>";
			}else{
				@common_error(@"Dashboard files are missing...");
			}
		}
		

		?>
	</div>
</body>


<footer style="line-height: initial; margin-top: 5px; height: inherit; background-color: rgba(233, 233, 233, 0.2); display: inline-block; width: 100%; text-align: center;">
	<center>
		<font style="color: #999999; text-decoration: none; font-family: 'cambria';">

			<hr style="border-color: rgba(245, 245, 245, 0.05); width: 100%; margin-bottom: 0px;">
		 &copy;<?php echo date('Y').' '.$AppName ;?>   </font>

		 <font style="color: #c3c3c3; text-decoration: none; font-family: 'cambria';">

		 Developed & Designed by  </font> <a href="https://facebook.com/blessedjasonmwanza" style="text-decoration: none; color: #333333; font-weight: bold; font-family: 'cambria';"> Mwanza J. Blessed </a></center>
</footer>
</body>
</html>