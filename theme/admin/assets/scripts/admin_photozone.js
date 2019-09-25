var count =0;
function getPhotozoneList() {
	$.post("/ajax_process/admin_process",
    {
      type: "photozone_lists",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.pho_list).each(
				function(idx, pho_list){
				count ++;
				var str = '';
				str += "<tr>";
				str += "<td>" + pho_list.zone_no + "</td>";
				str += "<td><a class=\"alink\" href=\"/photozone_info?no="+pho_list.zone_no+"\">" + pho_list.zone_placename+ "</td>";
				str += "<td>" + pho_list.zone_x +"</td>";
				str += "<td>" + pho_list.zone_y +"</td>";
				str += "<td><a class=\"alink\" href=\"/member_info?no="+pho_list.mem_no+"\">" + pho_list.mem_nick + "</td>";
				str += "<td>" + pho_list.zone_regdate + "</td>";
				str += "<td>" + pho_list.count + "</td>";
				str += "</tr>";
				$(".cnt").html("[총 <b>"+count+"개</b>의 <b>포토존</b>이 검색 됨]");
				$(".content_list").append(str);
				}
			);
    });
}

function getPhotozoneInfo(zone_no){
	$.post("/ajax_process/admin_process",
    {
      type: "photozone_info",
	  zone_no: zone_no,
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.pho_info).each(
				function(idx,pho_info){
				var str2 = "<b>"+pho_info.zone_placename+"</b>의 <b>포토존 정보</b>입니다.";
				var str = "";
				getMap(pho_info.zone_x,pho_info.zone_y,pho_info.zone_placename);
				str += "<tr>";
				str += "<th>포토존 번호</th>";
				str += "<td>"+pho_info.zone_no+"</td>"
				str += "</tr><tr>";
				str += "<th>포토존 명</th>";
				str += "<td><input type=\"textbox\" value =\""+pho_info.zone_placename+"\" id =\"name\"></td>";
				str += "</tr><tr>";
				str += "<th>주소</th>";
				str += "<td>두류동 야외음악당로 180</td>";
				str += "</tr><tr>";
				str += "<th>위도</th>";
				str += "<td><input type=\"textbox\" value =\""+pho_info.zone_x+"\" id =\"lat\"></td>"
				str += "</tr><tr>";
				str += "<th>경도</th>";
				str += "<td><input type=\"textbox\" value =\""+pho_info.zone_y+"\" id =\"lng\"></td>";
				str += "</tr><tr>";
				str += "<th>생성일자</th>";
				str += "<td>"+pho_info.zone_regdate+"</td>";
				str += "</tr><tr>";
				str += "<th>최초 생성자</th>";
				str += "<td><a class=\"alink\" href=\"/member_info?no="+pho_info.mem_no+"\">" + pho_info.mem_nick + "</td>";
				str += "</tr><tr>";
				str += "<th>개수</th>";
				str += "<td>" + pho_info.count + "개</td>";
				str += "</tr>";
				$(".zoneinfo_ta").append(str);
				$("#title").html(str2);

				}
			);
    });
}


function getPhotozoneList_art(zone_no) {
	$.post("/ajax_process/admin_process",
    {
      type: "photozone_info_article",
	  zone_no: zone_no,
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.pho_list).each(
				function(idx,pho_list){
				var str = '';
				str += "<tr>";
				str += "<td><a class=\"alink\" href=\"/information?no="+pho_list.brd_no+"\">"+pho_list.brd_no+"</td>";
				str += "<td><a class=\"alink\" href=\"/member_info?no="+pho_list.mem_no+"\">"+pho_list.mem_nick+"</td>";
				str += "<td>"+pho_list.brd_date+"</td>";
				str += "<td>192.168.11.5</td>";
				str += "<td>"+pho_list.file_savename+"</td></tr>";
				$(".photozone_info_art").append(str);
				}
			);
    });
}

