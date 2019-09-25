<?php
$no = $_GET["no"];?>
<script>
getMemberInfo(<?php echo $no; ?>);
getMemberLog(<?php echo $no; ?>);
getMemberQuelist(<?php echo $no; ?>);
function Info_Edit(){
	var id = document.getElementById("id").value;
	var nick = document.getElementById("nick").value;
	var phone = document.getElementById("phone").value;
	var email = document.getElementById("email").value;
	var pw = document.getElementById("pw").value;
	setMemberInfo(id,nick,phone,email,pw,<?php echo $no; ?>);
}
</script>
			<div class="contents_wrap">
				<div class="contents_area">
							<div class="content">
						<h3 class="nickName"><b>멤버</b>의 <b>정보가 없습니다.</h3>
								<table class="myinfo_ta">
								</table>
							</div>
						</div>
						<br>
						<div class="part">
						
						<h3><b>접속 기록</b></h3>
								<table class="loginlog_ta">
									<thead>
									<tr>
										<th>일시</th>
										<th>기기/OS</th>
										<th>브라우저</th>
										<th>IP</th>
									</tr>
									</thead>
									<tbody>
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>