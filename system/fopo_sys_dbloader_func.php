<?php
/*
	FOPO Framework
	designed by EunSeok Oh.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");
	
	class FOPO_DB {
		private $OBJ_CON;
		private $OBJ_DB;
		private $FOPO_PAGEPRINTER;
		private $userid;
		private $password;
		private $dbname;
		private $server;
		
		function __construct($page_object, $userid, $password, $dbname, $server) {
			$this->FOPO_PAGEPRINTER = $page_object;
			$this->userid = $userid;
			$this->password = $password;
			$this->dbname = $dbname;
			$this->server = $server;

			$this->connect();
		}
	 
		function __destruct() {
			$this->close();
		}
		
		// MYSQL Database connection
		function connect() {
			$this->OBJ_CON = mysql_connect($this->server, $this->userid, $this->password) or $this->FOPO_PAGEPRINTER->showError("DB 접속 오류",mysql_error());
			$this->OBJ_DB = mysql_select_db($this->dbname) or $this->FOPO_PAGEPRINTER->showError("DB 접속 오류",mysql_error()) or $this->FOPO_PAGEPRINTER->showError("DB 접속 오류",mysql_error());
			
			return $this->OBJ_CON;
		}
		
		// Connection Services Database
		function query($content, $opt_simple) {
			global $CONF;
			
			if (!isset($this->OBJ_CON) or !$this->OBJ_CON) $this->connect();
			if($opt_simple === true || $opt_simple === 1){
				return mysql_query(str_replace("' ", "'", $content));
			}else{
				return mysql_query($content);
			}
		}
		
		function fetch($content, $type) {
			if (!isset($this->OBJ_CON) or !$this->OBJ_CON) $this->connect();
			switch($type){
				case 0:
					return mysql_fetch_array($content);
					break;
				case 1:
					return mysql_fetch_assoc($content);
					break;
				case 2:
					return mysql_fetch_row($content);
					break;
				default:
					return mysql_fetch_array($content);
					break;
			}
		}
		
		function isExist($content){
			if (!isset($this->OBJ_CON) or !$this->OBJ_CON) $this->connect();
			$tmpQuery = $this->fetch($this->query("SELECT EXISTS( $content ) as result"), 1)["result"];
			return $tmpQuery;
		}

		function getCountNum($content) {
			if (!isset($this->OBJ_CON) or !$this->OBJ_CON) $this->connect();
			return mysql_num_rows($content);
		}
		
		// MYSQL Database disconnection
		function close() {
			return @mysql_close();
		}
		
	}
 
?>