function getMemberList() {
	$.post("/ajax_process/admin_process",
    {
      type: "member_lists",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.mem_list).each(
				function(idx,mem_list){
				var str = '';
				str += "<tr><td>"+ mem_list.mem_no +"</td>";
				str += "<td><a class =\"alink\" href=\"/member_info?no="+ mem_list.mem_no +"\">"+ mem_list.mem_id +"</a></td>";
				str += "<td>"+ mem_list.mem_nick +"</td>";
				str += "<td>"+ mem_list.mem_level +"</td>";
				str += "<td>"+mem_list.mem_gender+"</td>";
				str += "<td>"+mem_list.mem_phone+"</td>";
				str += "<td>"+mem_list.mem_email+"</td>";
				str += "<td>"+mem_list.mem_regdate+"</td>";
				str += "<td>"+mem_list.mem_lastlogin+"</td></tr>";
				$(".list").append(str);
				}
			);
    });
}

function getMemberInfo(member_no) {
	$.post("/ajax_process/admin_process",
    {
      type: "member_info",
	  member_no: member_no,
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.mem_info).each(
				function(idx,mem){
				var str = '';
				var nick = "<b>"+mem.mem_nick+"</b>님의 <b>회원 정보</b>";
				str += "<tr><th>회원번호</th><td id = \"no\">"+mem.mem_no+"</td></tr><tr>";
				str += "<th>아이디</th><td><input type=\"text\" value=\""+mem.mem_id+"\" id = \"id\"></td></tr><tr>"
				str += "<th>닉네임</th><td><input type=\"text\" value=\""+mem.mem_nick+"\" id = \"nick\"></td></tr><tr>";
				str += "<th>전화번호</th><td><input type=\"text\" value=\""+mem.mem_phone+"\" id = \"phone\"></td></tr><tr>";
				str += "<th>이메일</th><td><input type=\"text\" value=\""+mem.mem_email+"\" id = \"email\"></td></tr><tr>";
				str += "<th>비밀번호</th><td><input type =\"password\" id=\"pw\"></td></tr><tr>";
				str += "<th>권한</th><td>"+((mem.mem_level == "admin") ? "Admin":"User")+"</td></tr><tr>";
				str += "<th>성별</th><td>"+((mem.mem_gender == "1") ? "남자":"여자")+"</td></tr><tr>";
				str += "<th>가입 날짜</th><td>"+mem.mem_regdate+"</td></tr><tr>";
				str += "<th>최종접속일시</th><td>"+mem.mem_lastlogin+"</td></tr><tr>";
				str += "<td colspan=\"2\"><input class=\"f_r\" type =\"submit\" onclick=\"Info_Edit()\" value=\"저장\"></td></tr>";
				$(".myinfo_ta").append(str);
				$(".nickName").html(nick);
				}
			);
    });
}

function getgooglemapList(value) {
	$.post(value,
    {
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.pho_list).each(
				function(idx, pho_list){
				var str = '';
				str += "<tr>";
				str += "<td>" + pho_list.zone_no + "</td>";
				str += "<td><a class=\"alink\" href=\"/photozone_info?no="+pho_list.zone_no+"\">" + pho_list.zone_placename+ "</td>";
				str += "<td>" + pho_list.zone_x +"</td>";
				str += "<td>" + pho_list.zone_y +"</td>";
				str += "<td><a class=\"alink\" href=\"/member_info?no="+pho_list.mem_no+"\">" + pho_list.mem_nick + "</td>";
				str += "<td>" + pho_list.zone_regdate + "</td>";
				str += "<td>" + pho_list.count + "</td>";
				str += "</tr>";
				$(".content_list").append(str);
				}
			);
    });
}

function getMap(lat,lng,title) {
	if ($("#google_map").length){
		/*맵에 지도를 띄우고 처음 zoom의 상태 및 중앙위치 잡아주기.*/
		var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
		var map = new google.maps.Map(document.getElementById('google_map'), {
		  zoom: 14,
		  center: myLatLng,
		  mapTypeControl: false,
		  streetViewControl: false,
		  fullscreenControl: false,
		});
		/* 여기까지 맵 띄우기 */
		var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: 'PhotoZone',
		label: 'P'
	  });
	  marker.addListener('click', function() {
		infowindow.open(map, marker);
	  });
	  var infowindow = new google.maps.InfoWindow({
		content: title
	  });

}
}

