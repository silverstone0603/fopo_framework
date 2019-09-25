/*
	Default Script File
	designed by FOPO.

	(C) FOPO Team, All rights reserved.
*/

var fopo_loaded;
var fopo_list;
var fopo_slider;
var fopo_slider_loaded = 0;

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
		$.post("/process/board_process",
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
		$.post("/process/board_process",
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
/*
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
	}else{
		console.log("[FOPO Framework] Not included Slider.");
	}
}
*/