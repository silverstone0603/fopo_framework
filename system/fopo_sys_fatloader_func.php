<?php
/*
	FOPO Framework
	designed by EunSeok Oh.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	class FOPO_FAT{
		private $FOPO_DB;
		private $FOPO_PAGEPRINTER;
		private $FOPO_TITLELIST;
		private $FOPO_AUTH;
		private $theme_path;
		private $now_path;
		private $host_path;
		private $root_path;
		
		function __construct($db_object, $page_object, $auth_object, $theme_path){
			$this->FOPO_DB = $db_object;
			$this->FOPO_PAGEPRINTER = $page_object;
			$this->FOPO_AUTH = $auth_object;
			$this->theme_path = $theme_path;
			$this->host_path = $_SERVER['HTTP_HOST'];
			$this->root_path = $_SERVER["DOCUMENT_ROOT"];

			$tmpPath = trim($_SERVER['REQUEST_URI']);
			if(!isset($tmpPath) || $tmpPath==="") $tmpPath = "index";
			$this->now_path = $tmpPath;

			// 타이틀 객체 불러오기
			if(file_exists($this->theme_path."include/include_titlelist.php")===TRUE){
				@require_once($theme_path."include/include_titlelist.php");
				$this->FOPO_TITLELIST = new FOPO_TITLELIST();
			}else{
				$this->FOPO_PAGEPRINTER->showError("FAT 테마 파일 처리 실패", "FOPO Framework가 FAT 테마의 타이틀 목록 파일 처리에 실패하였습니다.<br>FAT 테마의 타이틀 목록 파일이 존재하는지 다시 확인하여 주십시오.");
			}
		}
		
		// FAT 문법 처리
		function loadTheme($org_str){
			$filename = $org_str;
			$fp = fopen($this->theme_path.$filename, "r") or $this->FOPO_PAGEPRINTER->showError("FAT 테마 파일 처리 실패", "FOPO Framework가 FAT 테마 파일 처리에 실패하였습니다.<br>FAT 문법이 정확한지 또는 파일이 존재하는지 다시 확인하여 주십시오.");
			
			// 주소 받아오기
			$tmpURI = $_SERVER['REQUEST_URI'];
			if(trim(substr($tmpURI,0,1))==="/"){
				$tmpURI = trim(preg_replace("!/!", "", $tmpURI, 1));
			}

			if(strpos($tmpURI, "?") !== false) {
				$tmpStr = explode("?", $tmpURI);
				$tmpURI = trim($tmpStr[0]);
			}
			$tmpPath = trim(str_replace("/","",$tmpURI));
			if(!isset($tmpPath) || $tmpPath===""){
				$tmpURI = "index";
			}

			$tmpIsMap = $this->FOPO_TITLELIST->getIsMap($tmpURI);

			$tmpReturnTitle = "<title>".$this->FOPO_TITLELIST->getTitle($tmpURI)."</title>";
			$tmpReturnCSS = "link rel=\"stylesheet\" type=\"text/css\" href=\"http://".$_SERVER['HTTP_HOST']."/".$this->theme_path;
			$tmpReturnJS = "script type=\"text/javascript\" src=\"http://".$_SERVER['HTTP_HOST']."/".$this->theme_path;
			$tmpReturnMap = "script async defer src=\"";
			
			while(!feof($fp)){
				$tmpBuffer = fgets($fp);

				// Title Text Processing
				$tmpBuffer = preg_replace("/<fopo_title>/", $tmpReturnTitle, $tmpBuffer);
				// CSS Processing
				$tmpBuffer = preg_replace("/fopo_css path=\"/", $tmpReturnCSS, $tmpBuffer);
				// JS Processing
				if(strpos($tmpBuffer, "fopo_js") !== false) {
					$tmpBuffer = preg_replace("/fopo_js path=\"/", $tmpReturnJS, $tmpBuffer);
					$tmpBuffer = preg_replace("/>/", "></script>", $tmpBuffer);
				}
				// Map Processing
				if(strpos($tmpBuffer, "fopo_map") !== false) {
					if($tmpIsMap){
						$tmpBuffer = preg_replace("/fopo_map path=\"/", $tmpReturnMap, $tmpBuffer);
						$tmpBuffer = preg_replace("/>/", "></script>", $tmpBuffer);
					}else{
						$tmpBuffer = preg_replace("/fopo_map path=\"/", "!--", $tmpBuffer);
						$tmpBuffer = preg_replace("/>/", "-->", $tmpBuffer);
					}
				}

				// 처리속도 개선 : $buffer .= $tmpBuffer;
				echo $tmpBuffer;
				//$buffer .= fgets($fp)."<br>";
			}
			// 처리속도 개선 : echo $buffer;
			fclose($fp);
		}

		// 파일 처리
		function loadFile($org_str){
			if(trim(substr($org_str,0,1))==="/"){
				$org_str = trim(preg_replace("!/!", "", $org_str, 1));
			}

			if(strpos($org_str, "?") !== false) {
				$tmpStr = explode("?", $org_str);
				$org_str = trim($tmpStr[0]);
			}

			$tmpPath = trim(str_replace("/","",$org_str));
			if(!isset($tmpPath) || $tmpPath===""){
				$org_str = "index";
			}

			// 경로 배열화
			$tmpURI = explode("/",str_replace("\.php","".$org_str));
			$tmpIsfile = file_exists($this->theme_path.$org_str.".php");
			
			if($tmpIsfile){
				// Request Object Processing
				if($this->FOPO_TITLELIST->getIsRequest($org_str) === TRUE){
					@require_once($this->theme_path.$org_str.".php");
				}else{
					$this->loadTheme("include/include_header.htm");
					echo "\n";
					@require_once($this->theme_path.$org_str.".php");
					echo "\n";
					$this->loadTheme("include/include_footer.htm");
					echo "\n";
				}
			}else{
				$tmpIsfile = file_exists($this->theme_path.$org_str."/index.php");
				if($tmpIsfile){
					// Request Object Processing
					if($this->FOPO_TITLELIST->getIsRequest($org_str) === TRUE){
						@require_once($this->theme_path.$org_str."/index.php");
					}else{
						$this->loadTheme("include/include_header.htm");
						echo "\n";
						@require_once($this->theme_path.$org_str."/index.php");
						echo "\n";
						$this->loadTheme("include/include_footer.htm");
						echo "\n";
					}
				}else{
					$this->FOPO_PAGEPRINTER->showError("FAT 테마 파일 처리 실패", "FOPO Framework가 FAT 테마 파일 처리에 실패하였습니다.<br>FAT 테마 파일이 존재하는지 다시 확인하여 주십시오.");
				}
			}
		}

		// 페이지 처리 중 필요한 파일 처리
		function loadFAT($org_str){
			if(trim(substr($org_str,0,1))==="/"){
				$org_str = trim(preg_replace("!/!", "", $org_str, 1));
			}

			if(strpos($org_str, "?") !== false) {
				$tmpStr = explode("?", $org_str);
				$org_str = trim($tmpStr[0]);
			}

			$tmpPath = trim(str_replace("/","",$org_str));
			if(!isset($tmpPath) || $tmpPath===""){
				return "FAT LOAD ERROR.";
			}else{
				// 경로 배열화
				$tmpURI = explode("/",str_replace("\.php","".$org_str));
				$tmpIsfile = file_exists($this->theme_path.$org_str.".php");
				
				if($tmpIsfile){
					// Request Object Processing
					@require_once($this->theme_path.$org_str.".php");
					echo "\n";
				}else{
					return "FAT LOAD ERROR.";
				}
			}
		}

		// 페이지 이동
		function setGoTo($org_str){
			$tmpURI = trim($org_str);
			$tmpReturnURI = "http://".$_SERVER["HTTP_HOST"]."/".$tmpURI;
			header("Location:".$tmpReturnURI);
		}

		// 사이트 이동
		function setGoURL($org_str){
			$tmpURI = trim($org_str);
			$tmpReturnURI = $tmpURI;
			header("Location:".$tmpReturnURI);
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