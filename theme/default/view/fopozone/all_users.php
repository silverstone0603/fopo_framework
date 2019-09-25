<?php $brd_no = $_GET['list'];?>
<script>
	getBoardLists(<?php echo $brd_no ?>);
</script>
	<div class="contents_wrap">
		<div class="contents_area">
			<div class="sub_nav">
				<ul>
					<li class="fp-img-next"><a href="/today"><span>이번주의 추천 여행지</span></a></li>
					<li class="fp-img-next"><a href="/popular"><span>오늘의 인기 순위</span></a></li>
					<li class="fp-img-next"><a href="/help"><span>도움말</span></a></li>
				</ul>
			</div>
			<div class="contents">
				<div class="part">
					<div class="title"><span>오늘은 어디로 떠나볼까요?</span></div>
					<div class="content">
						<div class="main">
							<div class="main_content">
								<div class="board_Thum" style="margin-top:20px;">
									<div class="Thum">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>