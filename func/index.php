<?

	function common_error($msg)
	{
		echo('<label style="display:block;overflow-x:hidden; width:100%; text-align:center; margin:0px; line-height:25px; background-color:rgb(125, 0, 192); color:#FFF;font-family:cambria; box-shadow:0px 1px 1px 0px;"><b style="color:#c3cc00;">Problem Detected: </b>'.$msg.'</label>');
	}
	function importfile($file)
	{
		if(file_exists($file)){
			require $file;
			return true;
		}else{
			return false;
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


?>