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
	$(window).on('load',function(){
		if ($("#loader").length){
			$(".lds-ripple div").delay(0).fadeOut();
			$(".lds-ripple").delay(0).fadeOut();
			$("#loader").delay(150).fadeOut("slow");
			
			console.log("[FOPO Framework] Page loaded.");
		}else{
			console.log("[FOPO Framework] Page loaded. (Not include Loader Layer)");
		}
	});
})(jQuery);