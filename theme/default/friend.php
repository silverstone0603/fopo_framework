<?php
	$this->loadFAT("include/include_loader");
	$this->loadFAT("include/include_wrap_main");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		$this->loadFAT("view/friend/all_users");
	}else{
		$this->loadFAT("view/friend/all_users");
	}
	$this->loadFAT("include/include_wrap_footer_main");
?>