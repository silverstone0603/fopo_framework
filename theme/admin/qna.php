<?php
	// $this->loadFAT("include/include_loader");

	if($this->FOPO_AUTH->getStatus()!=="null"){
		// ȸ��
		$this->loadFAT("view/admin/qna");
	}else{
		// ��ȸ��
		$this->setGoTo("");
	}
?>