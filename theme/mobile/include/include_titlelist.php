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
			"app/home" => "모아보기 | FOPO",
			"app/help" => "도움말 | FOPO",
		);

		private $lstRequest = array(
			"process/auth_process" => true,
			"process/search_process" => true,
			"process/board_process" => true,
			"process/member_process" => true,
			"process/photo_process" => true,
			"process/image_process" => true,
			"process/popular_process" => true,
			"process/register_process" => true,
			"process/reply_process" => true,
			"process/list_process" => true,
			"process/location_process" => true,
			"process/friend_process" => true,
			"process/web_process" => true,
			"process/test_process" => true,
			"process/app_process" => true,
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