/* 2019.06.08 18:00 DB에 있는 포토존 긁어오기 성공 */


function setMemberInfo(id,nick,phone,email,pw,no){
	$.post("/ajax_process/admin_process",
    {
      type: "member_info_edit",
	  id: id,
	  nick: nick,
	  phone: phone,
	  email: email,
	  pw: pw,
	  no: no,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("sql오류");
			window.location="login";
		}else{
			alert("수정 완료");
			window.location.reload();
		}
    });
}

function setPhotozoneInfo(no,name,lat,lng){
	$.post("/ajax_process/admin_process",
    {
      type: "phozone_info_edit",
	  no: no,
	  name: name,
	  lat: lat,
	  lng: lng,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){

			alert("sql오류");
			window.location="login";
		}else{
			alert("수정 완료");
			window.location.reload();
		}
    });
}

function getArticleInfo(brd_no){
	$.post("/ajax_process/admin_process",
    {
      type: "article_info",
	  brd_no: brd_no,
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.article_info).each(
				function(idx,art){
				var str = '';
				str += "<tr><th>회원번호</th><td>"+art.mem_no+"</td></tr>";
				str += "<tr><th>아이디</th><td>"+art.mem_id+"</td></tr>";
				str += "<tr><th>포토존 번호</th><td>"+art.zone_no+"</td></tr>";
				str += "<tr><th>포토존 명</th><td>"+art.zone_placename+"</td></tr>";
				str += "<tr><th>좋아요</th><td>"+art.brd_like+"</td></tr>";
				str += "<tr><th>조회수</th><td>"+art.brd_view+"</td></tr>";
				str += "<tr><th>작성 날짜</th><td>"+art.brd_date+"</td></tr>";
				str += "<tr><th>한줄평</th><td>"+art.brd_content+"</td></tr>";
				str += "<tr><th>이미지</th><td>"+art.file_savename+"</td></tr>";
				$(".info_ta").append(str);
				}
			);
    });
}

function admgetBoardReply(brd_no) {

    $.post("/ajax_process/admin_process",
    {
      type: "reply_lists",
      brd_no: brd_no,
    },
    function(data,status){
		fopo_view = JSON.parse(data);
		$(fopo_view.reply_lists).each(
			function(idx,lists){
				if(lists.rre_no == null){
					var str='';
					str +="<tr><td>"+lists.mem_nick+"</td>";
					str +="<td>"+lists.re_comment+"</td>";
					str +="<td>"+lists.re_date+"</td>";
					str +="<td><input type=\"submit\" onclick=\"admsetBoardReplyDeleted("+lists.re_no+")\"value=\"삭제\"></td></tr>";
					$(".reply_data").append(str);
				}else{

				}
			}
		);
    });
}

function getMemberLog(member_no){

	$.post("/ajax_process/admin_process",
	{
		type: "member_log",
		member_no: member_no,
	},
	function(data,log){
		fopo_list = JSON.parse(data);
		$(fopo_list.mem_log).each(
				function(idx,log){
				var str = '';
				str +="<tr><td>"+log.date+"</td>";
				str +="<td>"+log.os+"</td>";
				str +="<td>"+log.browse+"</td>";
				str +="<td>"+log.ip+"</td></tr>";
				$(".loginlog_ta").append(str);
				}
			);
			
	});
}

function admsetBoardReplyDeleted(re_no) {
    $.post("/ajax_process/admin_process",
    {
      type: "reply_deleted",
      re_no: re_no,
    },
    function(data,status){
		alert("댓글을 삭제 하였습니다.");
		window.location.reload();
    });
}

function getQnalist(){
	$.post("/ajax_process/admin_process",
    {
      type: "getQnalist",
    },
    function(data,qna){
		fopo_list = JSON.parse(data);
		$(fopo_list.qa_list).each(
				function(idx,qa){
				var str = '';
				str +="<tr><td>"+qa.idx+"</td>";
				str +="<td><a href=\"qna?no="+qa.idx+"\">"+qa.title+"</a></td>";
				str +="<td>"+qa.content+"</td>";
				str +="<td>"+qa.date+"</td>";
				str +="<td>"+qa.edate+"</td>";
				str +="<td><a href=\"qna?no="+qa.idx+"\">수정</a></td></tr>";
				$(".help_ta").append(str);
				}
			);
			
	});
}

