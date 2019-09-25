<?php
/*
	FOPO Framework
	designed by EunSeok Oh.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");
	
	class FOPO_CONFIG {
		private $lstConfig = array(
			"db_name" => "DB_NAME",
			"db_id" => "DB_ID",
			"db_pw" => "DB_PASSWORD",
			"db_host" => "localhost",
			"devmode" => false,
			"theme_onlypc" => false,
		);

		private $lstTheme = array(
			"default" => "theme/default/",
			"mobile" => "theme/mobile/",
			"admin" => "theme/admin/",
		);

		function __construct() {

		}

		function getConfig($val) {
			$tmpConfig = $this->lstConfig[$val];
			if(!isset($tmpConfig) || $tmpConfig==="") $tmpConfig=null;
			return $tmpConfig;
		}

		function getTheme($val) {
			$tmpConfig = $this->lstConfig["theme_onlypc"];
			$tmpLog = $this->getLog();
			if($tmpConfig===false && (($tmpLog[0]==="Google Chrome" || $tmpLog[0]==="Android") && ($tmpLog[1]==="Linux" || $tmpLog[1]==="Android"))){
				$tmpTheme = $this->lstTheme["mobile"];
				if(!isset($tmpTheme) || $tmpTheme==="") $tmpTheme="theme/default/";
			}else{
				$tmpTheme = $this->lstTheme[$val];
				if(!isset($tmpTheme) || $tmpTheme==="") $tmpTheme="theme/default/";
			}
			return $tmpTheme;
		}

		// 사용자 접속환경 가져오기
		function getLog(){ 
			$tmpUserAgent = $_SERVER["HTTP_USER_AGENT"];
			$arrTemp = array();
			 
			if(preg_match("/MSIE/i",$tmpUserAgent) && !preg_match("/Opera/i",$tmpUserAgent)){ 
				$arrTemp[0] = "Internet Explorer"; 
			}else if(preg_match("/Firefox/i",$tmpUserAgent)){ 
				$arrTemp[0] = "Mozilla Firefox"; 
			}else if (preg_match("/Chrome/i",$tmpUserAgent)){ 
				$arrTemp[0] = "Google Chrome"; 
			}else if(preg_match("/Safari/i",$tmpUserAgent)){ 
				$arrTemp[0] = "Apple Safari"; 
			}elseif(preg_match("/Opera/i",$tmpUserAgent)){ 
				$arrTemp[0] = "Opera"; 
			}elseif(preg_match("/Netscape/i",$tmpUserAgent)){ 
				$arrTemp[0] = "Netscape"; 
			}else{ 
				$arrTemp[0] = "Android"; 
			}

			if (preg_match("/linux/i", $tmpUserAgent)){  
				$arrTemp[1] = "Linux";
			}elseif(preg_match("/macintosh|mac os x/i", $tmpUserAgent)){ 
				$arrTemp[1] = "Mac";
			}elseif (preg_match("/windows|win32/i", $tmpUserAgent)){ 
				$arrTemp[1] = "Windows";
			}else{
				$arrTemp[1] = "Android";
			}

			return $arrTemp; 
		}
	}
?>