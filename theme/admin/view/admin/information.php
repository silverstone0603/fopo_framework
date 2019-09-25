<?php $brd_no = $_GET['no'];?>
<script>
getArticleInfo(<?php echo $brd_no;?>);
admgetBoardReply(<?php echo $brd_no;?>);

function Info_Edit(){
}
</script>
			<div class="contents_wrap">
				<div class="contents_area">
							<div class="content">
						<h3><b>게시글</b>의 <b>정보</b>입니다.</h3>
						<input class="f_r" type ="submit" onclick="Info_Edit()" value="저장">
								<table class="info_ta">
								</table>

						<h3><b>게시글</b>의 <b>댓글</b>입니다.</h3>
								<table class="reply_ta">
								<thead>
									<tr>
										<th style="width:10%">닉네임</th>
										<th style="width:50%">댓글</th>
										<th style="width:30%">작성일</th>
										<th style="width:10%">삭제</th>
									</tr>
								</thead>
								<tbody class="reply_data">
									
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>