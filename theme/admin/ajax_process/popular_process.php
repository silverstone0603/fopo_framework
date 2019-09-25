<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$popular = trim($_POST['type']);
	if(!isset($popular) || $popular!==""){
		switch ($popular) {
			case "view": // 조회수
				view($this->FOPO_DB);
				break;

			case "like": // 좋아요
				like($this->FOPO_DB);
				break;

			case "reply": // 댓글
				reply($this->FOPO_DB);
				break;

			default:
				echo "{\"type_error\"}";
				break;
		}
	}

	function view($db_object) {
		$sql = $db_object->query("select ANY_VALUE(phozone_files.file_savename) as filename,ANY_VALUE(phozone_article.brd_no) as brd_no,MAX(phozone_article.brd_view) as brd_view,ANY_VALUE(mem_list.mem_nick) as mem_nick from phozone_article,mem_list,phozone_files where phozone_article.mem_no = mem_list.mem_no and phozone_article.brd_no = phozone_files.brd_no and phozone_article.brd_view = (SELECT MAX(phozone_article.brd_view) FROM phozone_article)");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['filename'] = $row['filename'];
			$row_array['brd_view'] = $row['brd_view'];
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['mem_nick'] = $row['mem_nick'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('pop_view' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}

	function like($db_object) {
		$sql = $db_object->query("select ANY_VALUE(phozone_files.file_savename) as filename,ANY_VALUE(phozone_article.brd_no) as brd_no,MAX(phozone_article.brd_like) as brd_like,ANY_VALUE(mem_list.mem_nick) as mem_nick from phozone_article,mem_list,phozone_files where phozone_article.mem_no = mem_list.mem_no and phozone_article.brd_no = phozone_files.brd_no and brd_like = (SELECT max(brd_like) from phozone_article)");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['brd_like'] = $row['brd_like'];
			$row_array['filename'] = $row['filename'];
			$row_array['mem_nick'] = $row['mem_nick'];
			array_push($return_array, $row_array);
		}
		if ( is_array($return_array) ) {
			echo json_encode(array('pop_like' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}


	function reply($db_object, $file_no) {
		$sql = $db_object->query("SELECT phozone_article.brd_no, phozone_files.file_no, phozone_files.file_savename FROM phozone_article, phozone_files WHERE phozone_article.zone_no =" . $zone_no . " AND phozone_article.brd_no = phozone_files.brd_no");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['file_no'] = $row['file_no'];
			$row_array['file_name'] = $row['file_savename'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('brd_lists' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}
?>