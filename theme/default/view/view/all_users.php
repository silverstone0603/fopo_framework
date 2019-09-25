<?php
	$view_no = $_GET['list'];
?>
<script>
	getBoardView(<?php echo $view_no;?>);
	getBoardReply(<?php echo $view_no;?>);
	function ReplyWrite(){
		var re_com = document.getElementById("re_com").value;
		var zone_no = document.getElementById("zone_no").value;
		if (re_com != "") setBoardReplyWrite(zone_no,<?php echo $view_no ?>,<?php echo ($_SESSION['fopo_no'] == null)?"0":$_SESSION['fopo_no']; ?>,null,re_com);
		else alert("댓글 내용이 없습니다");
				
		//지금 외래키 설정 되있어서 다른 사용자는 댓글 못달게되있음. $_SESSION['fopo_no'];
	};
	
	

</script>
	<div class="contents_wrap">
		<div class="contents_area">
			<div class="sub_nav">
				<ul>
					<li class="fp-img-next"></li>
				</ul>
			</div>
			<div class="contents">
				<div class="part">
					<div class="title"><span>사진 상세보기</span></div>
					<div class="content">
						<div class="main">
							<div class="main_content">
								<div class="view">
								</div>
								<?php if($this->FOPO_AUTH->getStatus()!=="null"){ ?>
								<div class="reply_write">
									<input type="text" id="re_com" placeholder="댓글 내용" style="">
									<input type="button" id="re_wri" onclick ="ReplyWrite()" value="작성"/>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>