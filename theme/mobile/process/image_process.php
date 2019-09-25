<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$tmpBrdNo = trim($_GET["no"]);
	$db_object = $this->FOPO_DB;
	$tmpQuery = $db_object->query("SELECT phozone_article.brd_no, phozone_files.file_savename FROM phozone_article, phozone_files
										WHERE (phozone_article.brd_no=phozone_files.brd_no) and (phozone_article.brd_no=".$tmpBrdNo.")");

	$arrPhoto = $db_object->fetch($tmpQuery,1);

	if ($arrPhoto) {		
		$file_name = $this->root_path."/uploads/users/".$arrPhoto["file_savename"];
		
		if(file_exists($file_name)){
			$file_extension = strtolower(substr(strrchr($arrPhoto["file_savename"],"."),1));
			switch( $file_extension ) {
				case "png": $ctype="image/png"; break;
				case "jpeg":
				case "jpg": $ctype="image/jpeg"; break;
				default:
			}
			header('Content-type: ' . $ctype);
			$im = file_get_contents($file_name);
			echo $im;
		}else{
			header('Content-type: image/png');
			$im = file_get_contents($this->root_path."/uploads/system/fopo_sys_error_img.png");
			echo $im;
		}
	}else{
		header('Content-type: image/png');
		$im = file_get_contents($this->root_path."/uploads/system/fopo_sys_error_img.png");
		echo $im;
	}

?>