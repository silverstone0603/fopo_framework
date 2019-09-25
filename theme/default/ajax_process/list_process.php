<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$admin = trim($_POST['type']);
	if(!isset($admin) || $admin!==""){
		switch ($admin) {
			case "photozone_lists": // 조회수
				photozone_lists($this->FOPO_DB);
				break;

			case "photozone_info": // 좋아요
				$zone_no = $_POST['zone_no'];
				photozone_info($this->FOPO_DB,$zone_no);
				break;

			case "photozone_info_article": // 댓글
				$zone_no = $_POST['zone_no'];
				photozone_info_article($this->FOPO_DB,$zone_no);
				break;

			case "member_lists": // 댓글
				$zone_no = $_POST['zone_no'];
				member_lists($this->FOPO_DB,$zone_no);
				break;

			default:
				echo "{\"type_error\"}";
				break;
		}
	}

	function photozone_lists($db_object) {
		$sql = $db_object->query("SELECT (select count(*) from phozone_article where phozone_list.zone_no = phozone_article.zone_no) as count,phozone_list.zone_no,mem_list.mem_nick,phozone_list.mem_no,phozone_list.zone_placename,phozone_list.zone_regdate,phozone_list.zone_x,phozone_list.zone_y FROM phozone_list,mem_list where phozone_list.mem_no = mem_list.mem_no");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['count'] = $row['count'];
			$row_array['zone_no'] = $row['zone_no'];
			$row_array['mem_no'] = $row['mem_no'];
			$row_array['mem_nick'] = $row['mem_nick'];
			$row_array['zone_placename'] = $row['zone_placename'];
			$row_array['zone_regdate'] = $row['zone_regdate'];
			$row_array['zone_x'] = $row['zone_x'];
			$row_array['zone_y'] = $row['zone_y'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('pho_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function photozone_info($db_object, $number) {
		$sql = $db_object->query("SELECT (select count(*) from phozone_article where phozone_list.zone_no = phozone_article.zone_no) as count,phozone_list.zone_no,mem_list.mem_nick,phozone_list.mem_no,phozone_list.zone_placename,phozone_list.zone_regdate,phozone_list.zone_x,phozone_list.zone_y FROM phozone_list,mem_list where phozone_list.mem_no = mem_list.mem_no and zone_no=".$number);

		$return_array =  $db_object->fetch($sql, 1);
	
		if ( is_array($return_array) ) {
			echo json_encode(array('pho_info' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function photozone_info_article($db_object, $number) {
		$sql = $db_object->query("SELECT phozone_article.mem_no,phozone_files.file_savename, phozone_article.brd_no,mem_list.mem_nick,phozone_article.brd_date FROM phozone_article,mem_list,phozone_files where phozone_article.zone_no =".$number." and phozone_article.mem_no = mem_list.mem_no and phozone_files.brd_no = phozone_article.brd_no");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['mem_no'] = $row['mem_no'];
			$row_array['mem_nick'] = $row['mem_nick'];
			$row_array['brd_date'] = $row['brd_date'];
			$row_array['file_savename'] = $row['file_savename'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('pho_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function member_lists($db_object) {
		$sql = $db_object->query("SELECT * from mem_list");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['mem_no'] = $row['mem_no'];
			$row_array['mem_id'] = $row['mem_id'];
			$row_array['mem_nick'] = $row['mem_nick'];
			$row_array['mem_phone'] = $row['mem_phone'];
			$row_array['mem_level'] = $row['mem_level'];
			$row_array['mem_email'] = $row['mem_email'];
			$row_array['mem_gender'] = $row['mem_gender'];
			$row_array['mem_regdate'] = $row['mem_regdate'];
			$row_array['mem_lastlogin'] = $row['mem_lastlogin'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('mem_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}
	
?>