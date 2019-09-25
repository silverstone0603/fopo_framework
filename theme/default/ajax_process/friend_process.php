<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-23.

	Copyright (C) FOPO Team, All rights reserved.
*/
if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$admin = trim($_POST['type']);
	//$admin = "F_delete";

	if(!isset($admin) || $admin!==""){
		switch ($admin) {
			case "F_find":
				$mem_no = $_POST['mem_no'];
				$mem_id = $_POST['mem_id'];
				//$mem_no = 9;
				//$mem_id = "sangwon";
				F_find($this->FOPO_DB,$mem_no, $mem_id);
				break;

			case "F_add": // 추가
				$mem_no = $_POST['mem_no'];
				$fri_no = $_POST['fri_no'];
				F_add($this->FOPO_DB,$mem_no,$fri_no);
				break;

			case "F_delete": // 삭제
				$mem_no = $_POST['mem_no'];
				$fri_no = $_POST['fri_no'];
				//$mem_no = 9;
				//$fri_no = 3;
				F_deleted($this->FOPO_DB,$mem_no,$fri_no);
				break;

			case "F_list": // 리스트
				$mem_no = $_POST['mem_no'];
				F_list($this->FOPO_DB,$mem_no);
				break;

			default:
				echo "{\"type_error\"}";
				break;
		}
	}

	function F_find($db_object, $mem_no, $mem_id) {
		$sql = $db_object->fetch($db_object->query("SELECT mem_list.mem_no, mem_list.mem_nick, (select count(mem_no) from phozone_article WHERE mem_list.mem_no = phozone_article.mem_no) AS art_cnt FROM mem_list WHERE mem_list.mem_id = '". $mem_id . "'"), 1);


		if ( $mem_no === $sql['mem_no'] ) {
			$is_Friend = 2;
		} else {
			$is_Friend = $db_object->isExist("SELECT fri_idx FROM friend_list WHERE mem_no=" . $mem_no .  " AND fri_no=" . $sql['mem_no']);
		}

		$row_array['mem_no'] = $sql['mem_no'];
		$row_array['mem_nick'] = $sql['mem_nick'];
		$row_array['art_cnt'] = $sql['art_cnt'];
		$row_array['status'] = $is_Friend;

		echo json_encode(array('user_find' => $row_array));
	}

	function F_list($db_object,$mem_no) {
		$sql = $db_object->query("select mem_list.mem_no,mem_list.mem_nick,(select count(mem_no) from phozone_article group by mem_no HAVING mem_no = fri_no)as art_cnt from friend_list,mem_list where friend_list.mem_no =".$mem_no." and friend_list.fri_no = mem_list.mem_no");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['mem_no'] = $row['mem_no'];
			$row_array['mem_nick'] = $row['mem_nick'];
			$row_array['art_cnt'] = $row['art_cnt'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('fri_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function F_add($db_object,$mem_no,$fri_no) {
		$sql = $db_object->query("INSERT INTO friend_list(mem_no, fri_no) VALUES (" . $mem_no . "," . $fri_no. ")");
		
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function F_deleted($db_object,$mem_no,$fri_no) {
		$sql = $db_object->query("DELETE FROM friend_list WHERE mem_no = ". $mem_no . " AND fri_no = ". $fri_no);
		
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}
?>