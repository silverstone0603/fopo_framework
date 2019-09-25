<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-23.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	// 사진 파일 처리 로드
	$this->loadFAT("ajax_process/photo_process");

	$type = $_POST['type'];
	//$type = "lists";

	switch ($type) {
		case "lists":
			$zone_no = $_POST['zone_no'];
			//$zone_no = 1;
			lists($this->FOPO_DB, $zone_no);
			
			break;

		case "write":
				$filedata = $_POST['filedata'];
				$file_name = uniqid() . ".png";

				$mem_no = $_POST['mem_no'];
				$zone_no = $_POST['zone_no'];
				$brd_content = $_POST['brd_content'];

				if ( upload($filedata, $file_name) ) {
					$brd_no = write($this->FOPO_DB, $mem_no, $zone_no, $brd_content);

					if ( $brd_no == true ) {
						$file_no = insert_file($this->FOPO_DB, $mem_no, $zone_no, $brd_no, $file_name);

						if ( $brd_no == true ) {
							echo $brd_no;
						} else {
							echo "FALSE";
						}
					}

				}
						
				break;

		case "view":
			$brd_no = $_POST['brd_no'];
			view($this->FOPO_DB, $brd_no);

			break;

		case "popul_lists":
			popul_lists($this->FOPO_DB);

			break;

		case "zone":
			photozone($this->FOPO_DB);

			break;

		default:
			echo "{\"type_error\"}";
			break;
	}

	function lists($db_object, $zone_no) {
		$sql = $db_object->query("SELECT phozone_list.zone_placename, phozone_article.brd_no, phozone_files.file_no FROM phozone_list,phozone_article, phozone_files WHERE phozone_article.brd_no = phozone_files.brd_no and phozone_article.zone_no =".$zone_no." and phozone_list.zone_no = phozone_article.zone_no");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['zone_placename'] = $row['zone_placename'];	
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['file_no'] = $row['file_no'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('brd_lists' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}

	function write($db_object, $mem_no, $zone_no, $brd_content) {
		$sql  = $db_object->query("INSERT INTO phozone_article(mem_no, zone_no, brd_content, brd_date) VALUES ('$mem_no', '$zone_no', '$brd_content', now())");

		if ( $sql == 1 ) {
			return mysql_insert_id();
		} else {
			return false;
		}
	}

	function file_brdno_update($db_object, $file_no, $brd_no) {
		$sql = $db_object->query("UPDATE phozone_files SET brd_no = " . $brd_no . " WHERE file_no =" . $file_no);

		if ( $sql == 1 ) {
			echo mysql_insert_id();
		} else {
			echo "{\"null\"}";
		}
	}

	function view($db_object, $brd_no) {
		$sql = $db_object->query("SELECT phozone_article.zone_no,mem_list.mem_nick, phozone_article.brd_no, phozone_files.file_no, phozone_article.brd_content, phozone_article.brd_like FROM mem_list, phozone_article, phozone_files WHERE phozone_article.mem_no = mem_list.mem_no AND phozone_article.brd_no = phozone_files.brd_no AND phozone_article.brd_no=$brd_no");


		$return_array =  $db_object->fetch($sql, 1);

		if ( is_array($return_array) ) {
			echo json_encode(array('brd_view' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}

	function popul_lists($db_object) {
		$sql = $db_object->query("SELECT (phozone_article.brd_view*0.7) + (phozone_article.brd_like*0.3) as count, phozone_article.brd_no, phozone_files.file_savename FROM phozone_article, phozone_files where phozone_article.brd_no = phozone_files.brd_no order by count desc");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['count'] = $row['count'];
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['file_name'] = $row['file_savename'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('popul_brd_lists' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}

	function photozone($db_object) {
		$sql = $db_object->query("SELECT zone_no,zone_placename,zone_x,zone_y FROM phozone_list");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['zone_no'] = $row['zone_no'];
			$row_array['zone_placename'] = $row['zone_placename'];
			$row_array['zone_lat'] = $row['zone_x'];
			$row_array['zone_lng'] = $row['zone_y'];
			array_push($return_array, $row_array);
		}

		if ( is_array($return_array) ) {
			echo json_encode(array('photozone' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}

?>