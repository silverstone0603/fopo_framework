

<style>
	ul {
	margin: 0;
	padding: 0;
	}
	li {
	list-style-type: none;
	}
	a {
	text-decoration: none;
	}


	.horizontal-menu {
	display: inline-block;
	overflow: hidden;

	}
	.horizontal-menu li {
	float: left;
	}
	.horizontal-menu a {
	display: block;
	height: 50px;
	line-height: 50px;
	background-color: #797b7b;
	color: #ddd;
	padding: 0 76px;
	border-right: 1px solid #000000;
	}


	.info_ta {
	  border-collapse: collapse;
	  width: 95%;
	}

	.info_ta th, td {
	  padding: 8px;
	  text-align: left;
	  border-bottom: 1px solid #ddd;
	}

	.info_ta th {
		background-color:#fafafa;
	}



	.loginlog_ta {
		border-collapse: collapse;
		width: 95%;
	}

	.loginlog_ta th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	.loginlog_ta th {
		width:10%;
		background-color:#fafafa;
	}



	.filter_ta {
		border-collapse: collapse;
		width: 95%;
	}

	.filter_ta th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	.filter_ta th {
		width:10%;
		background-color:#fafafa;
	}


        .h_graph ul{margin:0 50px 0 50px;padding:1px 0 0 0;border:1px solid #ddd;border-top:0;border-right:0;font-size:11px;font-family:Tahoma, Geneva, sans-serif;list-style:none}
        .h_graph li{position:relative;margin:10px 0;vertical-align:top;white-space:nowrap}
        .h_graph .g_term{position:absolute;top:0;left:-50px;width:40px;font-weight:bold;color:#767676;line-height:20px;text-align:right}
        .h_graph .g_bar{display:inline-block;position:relative;height:20px;border:1px solid #ccc;border-left:0;background:#e9e9e9}
        .h_graph .g_bar span{position:absolute;top:0;right:-50px;width:40px;color:#767676;line-height:20px}





</style>

<div class="wrap_admin">
	<div class="nav_wrap">
		<div class="nav_contents">
			<div class="logo">
				<a href="/"><img src="<?php echo $this->theme_path; ?>/assets/images/logo_fopo_img.png" width="70px" height="70px" title="FOPO"></a>
				<ul class="menu">
					<li><a href="/fopomap"><i class="fp-img-marker icon"></i><span>포포맵</span></a></li>
					<li><a href="/myinfo"><i class="fp-img-userinfo icon"></i><span>내 정보</span></a></li>
					<li><a href="/help"><i class="fp-img-help icon"></i><span>도움말</span></a></li>
				</ul>
			</div>
			<div class="search">
				<input id="s_query" class="fp-img-search" type="text" placeholder="오늘은 어디로 떠나고 싶으신가요?" value="">
			</div>
			<div class="userinfo">
				<a href="login"><i class="fp-img-user icon"></i><span>로그인</span></a></a>
			</div>
		</div>
	</div>
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
				<ul class="horizontal-menu">
					<li><a href="#">회원 관리</a></li>
					<li><a href="#">필터 관리</a></li>
					<li><a href="#">접속 관리</a></li>
					<li><a href="#">포즈 관리</a></li>
					<li><a href="#">사진 관리</a></li>
					</ul>

			<div class="info">
				<h2>회원관리</h2>
				<select>
				<option>10</option>
				<option>20</option>
				<option>30</option>
				</select>개씩 보기


				<select>
				<option>이름</option>
				<option>전화번호</option>
				<option>이메일</option>
				</select>
				<input type="text" name="name">
				<input type="submit" value="Search">
				<p>

				<table class="info_ta">
				  <tr>
					<th>번호</th>
					<th>이름</th>
					<th>전화번호</th>
					<th>이메일</th>
				  </tr>
				  <tr>
					<td>1</td>
					<td>홍길동</td>
					<td>010-1111-1111</td>
					<td>hong@nate.com</td>
				  </tr>
				  <tr>
					<td>2</td>
					<td>홍길동</td>
					<td>010-1111-1111</td>
					<td>hong@nate.com</td>
				  </tr>
				  <tr>
					<td>3</td>
					<td>홍길동</td>
					<td>010-1111-1111</td>
					<td>hong@nate.com</td>
				  </tr>
				  <tr>
					<td>4</td>
					<td>홍길동</td>
					<td>010-1111-1111</td>
					<td>hong@nate.com</td>
				  </tr>
				  <tr>
					<td>5</td>
					<td>홍길동</td>
					<td>010-1111-1111</td>
					<td>hong@nate.com</td>
				  </tr>
				</table>


			</div>

			<div class ="filter_ta">
			<h2>필터관리</h2>
				<input id="1" type="radio" name="1">
				<label for="1">필터 1</label>
				<input id="2" type="radio" name="2">
				<label for="1">필터 2</label>
				<input id="3" type="radio" name="3">
				<label for="1">필터 3</label>
				<input id="4" type="radio" name="4">
				<label for="1">필터 4</label>&nbsp;
				<input type="submit" value="Search">
				<p>

			<table class ="filter_ta">
				<tr>
					<th>아이디</th>
					<th>사용필터</th>
					<th>포토존</th>
				</tr>
				<tr>
					<td>sarang123</td>
					<td>필터 1</td>
					<td>영진전문대 벚꽃나무 밑</td>
				</tr>
				<tr>
					<td>eastgodS2</td>
					<td>필터 4</td>
					<td>강정보 디아크 전시관 앞</td>
				</tr>
				<tr>
					<td>rainbow97</td>
					<td>필터 2</td>
					<td>계명대 정문 입구 동상</td>
				</tr>
				<tr>
					<td>qwer1234q</td>
					<td>필터 2</td>
					<td>서울대 정문 입구</td>
					</tr>
			</table>
			</div>



			<div class ="loginlog_ta">
			<h2>접속관리</h2>

			<input type="text" placeholder="아이디" name="name">
			<input type="submit" value="Search">
			<p>
			<table class ="loginlog_ta">
				<tr>
					<th>일시</th>
					<th>기기/OS</th>
					<th>브라우저</th>
					<th>IP</th>
					<th>서비스(앱)</th>
				</tr>
				<tr>
					<td>2019-05-11 19:21:06</td>
					<td>Windows 10</td>
					<td>IE</td>
					<td>192.168.0.2</td>
					<td>web</td>
				</tr>
				<tr>
					<td>2019-05-11 19:21:06</td>
					<td>Windows 10</td>
					<td>IE</td>
					<td>192.168.0.2</td>
					<td>web</td>
				</tr>
				<tr>
					<td>2019-05-11 19:21:06</td>
					<td>Windows 10</td>
					<td>IE</td>
					<td>192.168.0.2</td>
					<td>web</td>
				</tr>
				<tr>
					<td>2019-05-11 19:21:06</td>
					<td>Windows 10</td>
					<td>IE</td>
					<td>192.168.0.2</td>
					<td>web</td>
					</tr>
			</table>

			</div>

			<div class ="h_graph">
			<h2>포즈관리</h2>


			<div id="piechart"></div>
				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">

				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
				  var data = google.visualization.arrayToDataTable([
				  ['pose', 'Hours per Day'],
				  ['포즈1', 8],
				  ['포즈2', 2],
				  ['포즈3', 4],
				  ['포즈4', 2],
				  ['포즈5', 10]
				]);

				  var options = {'title':'포즈 선호도', 'width':550, 'height':400};
				  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
				  chart.draw(data, options);
				}
				</script>

        <ul>
            <li><span class="g_term">포즈 1</span><span class="g_bar" style="width:12%"><span>12%</span></span></li>
            <li><span class="g_term">포즈 2</span><span class="g_bar" style="width:30%"><span>30%</span></span></li>
            <li><span class="g_term">포즈 3</span><span class="g_bar" style="width:50%"><span>50%</span></span></li>
            <li><span class="g_term">포즈 4</span><span class="g_bar" style="width:60%"><span>60%</span></span></li>
            <li><span class="g_term">포즈 5</span><span class="g_bar" style="width:82%"><span>82%</span></span></li>
        </ul>
			</div>

			<div class ="photo">
			<h2>사진관리</h2>



			</div>
		</div>
	</div>
</div>