<?php
	$this->loadFAT("include/include_wrap_map");
	$this->loadFAT("include/include_loader");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		$this->loadFAT("view/fopomap/all_users");
	}else{
		$this->loadFAT("view/fopomap/all_users");
	}
	$this->loadFAT("include/include_wrap_footer_map");
?>
