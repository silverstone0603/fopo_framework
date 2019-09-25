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
			case "photozone_lists": // 포토존 리스트
				photozone_lists($this->FOPO_DB);
				break;

			case "photozone_info": // 포토존 정보
				$zone_no = $_POST['zone_no'];
				photozone_info($this->FOPO_DB,$zone_no);
				break;

			case "photozone_info_article": // 포토존 게시글
				$zone_no = $_POST['zone_no'];
				photozone_info_article($this->FOPO_DB,$zone_no);
				break;

			case "article_info":
				$brd_no = $_POST['brd_no'];
				article_info($this->FOPO_DB,$brd_no);
				break;

			case "member_lists": // 멤버 리스트
				$zone_no = $_POST['zone_no'];
				member_lists($this->FOPO_DB,$zone_no);
				break;

			case "member_info": // 멤버 정보
				$member_no = $_POST['member_no'];
				member_info($this->FOPO_DB,$member_no);
				break;

			case "member_log":
				$member_no = $_POST['member_no'];
				member_log($this->FOPO_DB,$member_no);
				break;

			case "member_info_edit":
				$member_id = $_POST['id'];
				$member_nick = $_POST['nick'];
				$member_phone = $_POST['phone'];
				$member_email = $_POST['email'];
				$member_pw = $_POST['pw'];
				$member_no = $_POST['no'];
				member_info_edit($this->FOPO_DB,$member_id,$member_nick,$member_phone,$member_email,$member_pw,$member_no);
				break;
			
			case "phozone_info_edit":
				$no = $_POST['no'];
				$name = $_POST['name'];
				$lat = $_POST['lat'];
				$lng = $_POST['lng'];
				phozone_info_edit($this->FOPO_DB,$no,$name,$lat,$lng,$date);
				break;

			case "reply_lists":
				$brd_no = $_POST['brd_no'];
				reply_lists($this->FOPO_DB, $brd_no);
			break;

			case "reply_deleted":
				$re_no = $_POST['re_no'];
				reply_deleted($this->FOPO_DB, $re_no);
			break;
			
			case "session_deleted":
				$sess_no = $_POST['no'];
				session_deleted($this->FOPO_DB, $sess_no);
			break;

			case "getQnalist":
				getQnalist($this->FOPO_DB);
			break;
			
			case "getQuelist":
				getQuelist($this->FOPO_DB);
			break;
			
			case "getSesslist":
				getSesslist($this->FOPO_DB);
			break;
			
			case "getEventlist":
				getEventlist($this->FOPO_DB);
			break;
			
			case "getEventInfo":
				$no = $_POST['no'];
				getEventInfo($this->FOPO_DB,$no);
			break;

			case "getQnaInfo":
				$no = $_POST['no'];
				getQnaInfo($this->FOPO_DB,$no);
			break;
			
			case "Qna_Write":
				$title = $_POST['title'];
				$content = $_POST['content'];
				Qna_Write($this->FOPO_DB,$title,$content);
			break;

			case "Qna_Edit":
				$no = $_POST['no'];
				$title = $_POST['title'];
				$content = $_POST['content'];
				Qna_Edit($this->FOPO_DB,$no,$title,$content);
			break;
			
			case "Qna_Deleted":
				$no = $_POST['no'];
				setQnaDeleted($this->FOPO_DB,$no);
			break;

			case "Event_Deleted":
				$no = $_POST['no'];
				setEventDeleted($this->FOPO_DB,$no);
			break;

			case "Event_Write":
				$mem_no = $_POST['mem_no'];
				$title = $_POST['title'];
				$content = $_POST['content'];
				$file = $_POST['file'];
				$term = $_POST['term'];
				$division = $_POST['division'];
				$posting = $_POST['posting'];
				Event_Write($this->FOPO_DB,$mem_no,$title,$content,$file,$term,$division,$posting);
			break;

			case "Event_Edit":
				$mem_no = $_POST['mem_no'];
				$no = $_POST['no'];
				$title = $_POST['title'];
				$content = $_POST['content'];
				$file = $_POST['file'];
				$term = $_POST['term'];
				$division = $_POST['division'];
				$posting = $_POST['posting'];
				Event_Edit($this->FOPO_DB,$no,$mem_no,$title,$content,$file,$term,$division,$posting);
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

	function member_info($db_object, $number) {
		$sql = $db_object->query("select * from mem_list where mem_no = ".$number);

		$return_array =  $db_object->fetch($sql, 1);
	
		if ( is_array($return_array) ) {
			echo json_encode(array('mem_info' => $return_array));
		} else {
			echo "{\"null\"}";
		}
	}
	
	function member_info_edit($db_object, $id, $nick, $phone, $email, $pw, $no) {
		$pw = md5($pw);

		$sql  = $db_object->query("update mem_list set mem_id = \"".$id."\", mem_nick = \"".$nick."\", mem_phone = \"".$phone."\", mem_email = \"".$email."\",mem_pw = \"".$pw."\" where mem_no = ". $no );
		
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function phozone_info_edit($db_object, $no, $name, $lat, $lng) {
		$sql  = $db_object->query("update phozone_list set zone_placename = \"".$name."\", zone_x = \"".$lat."\", zone_y = \"".$lng."\" where zone_no = ". $no);
		
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function article_info($db_object, $brd_no) {
		$sql = $db_object->query("SELECT mem_list.mem_no,mem_list.mem_id,phozone_article.zone_no,phozone_list.zone_placename,phozone_article.brd_like,phozone_article.brd_view,phozone_article.brd_date,phozone_article.brd_content,phozone_files.file_savename FROM phozone_article,mem_list,phozone_list,phozone_files WHERE phozone_article.brd_no = ".$brd_no." and phozone_files.brd_no = phozone_article.brd_no and phozone_article.mem_no = mem_list.mem_no and phozone_list.zone_no = phozone_article.zone_no ");

		$return_array =  $db_object->fetch($sql, 1);
	
		if ( is_array($return_array) ) {
			echo json_encode(array('article_info' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}
	
	function reply_lists($db_object, $brd_no) {
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
			echo json_encode(array('status' => 'failed'));
		}
	}

	function reply_deleted($db_object, $re_no) {
		$sql = $db_object->query("DELETE FROM phozone_reply WHERE re_no=$re_no OR rre_no= $re_no");

		if ($sql == 1) {
			echo "reply DELETE SUCCESS";
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function member_log($db_object, $number) {
		$sql = $db_object->query("select usrlog_os,usrlog_browse,usrlog_ip,usrlog_date from usrlogin_log where mem_no =".$number);
		
		$return_array = array();
		
		while ($row =  $db_object->fetch($sql, 1)) {
				$row_array['os'] = $row['usrlog_os'];
				$row_array['browse'] = $row['usrlog_browse'];
				$row_array['ip'] = $row['usrlog_ip'];
				$row_array['date'] = $row['usrlog_date'];
				array_push($return_array, $row_array);
		}

		if ( is_array($return_array) ) {
			echo json_encode(array('mem_log' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function getQnalist($db_object) {
		$sql = $db_object->query("select * from pho_qa ");
		
		$return_array = array();
		
		while ($row =  $db_object->fetch($sql, 1)) {
				$row_array['idx'] = $row['qa_idx'];
				$row_array['title'] = $row['qa_title'];
				$row_array['content'] = $row['qa_content'];
				$row_array['date'] = $row['qa_date'];
				$row_array['edate'] = $row['qa_edate'];
				array_push($return_array, $row_array);
		}

		if ( is_array($return_array) ) {
			echo json_encode(array('qa_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}
	
	function getQuelist($db_object) {
		$sql = $db_object->query("SELECT qu_idx,(select mem_no from mem_list where mem_no = pho_question.mem_no) as mem_no,(select mem_nick from mem_list where mem_no = pho_question.mem_no) as mem_nick,qu_content,qu_date,(select ca_title from qu_category where qu_category = pho_question.qu_category) as qu_category,qu_status FROM pho_question");
		
		$return_array = array();
		
		while ($row =  $db_object->fetch($sql, 1)) {
				$row_array['idx'] = $row['qu_idx'];
				$row_array['no'] = $row['mem_no'];
				$row_array['nick'] = $row['mem_nick'];
				$row_array['content'] = $row['qu_content'];
				$row_array['date'] = $row['qu_date'];
				$row_array['category'] = $row['qu_category'];
				$row_array['status'] = $row['qu_status'];
				array_push($return_array, $row_array);
		}

		if ( is_array($return_array) ) {
			echo json_encode(array('qu_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function getSesslist($db_object) {
	$sql = $db_object->query("select sess_no,mem_no,(select mem_nick from mem_list where mem_no = session_list.mem_no) as mem_nick, sess_token, sess_verify, sess_devicetype, sess_orgdate,sess_lastdate,sess_ip,sess_is from session_list");
		
		$return_array = array();
		
		while ($row =  $db_object->fetch($sql, 1)) {
				$row_array['no'] = $row['mem_no'];
				$row_array['sess_no'] = $row['sess_no'];
				$row_array['nick'] = $row['mem_nick'];
				$row_array['token'] = $row['sess_token'];
				$row_array['verify'] = $row['sess_verify'];
				$row_array['type'] = $row['sess_devicetype'];
				$row_array['orgdate'] = $row['sess_orgdate'];
				$row_array['lastdate'] = $row['sess_lastdate'];
				$row_array['ip'] = $row['sess_ip'];
				$row_array['is'] = $row['sess_is'];
				array_push($return_array, $row_array);
		}

		if ( is_array($return_array) ) {
			echo json_encode(array('sess_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function getEventlist($db_object) {
	$sql = $db_object->query("SELECT *,(SELECT mem_nick from mem_list where mem_no = event_article.mem_no) as mem_nick FROM `event_article` WHERE 1");
		
		$return_array = array();
		
		while ($row =  $db_object->fetch($sql, 1)) {
				$row_array['mem_no'] = $row['mem_no'];
				$row_array['eve_no'] = $row['eve_no'];
				$row_array['nick'] = $row['mem_nick'];
				$row_array['title'] = $row['eve_title'];
				$row_array['content'] = $row['eve_content'];
				$row_array['term'] = $row['eve_term'];
				$row_array['wridate'] = $row['eve_wridate'];
				$row_array['division'] = $row['eve_division'];
				$row_array['posting'] = $row['eve_posting'];
				array_push($return_array, $row_array);
		}

		if ( is_array($return_array) ) {
			echo json_encode(array('eve_list' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}	
	
	function session_deleted($db_object, $sess_no) {
		$sql = $db_object->query("DELETE FROM session_list WHERE sess_no =". $sess_no);

		if ($sql == 1) {
			echo "SESSION DELETE SUCCESS";
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function Event_Write($db_object,$mem_no,$title,$content,$file,$term,$division,$posting){
		$sql  = $db_object->query("INSERT INTO event_article(mem_no, eve_title, eve_content, eve_file, eve_term, eve_wridate, eve_division, eve_posting) VALUES (".$mem_no.",\"".$title."\",\"".$content."\",\"".$file."\",\"".$term."\",now(),".$division.",".$posting.")");
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function Event_Edit($db_object,$no,$mem_no,$title,$content,$file,$term,$division,$posting){
		$sql  = $db_object->query("UPDATE event_article SET mem_no=\"".$mem_no."\" ,eve_title=\"".$title."\" ,eve_content=\"".$content."\" ,eve_file=\"".$file."\" ,eve_term=\"".$term."\" ,eve_division=\"".$division."\" ,eve_posting=\"".$posting."\" WHERE eve_no = ".$no);
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function getEventInfo($db_object, $no) {
		$sql = $db_object->query("SELECT * FROM `event_article` WHERE eve_no =".$no);

		$return_array =  $db_object->fetch($sql, 1);
	
		if ( is_array($return_array) ) {
			echo json_encode(array('eve_info' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function Qna_Write($db_object,$title,$content){
		$sql  = $db_object->query("INSERT INTO pho_qa(qa_title, qa_content, qa_date, qa_edate) VALUES (\"".$title."\",\"".$content."\",now(),now())");
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function Qna_Edit($db_object,$no,$title,$content){
		$sql  = $db_object->query("UPDATE pho_qa SET qa_title=\"".$title."\" ,qa_content=\"".$content."\",qa_edate = now() WHERE qa_idx = ".$no);
		if ( $sql == 1 ) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function getQnaInfo($db_object, $no) {
		$sql = $db_object->query("SELECT * FROM pho_qa WHERE qa_idx =".$no);

		$return_array =  $db_object->fetch($sql, 1);
	
		if ( is_array($return_array) ) {
			echo json_encode(array('qa_info' => $return_array));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function setQnaDeleted($db_object, $no) {
		$sql = $db_object->query("DELETE FROM pho_qa WHERE qa_idx= ".$no);

		if ($sql == 1) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	function setEventDeleted($db_object, $no) {
		$sql = $db_object->query("DELETE FROM event_article WHERE eve_no= ".$no);

		if ($sql == 1) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}
?>