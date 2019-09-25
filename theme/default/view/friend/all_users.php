<script>
getFriendList(<?php echo $_SESSION['fopo_no']?>);
</script>
<style>

table, td, th { 
  text-align: center;
  border-bottom: 1px solid #ddd;
}
td:nth-child(2n-1){
  border-right: 1px solid #ddd;
}
table {
  border-collapse: collapse;
  width: 400px;
}

th, td {
  padding: 15px;
}
</style>
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
					<div class="title"><span>친구 리스트</span></div>
					<div class="content">
						<div class="main">
							<div class="main_content">
								<div class="board_Thum" style="margin-top:4px;">
									<table class="frined_list">
									  <tr>
										<td>닉네임</td>
										<td>글 갯수</td>
									  </tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>