<?php 
	$today = date("Ymd");

	$weather = file_get_contents("http://newsky2.kma.go.kr/service/MiddleFrcstInfoService/getMiddleTemperature?ServiceKey=LnYa9yROAm1TnIL4eGzY2xtlfJIJ%2FojJMBjU91%2BrTlvYc2YinPx1E9RCA%2Fv6zyWC7dNXkEQBwx4%2B5ts18w48bA%3D%3D&regId=11H10701&tmFc=".$today."0600");
	$result_xml = simplexml_load_string($weather);

	$weather2 = file_get_contents("http://newsky2.kma.go.kr/service/MiddleFrcstInfoService/getMiddleLandWeather?ServiceKey=LnYa9yROAm1TnIL4eGzY2xtlfJIJ%2FojJMBjU91%2BrTlvYc2YinPx1E9RCA%2Fv6zyWC7dNXkEQBwx4%2B5ts18w48bA%3D%3D&regId=11H10000&tmFc=".$today."0600");
	$result_xml2 = simplexml_load_string($weather2);

	//$festival = file_get_contents("http://dgfc.or.kr/performance/xml/calenderMonth.asp?year=2019&month=08");
	//$result_fest = simplexml_load_string($festival);
	//print_r($result_fest);
?>
<style>
.weather tr td, .weather tr th{
text-align:center;
}
.weather img{
width:50px;
height:50px;
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
					<div class="title"><span>이번주의 추천 여행지</span></div>
					<div class="content">
						<div class="main">
							<div class="main_content">
								<h2>지난주 사용자가 제일 많이 다녀간 장소는 <b>대구</b>입니다.</h2>
								<div class="gallery">
								<h3>이번 달 <b>대구</b>의 <b>행사</b>정보 입니다.</h3>
									<img src="<?php echo $this->theme_path; ?>/assets/images/daegu_post_1.png">
									<img src="<?php echo $this->theme_path; ?>/assets/images/daegu_post_2.png">
									<img src="<?php echo $this->theme_path; ?>/assets/images/daegu_post_3.png">
									<img src="<?php echo $this->theme_path; ?>/assets/images/daegu_post_4.png">
								</div>
								<div class="weather">
								<h3>이번주 <b>대구</b>의 <b>주간 날씨</b>는?</h3>
									<table class="weather">
										<tr>
											<th width="105px">월</th>
											<th width="105px">화</th>
											<th width="105px">수</th>
											<th width="105px">목</th>
											<th width="105px">금</th>
											<th width="105px">토</th>
											<th width="105px">일</th>
										</tr>
										<tr>
										<?php for($i = 3; $i < 10; $i++){ 
											$str="taMin".$i;?>
											<td>최저 : <?php echo $result_xml->body->items->item->$str; ?></td><?php }?>
										</tr>
										<tr>
										<?php for($i = 3; $i < 10; $i++){ 
											$str="taMax".$i; ?>
											<td>최고 : <?php echo $result_xml->body->items->item->$str; ?></td><?php }?>
										</tr>
										<tr>
										<?php for($i = 3; $i < 10; $i++){ 
											if($i<=7) $str= "wf".$i."Am";
											else $str="wf".$i;?>
											<td><?php
												switch($result_xml2->body->items->item->$str){
												case "흐리고 비":
													echo "<img src=\"".$this->theme_path."/assets/images/Weather_Rain.png\">";
												break;
												case "구름많음":
													echo "<img src=\"".$this->theme_path."/assets/images/Weather_Cloud.png\">";
												break;
												case "맑음":
													echo "<img src=\"".$this->theme_path."/assets/images/Weather_Sun.png\">";
												break;
											}
												echo "<br>".$result_xml2->body->items->item->$str; 
											?></td><?php }?>
										</tr>
										<tr>
										<?php for($i = 3; $i < 10; $i++){ 
											if($i<=7) $str="rnSt".$i."Am";
											else $str="rnSt".$i;?>
											<td>강수 : <?php echo $result_xml2->body->items->item->$str; ?>%</td><?php }?>
										</tr>
									</table>
								</div>
								<div class="photozone">
								<h3>이번주 <b>대구</b>의 <b>인기 포토</b>는?</h3>
									<div class="gallery">
									<img src="cdn_process/photo?no=120">
									<img src="cdn_process/photo?no=122">
									<img src="cdn_process/photo?no=121">
									<img src="cdn_process/photo?no=118">
								</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>