function getSesslist(){
	$.post("/ajax_process/admin_process",
    {
      type: "getSesslist",
    },
    function(data,qna){
		fopo_list = JSON.parse(data);
		$(fopo_list.sess_list).each(
				function(idx,sess){
				var str = '';
				var str2 = '';
				switch(sess.type)
				{
				case '0':
					str2 = "<b class=\"red\">어플</b>";
				break;

				case '1':
					str2 = "<b class=\"red\">웹</b>";
				break;
				}
				str +="<tr><td><a class =\"alink\" href=\"/member_info?no="+sess.no+"\">"+sess.nick+"</td>";
				str +="<td>"+sess.token+"</td>";
				str +="<td>"+sess.verify+"</td>";
				str +="<td>"+str2+"</td>";
				str +="<td>"+sess.ip+"</td>";
				str +="<td>"+sess.is+"</td>";
				str +="<td>"+sess.orgdate+"</td>";
				str +="<td>"+sess.lastdate+"</td>";
				str +="<td><input type = \"button\" value=\"삭제\" onclick=\"admsetSessionDeleted("+sess.sess_no+")\"></td></tr>";
				$(".loginlog_ta").append(str);
				}
			);
			
	});
}

function getQuelist(){
	$.post("/ajax_process/admin_process",
    {
      type: "getQuelist",
    },
    function(data,qna){
		fopo_list = JSON.parse(data);
		$(fopo_list.qu_list).each(
				function(idx,qu){
				var str = '';
				var str2 = '';
				switch (qu.status)
				{
				case '1':
					str2 = "<b class=\"red\">답변 전</b>";
					break;
				case '2':
					str2 = "답변 완료";
					break;
				}
				console.log(str2);
				str +="<tr><td>"+qu.idx+"</td>";
				str +="<td><a href=\"member_info?no="+qu.no+"\">"+qu.nick+"</a></td>";
				str +="<td>"+qu.category+"</td>";
				str +="<td>"+qu.content+"</td>";
				str +="<td>"+str2+"</td>";
				str +="<td>"+qu.date+"</td></tr>";
				$(".qna_ta").append(str);
				}
			);
			
	});
}

function getMemberQuelist(mem_no){
	$.post("/ajax_process/admin_process",
    {
      type: "getQuelist",
	  mem_no: mem_no,
    },
    function(data,qna){
		fopo_list = JSON.parse(data);
		$(fopo_list.qu_list).each(
				function(idx,qu){
				var str = '';
				var str2 = '';
				switch (qu.status)
				{
				case '1':
					str2 = "<b class=\"red\">답변 전</b>";
					break;
				case '2':
					str2 = "답변 완료";
					break;
				}
				console.log(str2);
				str +="<tr><td>"+qu.idx+"</td>";
				str +="<td><a href=\"member_info?no="+qu.no+"\">"+qu.nick+"</a></td>";
				str +="<td>"+qu.category+"</td>";
				str +="<td>"+qu.content+"</td>";
				str +="<td>"+str2+"</td>";
				str +="<td>"+qu.date+"</td></tr>";
				$(".qna_ta").append(str);
				}
			);
			
	});
}

function getEventlist(){
	$.post("/ajax_process/admin_process",
    {
      type: "getEventlist",
    },
    function(data,qna){
		fopo_list = JSON.parse(data);
		console.log(fopo_list);
		$(fopo_list.eve_list).each(
				function(idx,event){
				var str = '';
				var str2 = '';
				var str3 = '';
				switch (event.division)
				{
				case '1':
					str2 = "공지";
					break;
				case '0':
					str2 = "이벤트";
					break;
				}
				switch (event.posting)
				{
				case '1':
					str3 = "게시";
					break;
				case '0':
					str3 = "미게시";
					break;
				}
				str+= "<tr><td><a href=\"notice?no="+event.eve_no+"\">"+event.eve_no+"</td>";
				str+= "<td>"+event.nick+"</td>";
				str+= "<td>"+event.title+"</td>";
				str+= "<td>"+event.content+"</td>";
				str+= "<td>"+event.term+"</td>";
				str+= "<td>"+event.wridate+"</td>";
				str+= "<td>"+str2+"</td>";
				str+= "<td>"+str3+"</td>";
				str+= "<td><a href=\"notice?no="+event.eve_no+"\">수정</a></td></tr>";
				$(".event_ta").append(str);
				}
			);
			
	});
}

