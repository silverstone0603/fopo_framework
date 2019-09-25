<?php
	// $this->loadFAT("include/include_loader");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		// 회원
		$no = $_GET["no"];
		$this->loadFAT("view/admin/photozone_info");
	}else{
		// 비회원
		$this->setGoTo("");
	}
?>