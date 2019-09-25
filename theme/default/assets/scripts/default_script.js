/*
	Default Script File
	designed by FOPO.

	(C) FOPO Team, All rights reserved.
*/

var fopo_loaded;
var fopo_list;
var fopo_slider;
var fopo_slider_loaded = 0;
var fopo_usrid = "";

(function($){
	$(document).ready(function(){
		if ($("#loader").length){
			/*
			if ($(".fopo_wrap").length) $(".fopo_wrap").delay(0).fadeOut();
			if ($(".wrap").length) $(".wrap").delay(0).fadeOut();
			if ($(".wrap_new").length) $(".wrap_new").delay(0).fadeOut();
			if ($(".wrap_map").length) $(".wrap_map").delay(0).fadeOut();
			*/

			if ($(".fopo_popular_slider").length || $(".fopo_popular_slider_app").length) initSlider();

			console.log("[FOPO Framework] Page loading...");
		}else{
			console.log("[FOPO Framework] Page loading... (Not include Loader Layer)");
		}
	});


	$(window).on('load',function(){
		if ($("#loader").length){
			/*
			if ($(".fopo_wrap").length) $(".fopo_wrap").delay(0).fadeIn();
			if ($(".wrap").length) $(".wrap").delay(0).fadeIn();
			if ($(".wrap_new").length) $(".wrap_new").delay(0).fadeIn();
			if ($(".wrap_map").length) $(".wrap_map").delay(0).fadeIn();
			*/

			$(".lds-ripple div").delay(0).fadeOut();
			$(".lds-ripple").delay(0).fadeOut();
			$("#loader").delay(150).fadeOut("slow");
			
			if ($(".fopo_popular_slider").length && status=="success" || $(".fopo_popular_slider_app").length && status=="success") fopo_slider.reloadSlider();

			console.log("[FOPO Framework] Page loaded.");
		}else{
			console.log("[FOPO Framework] Page loaded. (Not include Loader Layer)");
		}
	});
})(jQuery);

function initSlider(){
	if ($(".fopo_popular_slider").length){
		console.log("[FOPO Framework] Included Slider.");
		$.post("/ajax_process/board_process",
		// Type
		{
		  type: "popul_lists",
		},
		// Result
		function(data,status){
			if($(".fopo_popular_slider").length && status=="success"){
				fopo_slider_loaded = 1;
				fopo_list = JSON.parse(data);
				$(fopo_list.popul_brd_lists).each(
					function(idx, brd){
						var str ='';
						str += "<div><a href=\"view?list="+brd.brd_no+"\"><img src=\"/uploads/users/"+brd.file_name+"\" width=\"225\" height=\"120\"></a></div>";
						$(".fopo_popular_slider").append(str);
				 });
				fopo_slider = $('.fopo_popular_slider').bxSlider({
					slideWidth: 230,
					moveSlides: 1,
					minSlides: 4,
					maxSlides: 4,
					slideMargin: 7,
					pager: false,
					touchEnabled: false,
				});
				console.log("[FOPO Framework] Successed to create the Slider.");
			}else{
				fopo_slider_loaded = 0;
				console.log("[FOPO Framework] Failed to create the Slider. Try again to that action.");
			}
		});
	}else if($(".fopo_popular_slider_app").length){
		console.log("[FOPO Framework] Included Slider.");
		$.post("/ajax_process/board_process",
		// Type
		{
		  type: "popul_lists",
		},
		// Result
		function(data,status){
			if($(".fopo_popular_slider_app").length && status=="success"){
				fopo_slider_loaded = 1;
				fopo_list = JSON.parse(data);
				$(fopo_list.popul_brd_lists).each(
					function(idx, brd){
						var str ='';
						str += "<div><a href=\"view?list="+brd.brd_no+"\"><img src=\"/uploads/users/"+brd.file_name+"\"></a></div>";
						$(".fopo_popular_slider_app").append(str);
				 });
				fopo_slider = $('.fopo_popular_slider_app').bxSlider({
					slideWidth: 230,
					moveSlides: 1,
					minSlides: 3,
					maxSlides: 3,
					slideMargin: 7,
					pager: false,
					touchEnabled: true,
					controls: false,
				});
				console.log("[FOPO Framework] Successed to create the Slider.");
			}else{
				fopo_slider_loaded = 0;
				console.log("[FOPO Framework] Failed to create the Slider. Try again to that action.");
			}
		});
	}else{
		console.log("[FOPO Framework] Not included Slider.");
	}
}

function getSearch() {	
	if($("#s_query").val()==""){
		alert("검색어를 입력하세요.");
	}else{
		window.location="/search?q="+$("#s_query").val();
	}
}