function admsetSessionDeleted(no) {
    $.post("/ajax_process/admin_process",
    {
      type: "session_deleted",
      no: no,
    },
    function(data,status){
		alert("세션을 삭제 하였습니다.");
		window.location.reload();
    });
}

function setEventWrite(mem_no,title,content,file,term,division,posting){
	$.post("/ajax_process/admin_process",
    {
      type: "Event_Write",
	  mem_no : mem_no,
	  title: title,
	  content: content,
	  file: file,
	  term: term,
	  division: division,
	  posting: posting,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("sql오류");
			window.location.reload();
		}else{
			alert("작성 완료");
			window.location="contents";
		}
    });
}

function setEventEdit(no,mem_no,title,content,file,term,division,posting){
	$.post("/ajax_process/admin_process",
    {
      type: "Event_Edit",
	  no : no,
	  mem_no : mem_no,
	  title: title,
	  content: content,
	  file: file,
	  term: term,
	  division: division,
	  posting: posting,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("sql오류");
			history.back();
		}else{
			alert("수정 완료");
			window.location.reload();
		}
    });
}

function getEventInfo(no) {
	$.post("/ajax_process/admin_process",
    {
      type: "getEventInfo",
	  no : no, 
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			console.log(fopo_list);
			$(fopo_list.eve_info).each(
				function(idx,eve){
				$("#title").html("<b>"+eve.eve_no+"번 공지</b>의 <b>정보 입니다.</b>");
				$("#eve_title").val(eve.eve_title);
				$("#content").val(eve.eve_content);
				$("#filename_l").val(eve.eve_file);
				$("#filename").append(eve.eve_file);
				$("#term").val(eve.eve_term);
				$("#division").val(eve.eve_division);
				$("#posting").val(eve.eve_posting);
				}
			);
    });
}

function setQnaWrite(title,content){
	$.post("/ajax_process/admin_process",
    {
      type: "Qna_Write",
	  title: title,
	  content: content,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("sql오류");
			window.location.reload();
		}else{
			alert("작성 완료");
			window.location="contents";
		}
    });
}

function setQnaEdit(no,title,content){
	$.post("/ajax_process/admin_process",
    {
      type: "Qna_Edit",
	  no : no,
	  title: title,
	  content: content,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("sql오류");
			history.back();
		}else{
			alert("수정 완료");
			window.location.reload();
		}
    });
}

function getQnaInfo(no) {
	$.post("/ajax_process/admin_process",
    {
      type: "getQnaInfo",
	  no : no,
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			console.log(fopo_list);
			$(fopo_list.qa_info).each(
				function(idx,qa){
				$("#title").html("<b>"+qa.qa_idx+"번 컨텐츠</b>의 <b>정보 입니다.</b>");
				$("#qna_title").val(qa.qa_title);
				$("#content").val(qa.qa_content);
				}
			);
    });
}

function Qna_Deleted(no){
	$.post("/ajax_process/admin_process",
    {
      type: "Qna_Deleted",
	  no : no,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("sql오류");
			history.back();
		}else{
			alert("삭제 완료");
			window.location="contents";
		}
    });
}

function Event_Deleted(no){
	$.post("/ajax_process/admin_process",
    {
      type: "Event_Deleted",
	  no : no,
    },
    function(data,status){
		var tmpData = JSON.parse(data);
		if (tmpData.status == "failed"){
			alert("sql오류");
			history.back();
		}else{
			alert("삭제 완료");
			window.location="contents";
		}
    });
}