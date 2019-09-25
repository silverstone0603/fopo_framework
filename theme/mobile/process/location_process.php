<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by EunSeok Oh,
	Lastest Updated : 19-08-14.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$tmpToken = trim($_POST['token']);
	if($this->FOPO_AUTH->getStatus()!=="null" || $tmpToken!==""){
		$tmpIsSession = $this->FOPO_DB->isExist("select sess_no from session_list where (sess_token=".$tmpToken.")");
		if(!$tmpIsSession){
			$tmpZoneList = $this->FOPO_DB->query("select * from phozone_list");

			$arrReturn = array();
			//array_push($arrReturn, array("status"=>"success"));

			while($row = $this->FOPO_DB->fetch($tmpZoneList, 1)){
				$arrTemp['zone_no'] = $row['zone_no'];
				$arrTemp['mem_no'] = $row['mem_no'];
				$arrTemp['zone_placename'] = $row['zone_placename'];
				$arrTemp['zone_regdate'] = $row['zone_regdate'];
				$arrTemp['zone_x'] = $row['zone_x'];
				$arrTemp['zone_y'] = $row['zone_y'];
				array_push($arrReturn, $arrTemp);
			}

			if(is_array($arrReturn)){
				echo json_encode($arrReturn);
			}else{
				$arrReturn = array("status"=>"failed");
				echo json_encode($arrReturn);
			}
		} else {
			$arrReturn = array("status"=>"failed");
			echo json_encode($arrReturn);
		}
	} else {
		$arrReturn = array("status"=>"failed");
		echo json_encode($arrReturn);
	}
?>