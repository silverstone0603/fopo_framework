/*
	Default Script File
	designed by FOPO.

	(C) FOPO Team, All rights reserved.
*/

function getFriendList(mem_no) {

    $.post("/ajax_process/friend_process",
    {
      type: "F_list",
      mem_no: mem_no,
    },
    function(data,status){
		fopo_list = JSON.parse(data);
		$(fopo_list.fri_list).each(
			function(idx,list){
				var str='';
				if (list.art_cnt == null)
				{
					list.art_cnt = "0";
				}
				str +="<tr><td>"+list.mem_nick+"</td>";
				str +="<td>"+list.art_cnt+"</td></tr>";
				$(".frined_list").append(str);
			}
		);
    });
}