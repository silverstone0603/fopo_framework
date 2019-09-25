<?php 
$today = date("Ymd");
    $week_w = array('일','월','화','수','목','금','토');
 

	$weather = file_get_contents("http://newsky2.kma.go.kr/service/MiddleFrcstInfoService/getMiddleTemperature?ServiceKey=LnYa9yROAm1TnIL4eGzY2xtlfJIJ%2FojJMBjU91%2BrTlvYc2YinPx1E9RCA%2Fv6zyWC7dNXkEQBwx4%2B5ts18w48bA%3D%3D&regId=11H10701&tmFc=".$today."0600");
	$result_xml = simplexml_load_string($weather);

	$weather2 = file_get_contents("http://newsky2.kma.go.kr/service/MiddleFrcstInfoService/getMiddleLandWeather?ServiceKey=LnYa9yROAm1TnIL4eGzY2xtlfJIJ%2FojJMBjU91%2BrTlvYc2YinPx1E9RCA%2Fv6zyWC7dNXkEQBwx4%2B5ts18w48bA%3D%3D&regId=11H10000&tmFc=".$today."0600");
	$result_xml2 = simplexml_load_string($weather2);

?>

	<?php 
		for($i = 3; $i < 10; $i++){
		$day = date("w")+$i;
		if($day >= 7) 
			$day = $day-7;
		echo $week_w[$day]." : ";
		$str1="taMin".$i;
		echo $result_xml->body->items->item->$str1; ?>&nbsp;
	<?php
		$str2="taMax".$i;
		echo $result_xml->body->items->item->$str2; ?>&nbsp;
	<?php
		if($i<=7) $str3= "wf".$i."Am";
		else $str3="wf".$i;
		echo $result_xml2->body->items->item->$str3; ?>&nbsp;
	<?php
		if($i<=7) $str4="rnSt".$i."Am";
		else $str4="rnSt".$i;
		echo $result_xml2->body->items->item->$str4;

		//$sql = $this->FOPO_DB->query("INSERT INTO `weather`(`wea_idx`,`wea_day`, `wea_min`, `wea_max`, `wea_status`, `wea_rain`) VALUES (\"".$i."\",\"".$week_w[$day]."\",\"".$result_xml->body->items->item->$str1."\",\"".$result_xml->body->items->item->$str2."\",\"".$result_xml2->body->items->item->$str3."\",\"".$result_xml2->body->items->item->$str4."\")");
		
		$sql = $this->FOPO_DB->query("UPDATE `weather` SET `wea_day`=\"".$week_w[$day]."\",`wea_min`=\"".$result_xml->body->items->item->$str1."\",`wea_max`=\"".$result_xml->body->items->item->$str2."\",`wea_status`=\"".$result_xml2->body->items->item->$str3."\",`wea_rain`=\"".$result_xml2->body->items->item->$str4."\" WHERE wea_idx = ".$i."");

		?><br>

		<?php }?>
		