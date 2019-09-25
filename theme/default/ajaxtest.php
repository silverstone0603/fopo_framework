<?php
	if($this->FOPO_AUTH->getStatus()!=="null"){
		$this->loadFAT("view/test/ajax_test");
	}else{
		$this->setGoTo("");
	}
?>