<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	edited by Giwon Son
	Lastes Updated : 19-06-20

	Copyright (C) FOPO Team, All rights reserved.
*/

	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$tmpType = $_POST['type'];
	//$type = "signup";

	switch ($tmpType) {
		case "signup":
			singUp($this->FOPO_DB);
			break;

		case "forgotpwd":
			forgotpwd($this->FOPO_DB);
			break;

		case "info":
			// 사진 파일 처리 로드
			$this->loadFAT("process/photo_process");

			$mem_no = $_POST['mem_no'];
			myInfo($this->FOPO_DB, $mem_no);
			break;

		case "modify":
			// 사진 파일 처리 로드
			$this->loadFAT("process/photo_process");

			modify($this->FOPO_DB);
			break;

		default:
			echo json_encode(array('status' => 'failed'));
			break;
	}

	function singUp($db_object) {
		$mem_id = trim($_POST['mem_id']);
		$mem_pw = md5(trim($_POST['mem_pw']));
		$mem_nick = trim($_POST['mem_nick']);
		$mem_gender = trim($_POST['mem_gender']);

		$tmpIsID = isExist($db_object, "mem_id", $mem_id);
		$tmpIsNick = isExist($db_object, "mem_nick", $mem_nick);
		
		If(!$tmpIsID){
			If(!$tmpIsNick){
				$sql = $db_object->query("INSERT INTO mem_list(mem_id, mem_pw, mem_nick, mem_gender, mem_regdate) 
											  VALUES ('$mem_id', '$mem_pw',  '$mem_nick', '$mem_gender', now())");
				if ($sql) echo "true";
				else echo "false";
			}else{
				// 닉네임 중복 있을때
				echo "exist_nick";
			}
		}else{
			// 아이디 중복 있을때
				echo "exist_id";
		}
	}

	function forgotpwd($db_object) {
		$mem_id = trim($_POST['mem_id']);
		$mem_email = trim($_POST['mem_email']);

		$tmpIsUser = $db_object->isExist("SELECT mem_id FROM mem_list WHERE mem_id='$mem_id' and mem_email='$mem_email'");

		if($tmpIsUser){
			$strUserID = md5($mem_id);
			$tmpSQL = $db_object->query("update mem_list set mem_pw='$strUserID' where mem_id='$mem_id' and mem_email='$mem_email'");

			$return_array = array("status"=>"success", "password"=>$mem_id);
			echo json_encode($return_array);
		}else{
			$return_array = array("status"=>"failed");
			echo json_encode($return_array);
		}
	}

	function isExist($db_object, $tmpType, $tmpValue) {
		$arrTemp = $db_object->isExist("select $tmpType from mem_list where ($tmpType='$tmpValue')");

		if($arrTemp) return true;
		//else echo json_encode(array('status' => 'failed'));
	}

	function myInfo($db_object, $mem_no) {
		$sql = $db_object->fetch($db_object->query("SELECT mem_no, mem_nick, mem_email, mem_phone, mem_picfile FROM mem_list WHERE mem_no=". $mem_no),1);

		if ( $sql['mem_no'] > 0 ) {
			$return_array = array("mem_nick"=>$sql["mem_nick"], "mem_email"=>$sql["mem_email"], "mem_phone"=>$sql["mem_phone"], "mem_picfile"=>$sql["mem_picfile"]);
			echo json_encode($return_array);
		} else {
			$return_array = array("status"=>"not_exist_session");
			echo json_encode($return_array);
		}
	}

	function modify($db_object) {
		$profile = $_POST['profile'];
		$mem_no = trim($_POST['mem_no']);
		$mem_nick = trim($_POST['mem_nick']);
		$mem_newpw = (trim($_POST['mem_newpw'])!=="") ? md5(trim($_POST['mem_newpw'])) : "";
		$mem_phone = trim($_POST['mem_phone']);
		$file_id = 0;

		$tmpMemCheck = $db_object->isExist("select mem_no from session_list where mem_no=" . $mem_no);

		if ($tmpMemCheck) {
			if ($profile !== "null") {
				$file_name = uniqid().".png";

				upload($profile, $file_name);

				$sql = $db_object->query("Insert into phozone_files(mem_no, zone_no, brd_no, file_savename) values ('$mem_no', 0, 0, '$file_name')");

				if($sql==1) {
					$file_id = mysql_insert_id();
				}
			}

			if($mem_newpw){
				$temp = $db_object->query("update mem_list set mem_nick = '$mem_nick', mem_pw = '$mem_newpw', mem_phone='$mem_phone', mem_picfile='$file_id' where mem_no='$mem_no'");
			}else{
				$temp = $db_object->query("update mem_list set mem_nick = '$mem_nick', mem_phone='$mem_phone', mem_picfile='$file_id' where mem_no='$mem_no'");
			}

			if ($temp == 1) echo json_encode(array('status' => 'success'));
			else echo json_encode(array('status' => 'failed'));
		} else {
			echo json_encode(array('status' => 'login_failed'));
		}
	}
?>