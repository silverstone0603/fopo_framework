<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$type = $_POST['type'];

	switch ($type) {
		case "lists":
			$brd_no = $_POST['brd_no'];
			lists($this->FOPO_DB, $brd_no);
			break;

		case "write":
			$zone_no = $_POST['zone_no'];
			$brd_no = $_POST['brd_no'];
			$mem_no = $_POST['mem_no'];
			$rre_no = $_POST['rre_no'];
			$re_comment = $_POST['re_comment'];

			write($this->FOPO_DB, $zone_no, $brd_no, $mem_no, $rre_no, $re_comment);

			break;

		case "deleted":
			$re_no = $_POST['re_no'];
			deleted($this->FOPO_DB, $re_no);
			break;

		default:
			echo "{\"type_error\"}";
	}

	function lists($db_object, $brd_no) {
		$sql = $db_object->query("SELECT brd_no, re_no, mem_list.mem_nick, rre_no, re_comment, re_date FROM phozone_reply, mem_list WHERE mem_list.mem_no = phozone_reply.mem_no AND brd_no='$brd_no' ORDER BY re_date ASC");

		$return_array = array();

		while ($row =  $db_object->fetch($sql)) {
			$row_array['re_no'] = $row['re_no'];
			$row_array['mem_nick'] = $row['mem_nick'];
			$row_array['rre_no'] = $row['rre_no'];
			$row_array['re_comment'] = $row['re_comment'];
			$row_array['re_date'] = $row['re_date'];
			$row_array['brd_no'] = $row['brd_no'];
			array_push($return_array, $row_array);
		}

		if (is_array($return_array) ) {
			echo json_encode(array("reply_lists"=>$return_array), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
		} else {
			echo "{\"null\"}";
		}
	}

	function write($db_object, $zone_no, $brd_no, $mem_no, $rre_no, $re_comment) {
		if ( $rre_no == 0) {
			$sql = $db_object->query("INSERT INTO phozone_reply(zone_no, brd_no, mem_no, re_comment, re_date) VALUES ($zone_no, $brd_no, $mem_no, '$re_comment', now())");
		} else if ( $rre_no > 0 ) {
			$sql = $db_object->query("INSERT INTO phozone_reply(zone_no, brd_no, mem_no, rre_no, re_comment, re_date) VALUES ($zone_no, $brd_no, $mem_no,$rre_no,'$re_comment',now())");
		} else {
			echo "{\"reply_depth_error\"}";
			break;
		}

		if ( $sql == 1 ) {
			echo mysql_insert_id();
		} else {
			echo "{\"null\"}";
		}
	}

	function deleted($db_object, $re_no) {
		$sql = $db_object->query("DELETE FROM phozone_reply WHERE re_no=$re_no OR rre_no= $re_no");

		if ($sql == 1) {
			echo "reply DELETE SUCCESS";
		} else {
			echo "{\"null\"}";
		}
	}
?>