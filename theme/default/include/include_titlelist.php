<?php
/*
	FOPO Framework
	designed by EunSeok Oh.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	class FOPO_TITLELIST{
		private $lstTitle = array(
			"index" => "FOPO",
			"fopomap" => "포포맵 | FOPO",
			"fopozone" => "포포존 | FOPO",
			"view" => "사진 보기 | FOPO",
			"search" => "검색 | FOPO",
			"myinfo" => "내 정보 | FOPO",
			"login" => "로그인 | FOPO",
			"help" => "도움말 | FOPO",
			"today" => "이번주의 추천 여행지 | FOPO",
			"popular" => "오늘의 인기 순위 | FOPO",
		);

		private $lstRequest = array(
			"ajax_process/auth_process" => true,
			"ajax_process/search_process" => true,
			"ajax_process/board_process" => true,
			"ajax_process/member_process" => true,
			"ajax_process/photo_process" => true,
			"ajax_process/popular_process" => true,
			"ajax_process/register_process" => true,
			"ajax_process/reply_process" => true,
			"ajax_process/list_process" => true,
			"ajax_process/location_process" => true,
			"ajax_process/friend_process" => true,
			"ajax_process/web_process" => true,
			"ajax_process/test_process" => true,
			"ajax_process/app_process" => true,
			"cdn_process/photo" => true,
			"test" => true,
		);

		private $lstMap = array(
			"index" => true,
			"fopomap" => true,
			"index_beta" => true,
		);

		function __construct(){
			// Empty Function
		}

		function getTitle($title){
			$tmpTitle = $this->lstTitle[$title];
			if(!isset($tmpTitle) || $tmpTitle==="") $tmpTitle="FOPO Framework";
			return $tmpTitle;
		}

		function getIsRequest($title){
			$tmpRequest = $this->lstRequest[$title];
			if(!isset($tmpRequest) || $tmpRequest==="") $tmpRequest=false;
			return $tmpRequest;
		}

		function getIsMap($title){
			$tmpMap = $this->lstMap[$title];
			if(!isset($tmpMap) || $tmpMap==="") $tmpMap=false;
			return $tmpMap;
		}
	}
?>