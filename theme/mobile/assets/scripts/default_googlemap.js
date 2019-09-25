function initMap() {
	if ($("#map_google").length){
		/*맵에 지도를 띄우고 처음 zoom의 상태 및 중앙위치 잡아주기.*/
		var map = new google.maps.Map(document.getElementById('map_google'), {
		  zoom: 7,
		  center: {lat: 35.8965653, lng: 128.6197873},
		  mapTypeControl: false,
		  streetViewControl: false,
		  fullscreenControl: false,
		});
		/* 여기까지 맵 띄우기 */	  
		var locations = new Array();

		var markeroption = new Object();

		/* AJAX 처리부분 */	

		$.post("/ajax_process/board_process",
		{
		  type: "zone",
		},
		function(data,status){
			fopo_zone = JSON.parse(data);
			$(fopo_zone.photozone).each(
			  function(idx, marker){
				var markeroption = new Object();

				markeroption.lat = parseFloat(marker.zone_lat);
				markeroption.lng = parseFloat(marker.zone_lng);
				markeroption.info = marker.zone_placename;
				markeroption.url = "fopozone?list="+marker.zone_no;

				locations.push(markeroption);
			
			  }
			);
			photozone_marker(locations);
		});
		/* AJAX 처리 끝 */
		
		 
		/* 핀 찍기 부분 */
		/* 함수로 안만드니까 오류나서 위에서 ajax처리 후에 불러오도록 만듬 */
		function photozone_marker(locations){ 
		/* 마커 아이콘 커스터마이징 */
		var icon = {
			url: "theme/default/assets/images/svg/fopo_icon_12.svg", // url
			scaledSize: new google.maps.Size(30, 30), // 크기
			origin: new google.maps.Point(0, 0), // origin
			anchor: new google.maps.Point(15, 30) // anchor
		};
		
		var infoWin = new google.maps.InfoWindow();

		var markers = locations.map(function(locations){
		marker = new google.maps.Marker({
		position : locations,
		icon : icon
		});

		  google.maps.event.addListener(marker, 'click', function(evt) {
			infoWin.setContent(locations.info);
			infoWin.open(map, marker);
			window.location.href=locations.url;
		  });

		  google.maps.event.addListener(marker, 'mouseover', function(evt) {
			infoWin.setContent(locations.info);
			infoWin.open(map, this);
		  });

		  google.maps.event.addListener(marker, 'mouseout', function(evt) {
			infoWin.close();
		  });
		  return marker;
		});
		/* 여기까지 인포윈도우 및 마커 찍기 */

		/* 클러스터링 마커 추가부분 */
		new MarkerClusterer(map, markers,
			{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	}
	/* 클러스터링 마커 추가 끝 */
}
}