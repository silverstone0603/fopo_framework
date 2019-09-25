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
	$this->loadFAT("process/photo_process");

	$tmpType = trim($_POST['type']);
	$tmpToken = trim($_POST['token']);
	$tmpIsToken = $this->FOPO_DB->isExist("select sess_no from session_list where (sess_token='$tmpToken') and (sess_devicetype=0)");

	switch ($tmpType) {
		case "lists":
			$zone_no = $_POST['zone_no'];
			//$zone_no = 1;
			lists($this->FOPO_DB, $zone_no);
			
			break;

		case "write":
			if($tmpIsToken){
				$filedata = trim($_POST['filedata']);
				$file_name = uniqid().".png";

				$mem_no = trim($_POST['mem_no']);
				$zone_no = trim($_POST['zone_no']);
				$brd_content = trim($_POST['brd_content']);
				
				if(upload($filedata, $file_name)) {
					$brd_no = write($this->FOPO_DB, $mem_no, $zone_no, $brd_content);

					if ($brd_no > 0){
						$file_no = insert_file($this->FOPO_DB, $mem_no, $zone_no, $brd_no, $file_name);

						if ($brd_no > 0) echo $brd_no;
						else echo "FALSE";
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

		case "like":
			$brd_no = $_POST['brd_no'];
			like($this->FOPO_DB,$brd_no);
			break;

		case "zone":
			photozone($this->FOPO_DB);

			break;

		case "f_lists":
			$mem_no = $_POST['mem_no'];
			
			FriendArticleList($this->FOPO_DB, $mem_no);
			
			break;

		case "photozone":
			$tmpBrdNo = $_POST['brd_no'];
			//$gps_latitude = $_POST['gps_latitude'];
			//$gps_longitude = $_POST['gps_longitude'];	

			getPhotoZone($this->FOPO_DB, $tmpBrdNo);
			//getPhotoZone($this->FOPO_DB, $gps_latitude, $gps_longitude);
			break;

		default:
			echo "{\"type_error\"}";
			break;
	}

	function lists($db_object, $zone_no) {
		$sql = $db_object->query("SELECT (select mem_nick from mem_list where mem_no = phozone_article.mem_no) as nick,phozone_list.zone_placename, phozone_article.brd_no, phozone_files.file_no,phozone_article.brd_like FROM phozone_list,phozone_article, phozone_files WHERE phozone_article.brd_no = phozone_files.brd_no and phozone_article.zone_no =".$zone_no." and phozone_list.zone_no = phozone_article.zone_no");

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['zone_placename'] = $row['zone_placename'];	
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['file_no'] = $row['file_no'];
			$row_array['brd_like'] = $row['brd_like'];
			$row_array['nick'] = $row['nick'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('brd_lists' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function write($db_object, $mem_no, $zone_no, $brd_content) {
		$sql  = $db_object->query("INSERT INTO phozone_article(mem_no, zone_no, brd_content, brd_date) VALUES ('$mem_no', '$zone_no', '$brd_content', now())");

		if ( $sql == 1 ) {
			return mysql_insert_id();
		} else {
			echo $zone_no;
			// echo $mem_no . " " . $zone_no .  " " . $brd_content;
			//echo json_encode(array('status' => 'failed'));
		}
	}

	function file_brdno_update($db_object, $file_no, $brd_no) {
		$sql = $db_object->query("UPDATE phozone_files SET brd_no = " . $brd_no . " WHERE file_no =" . $file_no);

		if ( $sql == 1 ) {
			echo mysql_insert_id();
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function view($db_object, $brd_no) {
		$sql = $db_object->query("SELECT phozone_article.zone_no,mem_list.mem_nick, phozone_article.brd_no, phozone_files.file_no, phozone_article.brd_content, phozone_article.brd_like FROM mem_list, phozone_article, phozone_files WHERE phozone_article.mem_no = mem_list.mem_no AND phozone_article.brd_no = phozone_files.brd_no AND phozone_article.brd_no=$brd_no");


		$return_array =  $db_object->fetch($sql, 1);

		if ( is_array($return_array) ) {
			echo json_encode(array('brd_view' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
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
			echo json_encode(array('status' => 'failed'));
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
			echo json_encode(array('status' => 'failed'));
		}
	}

	function like($db_object, $brd_no) {
		$sql = $db_object->query("UPDATE phozone_article SET brd_like = brd_like + 1 WHERE brd_no =" . $brd_no);
		$sql2 = $db_object->query("select brd_like from phozone_article where brd_no = ".$brd_no);


		$return_array =  $db_object->fetch($sql2, 1);

		if ( $sql == 1 ) {
			echo json_encode(array('brd_like' => $return_array));
			//echo mysql_insert_id();
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function FriendArticleList($db_object, $mem_no) {
		$sql = $db_object->query("SELECT phozone_article.brd_no, phozone_files.file_no FROM phozone_article, phozone_files WHERE phozone_article.brd_no = phozone_files.brd_no AND phozone_article.mem_no=" . $mem_no);

		$return_array = array();

		while ($row =  $db_object->fetch($sql, 1)) {
			$row_array['brd_no'] = $row['brd_no'];
			$row_array['file_no'] = $row['file_no'];
			array_push($return_array, $row_array);
		}
	
		if ( is_array($return_array) ) {
			echo json_encode(array('brd_lists' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function getPhotoZone($db_object, $brd_no) {
		$sql = $db_object->fetch($db_object->query("SELECT zone_no FROM phozone_list WHERE zone_no=$brd_no"), 1);
		//$sql = $db_object->fetch($db_object->query("SELECT zone_no FROM phozone_list WHERE zone_x LIKE '$gps_latitude'  AND zone_y LIKE '$gps_longitude'"), 1);

		echo $sql['zone_no'];
	}

?>