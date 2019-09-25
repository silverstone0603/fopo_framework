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
    height: 150px;
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
			<img src="../theme/default/assets/images/daegu_weather.PNG" width="100%" height="110px">
        </div>
		<div class="main_3">
            <h2 class="m_m_title">이번주 인기 게시물</h2>
			<div class="fopo_popular_slider_app"></div>
        </div>
        <div class="main_4">
            <h2 class="m_m_title">이번주 대구의 인기 포토는?</h2>
            <div class="slider">
				<div><img src="http://via.placeholder.com/230x300"></div>
				<div><img src="http://via.placeholder.com/230x300"></div>
				<div><img src="http://via.placeholder.com/230x300"></div>
			</div>
        </div>
		<div class="notice">
            <h2 class="m_m_title" align="center">공지 및 이벤트</h2>
            <table class="notice_list">
			</table>
        </div>
    </div>
