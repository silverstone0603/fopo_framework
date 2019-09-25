<?php
	$this->loadFAT("include/include_loader");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		$this->loadFAT("view/admin/member");
	}else{
		$this->setGoTo("");
	}
?>