<?php
$no = $_GET['no'];
?>
<script>
	<?php if($no !== null)	{?>
	getQnaInfo(<?php echo $no ?>);
	function Qna_Edit(){
		var title = document.getElementById("qna_title").value;
		var content = document.getElementById("content").value;
		setQnaEdit(<?php echo $no;?>,title,content);
	}<?php }else{?>
	function Qna_Write(){
		var title = document.getElementById("qna_title").value;
		var content = document.getElementById("content").value;
		setQnaWrite(title,content);
	}<?php }?> 
</script>
			<div class="contents_wrap">
			<input type="hidden" id = "filename_l">
				<div class="contents_area">
					<div class="contents">
						<h3 id="title"><b>컨텐츠</b>의 <b>정보가 없습니다.</b></h3>
							<div class="content">
							<table class="noticeinfo_ta">
							<?php if($no !== null){?>
								<tr>
									<th>번호</th>
									<td><input type="textbox" disabled value="<?php echo $no;?>" id="no"></td>
								</tr><?php }?>
								<tr>
									<th>제목</th>
									<td><input type="textbox" id="qna_title" placeholder="제목"></td>
								</tr>
									<tr>
									<th>내용</th>
									<td><textarea id="content" placeholder="내용"></textarea></td>
								</tr>
								<tr><?php if($no !== null){?>
									<td colspan="2"><input type="button" class="f_r" value="수정" onclick="Qna_Edit()"><input type="button" class="f_r" value="삭제" onclick="Qna_Deleted(<?php echo $no;?>)"></td>
									<?php }else{?>
									<td colspan="2"><input type="button" class="f_r" value="작성" onclick="Qna_Write()"></td>
									<?php }?>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>