function getSearchResult() {	
	if($("#s_query").val()==""){
		alert("검색어를 입력 후 다시 시도해주세요.");
	}else{
		$.ajax({
			url: "/ajax_process/search_process",
			type: "POST",
			dataType:"JSON",
			data : {
				query: $("#s_query").val(),
			},
			success: function(data){
				var obj = data;
				var arrResult = obj.result;
				
				if(obj.status == 'results') {
					console.log(obj.result);
					$("#q_result_title").html("<span>"+(arrResult.length)+"개의 검색 결과가 있습니다.</span>");
					$("#q_result_link").html("");

					for(i=0; i<arrResult.length; i++){
						if(arrResult[i].count=="0" || arrResult[i].count==null || arrResult[i].count==0){
							$("#q_result_link").append("<li class=\"fp-img-next\"><span><a id=\"q_result_link\" href=\"fopozone?list="+arrResult[i].no+"\" title=\"여기를 누르면 포포존으로 이동합니다.\"><b>"+arrResult[i].placename+"</b></a><br><div class=\"desc\">게시된 사진이 없습니다.</div></span></li>");
						}else{
							$("#q_result_link").append("<li class=\"fp-img-next\"><span><a id=\"q_result_link\" href=\"fopozone?list="+arrResult[i].no+"\" title=\"여기를 누르면 포포존으로 이동합니다.\"><b>"+arrResult[i].placename+"</b></a><br><div class=\"desc\"><b>"+arrResult[i].count+"개</b>의 게시된 사진이 있습니다.</div></span></li>");
						}
					}
				}else if (obj.status == 'no_results'){
					$("#q_result_title").html("<span>검색 결과가 없습니다.</span>");
					$("#q_result_contents").html("입력한 검색어에 대한 포포존을 찾을 수 없었습니다.<br>다른 검색어로 다시 한번 검색을 시도해주세요.");
				}else if (obj.status == 'failed'){
					alert("로그인 후 검색 기능을 이용하실 수 있습니다.");
				}
			},
			error:function(xhr, status, errorThrown) {
				// 오류 발생시
				console.log("검색 실패 : " + errorThrown+" / "+status+" / "+xhr.statusText);
				alert("검색에 실패 했습니다. 다시 시도해주세요.");
			}
		});
	}
}

function login() {
	if($("#id").val()==""){
		alert("아이디를 입력하세요.");
	}else{
		$.ajax({
			url: "/ajax_process/web_process",
			type: "POST",
			dataType:"JSON",
			data : {
				type: 'web_login',
				id: $("#id").val(),
			},

			success: function(data){
				var obj = data;

				if(obj.status == 'succeed') {
					fopo_usrid = $("#id").val();
					var str = "<p><img src=\"theme/default/assets/images/fopo_login_step2_img.png\" width=\"800\" height=\"500\" title=\"로그인 도움말 이미지\" title=\"로그인 도움말 이미지\"><br>";
					str += "<input id=\"verify\" name=\"verify\" class=\"txtNormal\" type=\"text\" value=\"\" placeholder=\"인증번호\" onkeyup=\"javascript:if (window.event.keyCode == 13) verify()\"><br>";
					str += "<input type=\"button\" value=\"인증 확인\" onclick=\"javascript:verify()\"></p>";
					$(".content").html(str);
					alert("FOPO앱으로 인증 코드를 전송하였습니다.");
				} else if (obj.status == 'exist_session') {
					alert("이미 로그인을 요청한 기록이 있습니다. 잠시 후에 다시 시도해주세요.");
				} else if (obj.status == 'not_exist_session') {
					alert("FOPO앱에서 먼저 로그인 해주세요.");
				}
			},
			error:function(xhr, status, errorThrown) {
				// 오류 발생시
				console.log("로그인 실패 : " + errorThrown+" / "+status+" / "+xhr.statusText);
				alert("로그인에 실패 했습니다. 다시 시도해주세요.");
			}
		});
	}
}

function verify() {
	if($("#verify").val()==""){
		alert("인증번호를 입력하세요.");
	}else{
		$.ajax({
			url: "/ajax_process/web_process",
			type: "POST",
			dataType:"JSON",
			data:{
				type: 'web_verify',
				id: fopo_usrid,
				verify: $("#verify").val(),
			},
			success: function(data){
				var obj = data;

				if(obj.status == 'succeed') {
					window.location = "/";
				} else if (obj.status == 'failed') {
					alert("인증 번호 확인에 실패 했습니다. 인증 번호를 다시 확인해주세요.");
				}
			},
			error: function(xhr, status, errorThrown){
				// 오류 발생시
				console.log("로그인 실패 : " + errorThrown+" / "+status+" / "+xhr.statusText);
				alert("로그인에 실패 했습니다. 다시 시도해주세요.");
			}
		});
	}
}