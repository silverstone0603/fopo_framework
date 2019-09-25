<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by DongGyun Im,
	Lastest Updated : 19-07-15.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");
	
	if($this->FOPO_AUTH->getStatus()!=="null"){
		// 로그인 되어 있음
		$return_array = array("status"=>"exist_session");
		echo json_encode($return_array);
	} else {
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

				$tmpTokenQuery = $this->FOPO_DB->query("INSERT INTO session_list (mem_no, sess_token, sess_verify, sess_devicetype, sess_orgdate, sess_lastdate, sess_ip) VALUES (".$arrUser["no"].", '".$arrUser["token"]."', 0, 0, now(), now(), '".$arrUser["ip"]."')");
				$tmpLastLogin = $this->FOPO_DB->query("update mem_list set mem_lastlogin = now() where mem_no =  ".$arrUser["no"]);

				$Browser = $this->getLog();
				$tmpLoginLog = $this->FOPO_DB->query("INSERT INTO usrlogin_log (mem_no, usrlog_date, usrlog_ip, usrlog_browse, usrlog_os) values(".$arrUser["no"].", now(),'".$arrUser["ip"]."','".$Browser[0]."','".$Browser[1]."')");

				$return_array = array("status"=>"succeed", "token"=>$arrUser["token"], "mem_no"=>$arrUser["no"], "mem_nick"=>$arrUser["nick"]);
				echo json_encode($return_array);
			} else {
				$return_array = array("status"=>"exist_session");
				echo json_encode($return_array);
			}
		} else {
			// 로그인 실패
			$return_array = array("status"=>"failed");
			echo json_encode($return_array);
		}
	}
?>