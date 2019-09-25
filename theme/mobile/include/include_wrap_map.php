<div class="wrap_map">
	<div class="nav_wrap">
		<div class="nav_contents">
			<div class="logo">
				<a href="/"><img src="<?php echo $this->theme_path; ?>/assets/images/logo_fopo_img.png" width="70px" height="70px" title="FOPO"></a>
				<ul class="menu">
					<li><a href="/fopomap"><i class="fp-img-marker icon"></i><span>포포맵</span></a></li>
					<?php 	if($this->FOPO_AUTH->getStatus()!=="null"){ ?>
					<li><a href="/myinfo"><i class="fp-img-userinfo icon"></i><span>내 정보</span></a></li>
					<?php } ?>
					<li><a href="/help"><i class="fp-img-help icon"></i><span>도움말</span></a></li>
				</ul>
			</div>
			<div class="search">
				<input id="s_query" class="fp-img-search" type="text" placeholder="오늘은 어디로 떠나고 싶으신가요?" value="">
			</div>
			<div class="userinfo">
				<?php 	if($this->FOPO_AUTH->getStatus()!=="null"){ ?>
				<a href="logout"><i class="fp-img-user icon"></i><span>로그아웃</span></a></a>
				<?php }else{ ?>
				<a href="login"><i class="fp-img-user icon"></i><span>로그인</span></a></a>
				<?php } ?>
			</div>
		</div>
	</div>