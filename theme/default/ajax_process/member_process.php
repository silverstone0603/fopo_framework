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

	$type = $_POST['type'];

	switch ($type) {
		case "signup":
			singUp($this->FOPO_DB);
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

	function isExist($db_object, $tmpType, $tmpValue) {
		$arrTest = $db_object->isExist("select $tmpType from mem_list where ($tmpType='$tmpValue')");

		if($arrTest) return true;
		else echo json_encode(array('status' => 'failed'));
	}
?>