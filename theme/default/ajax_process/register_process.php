<?php
/*
	FOPO Framework
	designed by EunSeok Oh.
	
	edited by Sangwon Kim,
	Lastest Updated : 19-05-16.

	Copyright (C) FOPO Team, All rights reserved.
*/
	if(!defined("FOPO_CORE")) header("Location:http://106.10.51.32/");

	$mem_id = $_POST['mem_id'];
	$mem_pw = $_POST['mem_pw'];
	$mem_nickname = $_POST['mem_nickname'];
	$mem_phone = $_POST['mem_phone'];
	$mem_gender = $_POST['mem_gender'];

	echo isset($this->FOPO_DB);
?>