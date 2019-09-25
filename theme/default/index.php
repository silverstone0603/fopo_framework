<?php
	$this->loadFAT("include/include_loader");
	$this->loadFAT("include/include_wrap_main");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		// 회원
		$this->loadFAT("view/index/all_users");
	}else{
		// 비회원
		$this->loadFAT("view/index/all_users");
	}
	$this->loadFAT("include/include_wrap_footer_main");
?>
