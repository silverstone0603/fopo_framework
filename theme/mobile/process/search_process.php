<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by EunSeok Oh,
	Lastest Updated : 19-09-11.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$tmpToken = trim($_POST['token']);
	$tmpIsToken = $this->FOPO_DB->isExist("select sess_no from session_list where (sess_token='$tmpToken')");

	if($tmpIsToken){
		$tmpQuery = trim($_POST['query']);
		$tmpIsResult = $this->FOPO_DB->isExist("select zone_placename from phozone_list where zone_placename like '%".$tmpQuery."%'");

		if($tmpIsResult){
			$tmpResult = $this->FOPO_DB->query("select * from phozone_list where zone_placename like '%".$tmpQuery."%'");

			$return_array = array();
			while($row =  $this->FOPO_DB->fetch($tmpResult, 1)){
				$row_array['no'] = $row['zone_no'];
				$row_array['placename'] = $row['zone_placename'];
				array_push($return_array, $row_array);
			}

			if(is_array($return_array)){
				echo json_encode(array('status' => 'results', 'result' => $return_array));
			}else{
				echo json_encode(array('status' => 'no_results'));
			}
		}else{
			// 검색 결과가 없을때
			$return_array = array('status'=>'no_results');
			echo json_encode($return_array);
		}
	} else {
		// 로그인 안되어 있음
		$return_array = array("status"=>"failed");
		echo json_encode($return_array);
	}
?>