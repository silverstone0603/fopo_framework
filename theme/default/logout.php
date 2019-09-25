<?php
	$this->FOPO_DB->query("delete from session_list where sess_token='".$_SESSION['fopo_token']."'");
	
	// 로그아웃 처리
	$this->FOPO_AUTH->setLogout();

	// 메인 페이지로 이동
	$this->setGoTo("");
?>