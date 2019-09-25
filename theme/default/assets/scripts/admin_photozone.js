
function getPhotozoneList() {
	$.post("/ajax_process/list_process",
    {
      type: "photozone_lists",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.pho_list).each(
				function(idx, pho_list){
				var str = '';
				str += "<tr>";
				str += "<td>" + pho_list.zone_no + "</td>";
				str += "<td><a class=\"alink\" href=\"/admin/photozone_info?no="+pho_list.zone_no+"\">" + pho_list.zone_placename+ "</td>";
				str += "<td>" + pho_list.zone_x +"</td>";
				str += "<td>" + pho_list.zone_y +"</td>";
				str += "<td><a class=\"alink\" href=\"/admin/member_info?no="+pho_list.mem_no+"\">" + pho_list.mem_nick + "</td>";
				str += "<td>" + pho_list.zone_regdate + "</td>";
				str += "<td>" + pho_list.count + "</td>";
				str += "</tr>";
				$(".content_list").append(str);
				}
			);
    });
}

function getPhotozoneInfo(zone_no){
	$.post("/ajax_process/list_process",
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
				str += "<tr>";
				str += "<th>포토존 번호</th>";
				str += "<td>" + pho_info.zone_no + "</td>"
				str += "</tr><tr>";
				str += "<th>포토존 명</th>";
				str += "<td>" + pho_info.zone_placename + "</td>";
				str += "</tr><tr>";
				str += "<th>주소</th>";
				str += "<td>두류동 야외음악당로 180</td>";
				str += "</tr><tr>";
				str += "<th>위도</th>";
				str += "<td>" + pho_info.zone_x + "</td>"
				str += "</tr><tr>";
				str += "<th>경도</th>";
				str += "<td>" + pho_info.zone_y +"</td>";
				str += "</tr><tr>";
				str += "<th>생성일자</th>";
				str += "<td>" + pho_info.zone_regdate + "</td>";
				str += "</tr><tr>";
				str += "<th>최초 생성자</th>";
				str += "<td><a class=\"alink\" href=\"/admin/member_info?no="+pho_info.mem_no+"\">" + pho_info.mem_nick + "</td>";
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
function locations(){
}


function getPhotozoneList_art(zone_no) {
	$.post("/ajax_process/list_process",
    {
      type: "photozone_info_article",
	  zone_no: zone_no,
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			console.log(fopo_list);
			$(fopo_list.pho_list).each(
				function(idx,pho_list){
				var str = '';
				str += "<tr>";
				str += "<td><a class=\"alink\" href=\"/admin/information?no="+pho_list.brd_no+"\">"+pho_list.brd_no+"</td>";
				str += "<td><a class=\"alink\" href=\"/admin/member_info?no="+pho_list.mem_no+"\">"+pho_list.mem_nick+"</td>";
				str += "<td>"+pho_list.brd_date+"</td>";
				str += "<td>192.168.11.5</td>";
				str += "<td>"+pho_list.file_savename+"</td></tr>";
				$(".photozone_info_art").append(str);
				}
			);
    });
}

function getMemberList() {
	$.post("/ajax_process/list_process",
    {
      type: "member_lists",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			console.log(fopo_list);
			$(fopo_list.mem_list).each(
				function(idx,mem_list){
				var str = '';
				str += "<tr><td>"+ mem_list.mem_no +"</td>";
				str += "<td><a class =\"alink\" href=\"/admin/member_info?no="+ mem_list.mem_no +"\">"+ mem_list.mem_id +"f</a></td>";
				str += "<td>"+ mem_list.mem_nick +"</td>";
				str += "<td>"+ mem_list.mem_level +"</td>";
				str += "<td>"+mem_list.mem_gender+"</td>";
				str += "<td>"+mem_list.mem_phone+"</td>";
				str += "<td>"+mem_list.mem_email+"</td>";
				str += "<td>"+mem_list.mem_regdate+"</td>";
				str += "<td>"+mem_list.mem_lastlogin+"</td></tr>";
				//console.log(level);
				$(".list").append(str);
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
				str += "<td><a class=\"alink\" href=\"/admin/photozone_info?no="+pho_list.zone_no+"\">" + pho_list.zone_placename+ "</td>";
				str += "<td>" + pho_list.zone_x +"</td>";
				str += "<td>" + pho_list.zone_y +"</td>";
				str += "<td><a class=\"alink\" href=\"/admin/member_info?no="+pho_list.mem_no+"\">" + pho_list.mem_nick + "</td>";
				str += "<td>" + pho_list.zone_regdate + "</td>";
				str += "<td>" + pho_list.count + "</td>";
				str += "</tr>";
				$(".content_list").append(str);
				console.log("Test");
				}
			);
    });
}