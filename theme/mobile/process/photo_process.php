<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$tmpPhotoType = trim($_POST['photo_type']);
	if(!isset($tmpPhotoType) || $tmpPhotoType!==""){
		switch ($tmpPhotoType) {
			case "deleted": // 이미지 삭제
				$file_no = 2; //$file_no = $_POST['file_no'];
				deleted($this->FOPO_DB, $file_no);

				break;

			case "load": // 이미지 로드
				$file_no = $_POST['file_no'];
				load($this->FOPO_DB, $file_no, $this->root_path);
				break;

			default:
				echo "{\"type_error\"}";
				break;
		}
	}

	function upload($base64_string, $file_name) { // png로 변경해서 저장하도록 차후 수정
		header('Content-Type: image/png');

		$base64_string = str_replace('data:image/png;base64,', '', $base64_string);
		$image_data = base64_decode($base64_string);
		
		$result = file_put_contents("uploads/users/".$file_name, $image_data);
	
		return $result;
	}

	function insert_file($db_object, $mem_no, $zone_no, $brd_no, $file_name) {
		$sql = $db_object->query("INSERT INTO phozone_files(mem_no, zone_no, brd_no, file_savename, file_date) VALUES ('$mem_no',  '$zone_no', '$brd_no', '$file_name', now())");

		if ( $sql == 1 ) {
			return mysql_insert_id();
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}


	function deleted($db_object, $file_no) {
		$sql = $db_object->query("DELETE FROM file WHERE file_no=" . $idx);

		if ($sql == 1) {
			echo "delete success";
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function load($db_object, $file_no, $root_path) {
		$sql = $db_object->fetch($db_object->query("SELECT file_savename FROM phozone_files WHERE file_no = " . $file_no), 1);

		if ( is_array($sql) ) {
			$file_name = $sql['file_savename'];
			$file_extension = strtolower(substr(strrchr($file_name,"."),1));

			// 안드로이드에서 기본카메라로 찍은사진들은 jpg로 저장됨 (내폰만테스트)
			// 추후 필요없는 확장자들은 지워도무방..
			switch( $file_extension ) {
				case "png": $ctype="image/png"; break;
				case "jpeg":
				case "jpg":
				default: $ctype="image/jpeg"; break;
			}

			header('Content-type: ' . $ctype);
			$im = file_get_contents($root_path."/uploads/users/".$file_name);
			echo $im;
		} else {
			header('Content-type: image/png');
			$im = file_get_contents($root_path."/uploads/system/fopo_sys_error_img.png");
			echo $im;
		}
	}
?>