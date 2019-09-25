<?php
/*
	FOPO Framework
	designed by EunSeok Oh.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	class FOPO_TITLELIST{
		private $lstTitle = array(
			"index" => "FOPO Management System",

			"member" => "FOPO Management System",
			"member_info" => "FOPO Management System",

			"photozone" => "FOPO Management System",
			"photozone_info" => "FOPO Management System",

			"log" => "FOPO Management System",
			"filter" => "FOPO Management System",
			"pose" => "FOPO Management System",

			"contents" => "FOPO Management System",
		);

		private $lstRequest = array(
			"ajax_process/auth_process" => true,
			"ajax_process/board_process" => true,
			"ajax_process/member_process" => true,
			"ajax_process/photo_process" => true,
			"ajax_process/popular_process" => true,
			"ajax_process/register_process" => true,
			"ajax_process/reply_process" => true,
			"ajax_process/admin_process" => true,
			"cdn_process/photo" => true,
		);

		private $lstMap = array(
			"photozone_info" => true,
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