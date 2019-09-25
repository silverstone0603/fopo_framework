	<div class="contents_wrap">
		<div class="contents_area">
			<div class="sub_nav">
				<ul>
					<li class="fp-img-next"><a href="/myinfo"><span>내 정보</span></a></li>
				</ul>
			</div>
			<div class="contents">
				<div class="part">
					<div class="title"><span>회원 정보 수정</span></div>
					<div class="content">
						<table class="myinfo_ta">
							<tr>
								<td>아이디</td>
								<td><i><?php echo $this->FOPO_AUTH->getID() ?></i></td>
							</tr>
							<tr>
								<td>비밀번호</td>
								<td><input type ="password"></td>
							</tr>
							<tr>
								<td>비밀번호 확인</td>
								<td><input type ="password">&nbsp<input type ="submit" value="수정"></td>
							</tr>
							<tr>
								<td>이메일</td>
								<td><?php echo $this->FOPO_AUTH->getEmail() ?></td>
							</tr>
							<tr>
								<td>성별</td>
								<td><?php echo $this->FOPO_AUTH->getGender() === "1" ? "남자":"여자" ?></td>
							</tr>
							<tr>
								<td>닉네임</td>
								<td><i><?php echo $this->FOPO_AUTH->getNick() ?></i></td>
							</tr>
							<tr>
								<td>전화번호</td>
								<td><i><?php echo $this->FOPO_AUTH->getPhone() ?></i></td>
							</tr>
						</table>
					</div>
				</div><br>
				<div class="part">
					<div class="title"><span>로그인 기록</span></div>
					<div class="content">
						<table class="loginlog_ta">
							<tr>
								<th>일시</th>
								<th>기기/OS</th>
								<th>브라우저</th>
								<th>IP</th>
								<th>서비스(앱)</th>
							</tr>
							<tr>
								<td>2019-07-11 10:58:15</td>
								<td>Windows 10</td>
								<td>IE</td>
								<td>192.168.0.2</td>
								<td>web</td>
							</tr>
							<tr>
								<td>2019-07-13 11:43:12</td>
								<td>Windows 10</td>
								<td>IE</td>
								<td>192.168.0.2</td>
								<td>web</td>
							</tr>
							<tr>
								<td>2019-07-15 19:21:06</td>
								<td>Android</td>
								<td>Android</td>
								<td>192.168.0.2</td>
								<td>Android</td>
							</tr>
							<tr>
								<td>2019-07-18 16:21:06</td>
								<td>Windows 10</td>
								<td>Chrome</td>
								<td>192.168.0.2</td>
								<td>web</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>