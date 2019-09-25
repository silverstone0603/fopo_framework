<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-07-26.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$auth_type = trim($_POST['type']);

	if(!isset($auth_type) || $auth_type!==""){
		switch ($auth_type) {
			case "web_login":
				$auth_id = trim($_POST['id']);

				web_login($this->FOPO_DB, $auth_id);
				break;
			case "web_auth":
				//$sess_token = trim($_POST['sess_token']);
				$mem_no = trim($_POST['mem_no']);
				$sess_devicetype = trim($_POST['sess_devicetype']);

				web_auth($this->FOPO_DB, $mem_no, $sess_devicetype);
				break;
			case "web_verify":
				$auth_id = trim($_POST['id']);
				$sess_verify = trim($_POST['verify']);

				web_verify($this->FOPO_AUTH, $this->FOPO_DB, $this->getLog(), $auth_id, $sess_verify);
				break;
			case "auth_check":
				$sess_no = trim($_POST['sess_no']);

				auth_check($this->FOPO_DB, $sess_no);
				
				break;
			case "testim":
				$sess_no = trim($_POST['sess_no']);
				
				testim($this->FOPO_DB, $sess_no);
				break;
			default:
				echo "{\"type_error\"}";
				break;
		}
	}

	function web_login($db_object, $auth_id) {
		$db_object->query("delete from session_list where (sess_devicetype=1) AND (mem_no = (select mem_no from mem_list where mem_id='$auth_id'));");

		$tmpSessionData = $db_object->fetch($db_object->query("select session_list.sess_no, session_list.sess_token, mem_list.mem_no from session_list, mem_list where session_list.mem_no = mem_list.mem_no AND session_list.mem_no = (select mem_no from mem_list where mem_id='$auth_id');"), 1);

		if ( $tmpSessionData['sess_no'] > 0 ) { // 인덱스가 0이상 일경우 (칼럼이 있으면..)
			$mem_no = $tmpSessionData['mem_no'];
			//$sess_token = $tmpSessionData['sess_token'];
			$sess_token = uniqid();
			$rand_num = sprintf('%04d', rand(1000, 9999)); // 랜덤 4자리수 생성 ( 맨앞자리 0이면 db에 insert할시 0이 짤림.. 나중에 해결)
			$user_ip = $_SERVER['REMOTE_ADDR'];

			$tmpTokenQuery = $db_object->query("INSERT INTO session_list (mem_no, sess_token, sess_verify, sess_devicetype, sess_orgdate, sess_lastdate, sess_ip) VALUES (".$mem_no.", '".$sess_token."', $rand_num, 1, now(), now(), '".$user_ip."')");

			$return_array = array("status"=>"succeed");
			echo json_encode($return_array);
		}else{
			$return_array = array("status"=>"not_exist_session");
			echo json_encode($return_array);
		}
	}

	function web_auth($db_object, $mem_no, $sess_devicetype) {
		$sql = $db_object->fetch($db_object->query("select sess_no, sess_verify from session_list where sess_devicetype=$sess_devicetype and sess_is=0 and mem_no='$mem_no'"), 1);

		if ( $sql['sess_no'] > 0 ) {
			$return_array = array("status"=>"exist_auth", "sess_no"=>$sql["sess_no"], "sess_verify"=>$sql["sess_verify"]);
			echo json_encode($return_array);
		} else {
			$return_array = array("status"=>"not_exist_session");
			echo json_encode($return_array);
		}
	}

	function web_verify($auth_object, $db_object, $str_log, $auth_id, $sess_verify) {
		$sql = $db_object->fetch($db_object->query("select * from session_list where (mem_no = (select mem_no from mem_list where mem_id='$auth_id')) and (sess_verify=$sess_verify)"), 1);
		
		// 세션 생성 시간으로부터 5분 이내인지 아닌지 확인 해야함

		if (count($sql) > 1) {
			$tmpUserData = $db_object->fetch($db_object->query("select * from mem_list where (mem_id='$auth_id')"), 1);
			
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
			
			$tmpIsLogin = $auth_object->setLogin($arrUser);
			$tmpLastLogin = $db_object->query("update mem_list set mem_lastlogin = now() where mem_no =  ".$arrUser["no"]);
			
			$Browser = $str_log;
			$tmpLoginLog = $db_object->query("INSERT INTO usrlogin_log (mem_no, usrlog_date, usrlog_ip, usrlog_browse, usrlog_os) values(".$arrUser["no"].", now(),'".$arrUser["ip"]."','".$Browser[0]."','".$Browser[1]."')");

			$db_object->query("UPDATE session_list set sess_verify = 0 where mem_no = " . $arrUser['no'] .  " and sess_devicetype=1;");

			$return_array = array("status"=>"succeed");
			echo json_encode($return_array);
		} else {
			$return_array = array("status"=>"failed");
			echo json_encode($return_array);
		}
	}

	function auth_check($db_object, $sess_no) {
		$tmpAuthCheck = $db_object->isExist("select sess_no from session_list where sess_no=" . $sess_no . " and sess_verify=0");

		if ($tmpAuthCheck) {
			$return_array = array("status"=>"succeed");
			echo json_encode($return_array);
		} else {
			$return_array = array("status"=>"failed");
			echo json_encode($return_array);
		}
	}

	function testim($db_object, $sess_no) { // 안드로이드에서 쓰레드를 돌기때문에 알림이 반복 되지않게 sess_is로 구분.. ( 앱에서 푸시알람이 뜨면서 sess_is를 1로 바꿔준다 )
		$db_object->query("update session_list set sess_is = 1 where sess_no =  ". $sess_no);

		echo "잔다시발.. 추후 예외처리..";
	}
?>