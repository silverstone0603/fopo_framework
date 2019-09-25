<script src="http://maps.google.com/maps/api/js?key=AIzaSyAqsE4-yK8S3jZkMsWjrvZeQcZeZX4UM1A&callback=initMap"></script>

<?php 
$no = $_GET["no"];?>
			<script>
			getPhotozoneInfo(<?php echo $no; ?>);
			getPhotozoneList_art(<?php echo $no; ?>);
			function Info_Edit(){
				var name = document.getElementById("name").value;
				var lat = document.getElementById("lat").value;
				var lng = document.getElementById("lng").value;
				setPhotozoneInfo(<?php echo $no; ?>,name,lat,lng);
			}
			</script>
			<div class="contents_wrap">
				<div class="contents_area">
					<div class="contents">

						<h3 id="title"><b>포토존</b>의 <b>정보가 없습니다.</b></h3>
						
							<div id="google_map" class="google_map" >
							</div>
								<div class = "abc"><br>
								<table class="zoneinfo_ta">
								</table>
								<input type ="submit" style="margin-left: 350px;margin-top: 10px;"onclick="Info_Edit()" value="저장">
								</div>

						<br><br>
						<h3><b>게시글 목록</b></h3>
							<div class="content">
							<thead>
								<table class="photozone_info_ta">
									<tr>
										<th>게시글 번호</th>
										<th>작성자</th>
										<th>작성날짜</th>
										<th>작성 IP</th>
										<th>이미지 경로</th>
									</tr>
							</thead>
							<tbody class="photozone_info_art">
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>