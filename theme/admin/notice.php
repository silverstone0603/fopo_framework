<?php
	// $this->loadFAT("include/include_loader");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		// 회원
		$this->loadFAT("view/admin/notice");
	}else{
		// 비회원
		$this->setGoTo("");
	}
?>