/*
	Default Script File
	designed by FOPO.

	(C) FOPO Team, All rights reserved.
*/

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}

function getLog() {
	console.log("TEST");
}

function getBoardLists(zone_no) {
	$.post("/ajax_process/board_process",
    {
      type: "lists",
      zone_no: zone_no,
    },
    function(data,status){
		fopo_list = JSON.parse(data);
		$(fopo_list.brd_lists).each(
		  function(idx, brd){
			if (idx==0)
			{
				//var str='';
				//str += "<h1 class=\"title_l\">포토존 명 : "+brd.zone_placename+"</h1>";
				//$(".main_1").prepend(str);
				$(".title").html("<span>포토존 명 : " + brd.zone_placename+"</span>");
			}
			/*
			var str ='';
			str += "<a href=\"view?list="+brd.brd_no+"\">";
			str += "<img class=\"Thumbnail\" src=\"cdn_process/photo?no="+brd.brd_no+"\"></a>";
			*/
			var str ='';
			str += "<div class=\"Thumbnail\" style=\"background-position: center; background-size: cover; background-image:url('cdn_process/photo?no="+brd.brd_no+"'); width: 22.5%; height: 300px;\">";
			//str += "<img src=\"cdn_process/photo?no="+brd.brd_no+"\">";
			str += "<div>";
			str += "<span class=\"fp-img-heart btnHeart\">"+brd.brd_like+"</span>";
			str += "<p>작성자 : "+brd.nick+"</p>";
			str += "</div>";
			str += "<a href=\"view?list="+brd.brd_no+"\">";
			str += "</div>";
			$(".Thum").append(str);
		  }
		);
    });
}

function getBoardView(brd_no) {
	var brd_no = $.urlParam('list');

    $.post("/ajax_process/board_process",
    {
      type: "view",
      brd_no: brd_no,
    },
    function(data,status){
		fopo_view = JSON.parse(data);
		$(fopo_view.brd_view).each(
			function(idx,view){
				var str='';
				str +="<input type=\"hidden\" id=\"zone_no\" value=\""+view.zone_no+"\">";
				str +="<div style=\"text-align: center;\">";
				str +="<img src=\"cdn_process/photo?no="+view.brd_no+"\" class=\"view_img\" >";
				str +="</div>";
				str +="<span class=\"written\">";
				str +="<span class=\"fp-img-heart btnHeart\" onclick=\"setHeartUp("+view.brd_no+");\">"+view.brd_like+"</span>";
				str +="<span class=\"f_r\">작성자 : "+view.mem_nick+"</span>";
				str +="</span>";
				str +="<span class=\"oneline\">";
				str +="<h2>"+view.brd_content+"</h2>";
				str +="</span>";
				$(".view").append(str);
			}
		);
    });
}

function getBoardReply(brd_no) {
	var brd_no = $.urlParam('list');
	
    $.post("/ajax_process/reply_process",
    {
      type: "lists",
      brd_no: brd_no,
    },
    function(data,status){
		fopo_view = JSON.parse(data);
		$(fopo_view.reply_lists).each(
			function(idx,lists){
				if(lists.rre_no == null){
					var str ='';
					str +="<div class=\"reply\">";
					str +="<span><b>"+lists.mem_nick+"</b> "+lists.re_date+"</span>";
					str +="<p>"; 
					str +="<span>"+lists.re_comment+"</span>";
					if(fopo_view.usr_status=="user"){
					str +="<span class=\"f_r\"><input type=\"button\" class=\"reply_delbtn\" value=\"삭제\" onclick=\"setBoardReplyDeleted("+lists.re_no+")\"></span>";
					}
					//str +="<span class=\"f_r\" onclick=\"alert('구현 중')\"><a href=\"#\">삭제</a></span>";
					str +="</p>";
					str +="</div>";
					$(".main_content").append(str);
					console.log("댓글");
					getBoardRe_Reply(lists.brd_no,lists.re_no);
				}else{

				}
			}
		);
    });
}

function getBoardRe_Reply(brd_no,re_no) {
	var brd_no = $.urlParam('list');
    $.post("/ajax_process/reply_process",
    {
      type: "lists",
      brd_no: brd_no,
    },
    function(data,status){
		fopo_view = JSON.parse(data);
		$(fopo_view.reply_lists).each(
			function(idx,lists){
				if(lists.rre_no == re_no && lists.rre_no != null){
					var str ='';
					str +="<div class=\"reply_r\">";
					str +="<span>"+lists.mem_nick+"</span>";
					str +="<span class=\"f_r\">"+lists.re_date+"</span>";	
					str +="<p>"; 
					str +="<span>"+lists.re_comment+"</span>";
					str +="<span class=\"f_r\"><a href=\"#\" onclick = \"setBoardReplyDeleted("+lists.re_no+")\">삭제</a></span>";
					//str +="<span class=\"f_r\" onclick=\"alert('구현 중')\"><a href=\"#\">삭제</a></span>";
					str +="</p>";
					str +="</div>";
					console.log("대댓글");
					$(".main_content").append(str);
				}else{

				}
			}
		);
    });
}

function setBoardReplyDeleted(re_no) {
    $.post("/ajax_process/reply_process",
    {
      type: "deleted",
      re_no: re_no,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("로그인을 먼저 해주세요.");
			window.location="login";
		}else{
			console.log("dd");
			alert("댓글을 삭제 하였습니다.");
			window.location.reload();
		}
    });
}

function setBoardReplyWrite(zone_no,brd_no,mem_no,rre_no,re_comment) {
    $.post("/ajax_process/reply_process",
    {
      type: "write",
      zone_no: zone_no,
      brd_no: brd_no,
      mem_no: mem_no,
      rre_no: rre_no,
      re_comment: re_comment,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("로그인을 먼저 해주세요.");
			window.location="login";
		}else{
			alert("댓글을 작성 하였습니다.");
			window.location.reload();
		}
    });
}

function getImage(file_no) {
	//var test;
	var imgHidden = new Image();

    $.post("/ajax_process/photo_process",
    {
      type: "load",
      file_no: file_no,
    },
    function(data,status){
		imgHidden = data;
    });

	console.log(imgHidden);
	readURL(imgHidden);

	//return imgHidden;
}

function readURL(input) {
	if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function (e) {
		$('.view_img').attr('src', e.target.result);
	}

	  reader.readAsDataURL(input.files[0]);
	}
}

function setHeartUp(brd_no){
	$.post("/ajax_process/board_process",
    {
      type: "like",
      brd_no: brd_no,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("로그인을 먼저 해주세요.");
			window.location="login";
		}else{
			$(tmpData.brd_like).each(
			function(idx,heart){
				$('.btnHeart').html(heart.brd_like);
			}
		);
			//window.location.reload();
		}
    });
}

