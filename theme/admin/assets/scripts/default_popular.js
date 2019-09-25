
function getPopularView() {
	console.log("View");

	$.post("/ajax_process/popular_process",
    {
      type: "view",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			console.log(fopo_list);
			$(fopo_list.pop_view).each(
				function(idx, view){
					console.log("test");
					var str='';
					str +="<div class=\"f_l\">";
					str +="<a href=\"/view?list="+view.brd_no+"\"><img src=/uploads/users/"+view.filename+" class=\"today_Thum\"></a>";
					str +="</div>";
					str +="<div style=\"line-height:30px;\">";
					str +="<p>작성자 : "+view.mem_nick+"</p>";
					str +="<p>조회수 : "+view.brd_view+"</p>";
					str +="<p>장소 : 수성못 </p>";
					str +="<p>오늘 날씨 : 최고 31º 최저 18º</p></div>";
					$(".today_view").append(str);
				}
			);
    });
}

function getPopularLike(){
	console.log("Like");

	$.post("/ajax_process/popular_process",
    {
      type: "like",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			console.log(fopo_list);
			$(fopo_list.pop_like).each(
			  function(idx, like){
					var str='';
					str +="<div class=\"f_l\">";
					str +="<a href=\"/view?list="+like.brd_no+"\"><img src='cdn_process/photo?no="+like.brd_no+"' class=\"today_Thum\"></a>";
					str +="</div>";
					str +="<div style=\"line-height:30px;\">";
					str +="<p>작성자 : "+like.mem_nick+"</p>";
					str +="<p>좋아요 : "+like.brd_like+"</p>";
					str +="<p>장소 : 수성못</p>";
					str +="<p>오늘 날씨 : 최고 31º 최저 18º</p></div>";
					$(".today_like").append(str);
					console.log(str);
					
			  }
			);
    });
}