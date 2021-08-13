<!-- <link href='https://fonts.googleapis.com/css?family=Bungee Inline' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Baloo Thambi' rel='stylesheet'> -->
<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
<?php
@import_css_file(@'meka/visitors.css','Styling file is missing from your local Drive...');


?>
<center>
	<a href="#">
	<div id="vpanel" class="vpanel1">
	<label class="tag"><i class="fa fa-globe fa-4x"></i><br>  <?php visitors();?></label>
	<label class="info" >Total Visitors</label>
	</div>
</a>

<a href="#">
	<div id="vpanel">
	<label class="tag"><i class="fa fa-calendar fa-4x"></i><br> 3, 344</label>
	<label class="info">This Month</label>
	</div>
</a>
<center>
	<a href="#">
	<div id="vpanel" class="vpanel1">
	<label class="tag"><i class="fa fa-bar-chart fa-4x"></i><br>  294, 566</label>
	<label class="info" >Monthly Average</label>
	</div>
</a>

<a href="#">
	<div id="vpanel">
	<label class="tag"><i class="fa fa-pie-chart fa-4x"></i><br> 3, 344</label>
	<label class="info">daily Average</label>
	</div>
</a>
</center>
