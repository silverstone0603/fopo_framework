<?php
$no = $_GET['no'];
?>
<script>
	<?php if($no !== null)	{?>
	getEventInfo(<?php echo $no ?>);
	function Event_Edit(){
		var title = document.getElementById("eve_title").value;
		var content = document.getElementById("content").value;
		var file = document.getElementById("file").value;
		if (file == ""){
			file = document.getElementById("filename_l").value;
		}
		var term = document.getElementById("term").value;
		var division = document.getElementById("division").value;
		var posting = document.getElementById("posting").value;
		var filename = file.split('\\');
		setEventEdit(<?php echo $no;?>,<?php echo $this->FOPO_AUTH->getNo() ?>,title,content,filename[filename.length-1],term,division,posting);
	}<?php }else{?>
	function Event_Write(){
		var title = document.getElementById("eve_title").value;
		var content = document.getElementById("content").value;
		var file = document.getElementById("file").value;
		var term = document.getElementById("term").value;
		var division = document.getElementById("division").value;
		var posting = document.getElementById("posting").value;
		setEventWrite(<?php echo $this->FOPO_AUTH->getNo() ?>,title,content,file,term,division,posting);
	}<?php }?> 
</script>
			<div class="contents_wrap">
			<input type="hidden" id = "filename_l">
				<div class="contents_area">
					<div class="contents">
						<h3 id="title"><b>공지</b>의 <b>정보가 없습니다.</b></h3>
							<div class="content">
							<table class="noticeinfo_ta">
							<?php if($no !== null){?>
								<tr>
									<th>번호</th>
									<td><input type="textbox" disabled value="<?php echo $no;?>" id="no"></td>
								</tr><?php }?>
								<tr>
									<th>제목</th>
									<td><input type="textbox" id="eve_title" placeholder="제목"></td>
								</tr>
									<tr>
									<th>내용</th>
									<td><textarea id="content" placeholder="내용"></textarea></td>
								</tr>
								<tr>
									<th>이미지</th>
									<td><b id="filename" class="f_l">현재파일 : </b><input type="file" id="file"></td>
								</tr>
								<tr>
									<th>기간</th>
									<td><input type="textbox" id="term" placeholder="ex)2019.08.08 ~ 2019.08.15"></td>
								</tr>
								<tr>
									<th>구분</th>
									<td><input type="textbox" placeholder="0 = 이벤트,1 = 공지" id="division"></td>
								</tr>
								<tr>
									<th>게시여부</th>
									<td><input type="textbox" placeholder="0 = 미게시, 1 = 게시" id="posting"></td>
								</tr>
								<tr><?php if($no !== null){?>
									<td colspan="2"><input type="button" class="f_r" value="수정" onclick="Event_Edit()"></td>
									<?php }else{?>
									<td colspan="2"><input type="button" class="f_r" value="작성" onclick="Event_Write()"></td>
									<?php }?>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>