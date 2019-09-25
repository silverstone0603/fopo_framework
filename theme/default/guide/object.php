<div class="fopo_wrap">
	<div class="logo">
		<img src="../<?php echo $this->theme_path; ?>assets/images/logo_fopo_img.png" width="75" height="75">
	</div>
	<div class="title">
		<span>FOPO Framework<br>User GuideBook</span>
	</div>
	<div class="contents">
		<h5><a href="/guide/index">홈</a> | <a href="/guide/about">소개</a> | <a href="/guide/object">내장 객체</a> | <a href="/guide/function">내장 함수</a></h5>
		<h4>$this : FAT(FOPO Awesome Theme) 처리 객체</h4>
		<h5>기본적으로 이 프레임워크는 파일의 입출력 관리를 FAT 테마 문법 처리 객체에서 처리하도록 설계 되어 있습니다. 일반 View 페이지에서는 Header 및 Footer 파일을 기본적으로 불러와서 처리하도록 설계 되어 있으나, 필요시 $this->loadFAT($file_path) 함수를 이용해서 Navigation Menu 처리 파일 또는 Footer 파일을 별도로 처리하도록 관리할 수 있습니다.</h5>
		<h4>$this->FOPO_DB : 데이터베이스 객체</h4>
		<h5>이 프레임워크에서는 기본적으로 DB 접속을 위한 객체를 기본적으로 제공하고 있습니다.<br>이 DB 객체를 이용해서 SQL 쿼리문 처리가 가능합니다.<br><br>connect(), query($content), fetch($content, $type), getCountNum($content), close() 와 같은 함수가 있으며, $content는 SQL Query Script를 의미하며, $type은 Return 방식을 지정합니다. 0은 array, 1은 assoc, 2는 row이며, 입력하지 않을 경우 array 방식으로 Result값을 Return합니다.</h5>
		<h4>$this->FOPO_PAGEPRINTER : 시스템 페이지 처리 객체</h4>
		<h5>기본적으로 이 프레임워크는 Request 방식으로 모든 데이터를 처리하도록 설계 되어 있으나, 일반 View 페이지에서는 사용자 화면에 알림 메시지를 표시해야하는 경우도 있을 수 있습니다. 그럴 때에는 $this->FOPO_PAGEPRINTER->showError("title", "content") 함수를 이용하여 사용자의 화면에 알림 메시지를 표시할 수 있습니다.</h5>
	</div>
</div>