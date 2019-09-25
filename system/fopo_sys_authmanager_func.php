<?php
/*
	FOPO Framework
	designed by EunSeok Oh.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");
	
	class FOPO_AUTH {
		function __construct() {
			session_start();
		}
		
		function setLogin($arrUser){
			if($this->getStatus()==="null"){
				$_SESSION['fopo_token'] = $arrUser["token"];
				$_SESSION['fopo_id'] = $arrUser["id"];
				$_SESSION['fopo_no'] = $arrUser["no"];
				$_SESSION['fopo_status'] = $arrUser["status"];
				$_SESSION['fopo_level'] = $arrUser["level"];
				$_SESSION['fopo_nick'] = $arrUser["nick"];
				$_SESSION['fopo_email'] = $arrUser["email"];
				$_SESSION['fopo_country'] = $arrUser["country"];
				$_SESSION['fopo_phone'] = $arrUser["phone"];
				$_SESSION['fopo_gender'] = $arrUser["gender"];
				$_SESSION['fopo_logged_time'] = time();
				$_SESSION['fopo_logged_ip'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['fopo_last_connect_check'] = '0';

				return "SUCCEED";
			}else{
				return "FAILED";
			}
		}

		function setLogout(){
			if($this->getStatus()==="null"){
				return "FAILED";
			}else{
				session_start();
				session_destroy();

				return "SUCCEED";

			}
		}

		function getID(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesID = trim($_SESSION['fopo_id']);
				return $sesID;
			}
		}

		function getEmail(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesEmail = trim($_SESSION['fopo_email']);
				return $sesEmail;
			}
		}

		function getGender(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesGender = trim($_SESSION['fopo_gender']);
				return $sesGender;
			}
		}

		function getNo(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesNo = trim($_SESSION['fopo_no']);
				return $sesNo;
			}
		}

		function getStatus(){
			$sesStatus = trim($_SESSION['fopo_status']);
			if(!isset($sesStatus) || $sesStatus==="") $sesStatus = "null";
			return $sesStatus;
		}

		function getAccessLevel(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesLevel = trim($_SESSION['fopo_level']);
				return $sesLevel;
			}
		}

		function getNick(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesNick = trim($_SESSION['fopo_nick']);
				return $sesNick;
			}
		}

		function getPhone(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesPhone = trim($_SESSION['fopo_phone']);
				return $sesPhone;
			}
		}

		function getLoginTime(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesTime = trim($_SESSION['fopo_logged_time']);
				return $sesTime;
			}
		}

		function getLoginIP(){
			if($this->getStatus()==="null"){
				return "null";
			}else{
				$sesIP = trim($_SESSION['fopo_logged_ip']);
				return $sesIP;
			}
		}
	}
?>