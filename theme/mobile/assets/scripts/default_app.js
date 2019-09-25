function getEventList() {
	$.post("/process/app_process",
    {
      type: "event",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.eve_list).each(
				function(idx, eve){
					console.log("test");
					var str='';
					str += "<tr><td>"+eve.title+"</td></tr>";
					$(".notice_list").append(str);
				}
			);
    });
}

function getHelpList() {
	$.post("/process/app_process",
    {
      type: "help",
    },
    function(data,status){
			fopo_list = JSON.parse(data);
			$(fopo_list.help_list).each(
				function(idx, help){
					console.log("test");
					var str='';
					str += "<li><a href=\"#\">"+help.title+"</a></li>";
					$(".help_list").append(str);
				}
			);
    });
}