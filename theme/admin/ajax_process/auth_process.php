<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");
	
	$tmpID = trim($_POST['id']);
	$tmpPW = md5(trim($_POST['pw']));

	$tmpIsUser = $this->FOPO_DB->isExist("select mem_id from mem_list where (mem_id='$tmpID') and (mem_pw='$tmpPW')");
	
	if($tmpIsUser) {		
		$tmpUserData = $this->FOPO_DB->query("select * from mem_list where (mem_id='$tmpID') and (mem_pw='$tmpPW')");
		$tmpUserData = $this->FOPO_DB->fetch($tmpUserData, 1);

		$tmpIsSession = $this->FOPO_DB->isExist("select sess_no from session_list where (mem_no=".$tmpUserData["mem_no"].")");
		if(!$tmpIsSession){
			$arrUser = array(
				"token" => uniqid(),
				"no" => $tmpUserData["mem_no"],
				"id" => $tmpUserData["mem_id"],
				"status" => "true",
				"level" => $tmpUserData["mem_level"],
				"nick" => $tmpUserData["mem_nick"],
				"email" => $tmpUserData["mem_email"],
				"country" => $tmpUserData["mem_country"],
				"phone" => $tmpUserData["mem_phone"],
				"gender" => $tmpUserData["mem_gender"],
				"ip" => $_SERVER['REMOTE_ADDR'],
			);
			
			$tmpIsLogin = $this->FOPO_AUTH->setLogin($arrUser);

			$tmpTokenQuery = $this->FOPO_DB->query("INSERT INTO session_list (mem_no, sess_token, sess_orgdate, sess_lastdate, sess_ip)
																		VALUES (".$arrUser["no"].", '".$arrUser["token"]."', now(), now(), '".$arrUser["ip"]."')");

			$return_array = array("status"=>"succeed", "token"=>$arrUser["token"]);
			echo json_encode($return_array);
		}else{
			$return_array = array("status"=>"exist_session");
			echo json_encode($return_array);
		}
	}else{
		// 로그인 실패
		$return_array = array("status"=>"failed");
		echo json_encode($return_array);
	}
?>