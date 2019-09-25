
<script>
function login() {
	$.ajax({
			url: "/ajax_process/location_process",
			type: "POST",
			dataType: "JSON",
			data : {
				token: "5d52aa5a9786d",
			},
			success: function(data){
				var obj = data;
				console.log(obj);
				alert("Console 창을 확인하세요.");
			},
			error:function(xhr, status, errorThrown) {
				// 오류 발생시
				console.log("로그인 실패 : " + errorThrown+" / "+status+" / "+xhr.statusText);
				alert("로그인에 실패 했습니다. 다시 시도해주세요.");
			}
	});
}
</script>

	<p>AJAX 테스트</p>
	<input type="button" value="View Result" onclick="javascript:login()">