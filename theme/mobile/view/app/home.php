<meta name="viewport" content="width=device-width, user-scalable=no">
<style>
.m_main{
    width: 100%;
	padding-bottom: 30px;
	margin-top: 20px;
}
.main_1{
    width: 100%;
    height: 220px;
    border-bottom: 1px solid black;
}
.main_2{
    width: 100%;
    height: 300px;
    border-bottom: 1px solid black;
}
.main_3{
    width: 100%;
    height: 220px;
    border-bottom: 1px solid black;
}
.main_4{
    width: 100%;
    height: 220px;
    border-bottom: 1px solid black;
}
.m_title{
     background: linear-gradient(to right, #FF33FF, #800080);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin: 10px 5px 20px 10px;
	font-size: 20px;
}
.notice .m_m_title{
	margin-left: 0;
	font-size: 14px;
}
.m_m_title{
    margin-left: 20px;
    font-size: 14px;
}
.list_view{
    margin: 5% auto auto 5%;
}
.list_view img{
	width: 31%;
	height: 180px;
	border-radius: 15px;
}
.notice{
    width: 100%;
}

table {
  border-collapse: collapse;
  width: 100%;
}
.weather tr, .weather td,.weather th{
height:30px;
}
th, td {
  padding: 8px;
  height: 80px;
  text-align: center;
  border-bottom: 1px solid #ddd;
  border-top: 1px solid #ddd;
}
.slider img, .fopo_popular_slider_app img{
	width: 130px;
}
.weather img{
width:35px;
height:35px;
}

</style>
<script>
$(function(){
  $('.slider').bxSlider({
    slideWidth: 230,
	moveSlides: 1,
	minSlides: 3,
	maxSlides: 3,
	slideMargin: 7,
	pager: false,
	touchEnabled: true,
	controls: false,
  });
});
getEventList();
</script>
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

<div id="loader"><div class="lds-ripple"><div></div><div></div></div></div>
    <div class="m_main">
		<h1 class="m_title">지난주 사용자가 제일 많이<br> 다녀간 장소는 대구입니다.</h1>
        <div class="main_1">
            <h2 class="m_m_title">이번 달 대구의 행사정보 입니다.</h2>
             <div class="slider">
				<div><img src="../theme/default/assets/images/daegu_post_1.png"></div>
				<div><img src="../theme/default/assets/images/daegu_post_2.png"></div>
				<div><img src="../theme/default/assets/images/daegu_post_3.png"></div>
			</div>
        </div>
        <div class="main_2">
            <h2 class="m_m_title">이번주 대구의 주간 날씨는?</h2>
			<div class="weather">
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
						<td>최저<?php echo $result_xml->body->items->item->$str; ?></td><?php }?>
					</tr>
					<tr>
					<?php for($i = 3; $i < 10; $i++){ 
						$str="taMax".$i; ?>
						<td>최고<?php echo $result_xml->body->items->item->$str; ?></td><?php }?>
					</tr>
					<tr>
					<?php for($i = 3; $i < 10; $i++){ 
						if($i<=7) $str= "wf".$i."Am";
						else $str="wf".$i;?>
						<td><?php 
							switch($result_xml2->body->items->item->$str){
								case "흐리고 비":
								case "구름많고 비":
									echo "<img src=\"../theme/default/assets/images/Weather_Rain.png\">";
								break;
								case "구름많음":
									echo "<img src=\"../theme/default/assets/images/Weather_Cloud.png\">";
								break;
								case "맑음":
									echo "<img src=\"../theme/default/assets/images/Weather_Sun.png\">";
								break;
						}
						//echo $result_xml2->body->items->item->$str; ?></td><?php }?>

					</tr>
					<tr>
					<?php for($i = 3; $i < 10; $i++){ 
						if($i<=7) $str="rnSt".$i."Am";
						else $str="rnSt".$i;?>
						<td>강수<?php echo $result_xml2->body->items->item->$str; ?>%</td><?php }?>
					</tr>
				</table>
			</div>
        </div>
		<div class="main_3">
            <h2 class="m_m_title">이번주 인기 게시물</h2>
			<div class="fopo_popular_slider_app"></div>
        </div>
        <div class="main_4">
            <h2 class="m_m_title">이번주 대구의 인기 포토는?</h2>
            <div class="slider">
				<div><img src="../theme/default//assets/images/1.PNG"></div>
				<div><img src="../theme/default//assets/images/2.PNG"></div>
				<div><img src="../theme/default//assets/images/3.PNG"></div>
			</div>
        </div>
		<div class="notice">
            <h2 class="m_m_title" align="center">공지사항 및 이벤트</h2>
            <table class="notice_list">
			</table>
        </div>
    </div>
