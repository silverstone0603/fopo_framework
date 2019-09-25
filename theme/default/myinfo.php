<?php
	$this->loadFAT("include/include_loader");
	$this->loadFAT("include/include_wrap_main");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		$this->loadFAT("view/myinfo/login_users");
	}else{
		$this->setGoTo("login");
	}
	$this->loadFAT("include/include_wrap_footer_main");
?>