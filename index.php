<?php
/*
	FOPO Framework
	designed by EunSeok Oh.

	Copyright (C) FOPO Team, All rights reserved.
*/
	
	// Framework Default Information
	define("FOPO_CORE",TRUE);
	define("FOPO_VERSION",1.01);
	define("FOPO_BUILD","RTM");
	
	// Default Directory Path
	define("FOPO_EXTERNAL_PLUGIN","system/plugin");

	// Load System Function Files
	@require_once("system/fopo_sys_config.php");
	@require_once("system/fopo_sys_pageprinter_func.php");
	@require_once("system/fopo_sys_dbloader_func.php");
	@require_once("system/fopo_sys_fatloader_func.php");
	@require_once("system/fopo_sys_authmanager_func.php");
	
	// Framework Configuration Class Load
	$FOPO_CONFIG = new FOPO_CONFIG();
	if($FOPO_CONFIG->getConfig("devmode") === true) ini_set("display_errors", 1);
	else ini_set("display_errors", 0);

	// Database Processing Engine Load
	$FOPO_DB = new FOPO_DB(new FOPO_PAGEPRINTER(), $FOPO_CONFIG->getConfig("db_id"), $FOPO_CONFIG->getConfig("db_pw"), $FOPO_CONFIG->getConfig("db_name"), $FOPO_CONFIG->getConfig("db_host"));

	// Account Processing Engine Load
	$FOPO_AUTH = new FOPO_AUTH();

	// FAT Theme Processing Engine Load
	$FOPO_FAT = new FOPO_FAT($FOPO_DB, new FOPO_PAGEPRINTER(), $FOPO_AUTH, $FOPO_CONFIG->getTheme($FOPO_AUTH->getAccessLevel()));

	// Theme File Processing
	$FOPO_FAT->loadFile($_SERVER['REQUEST_URI']);

	// Database Disconnect (for Secure Performance)
	$FOPO_DB->close();
?>