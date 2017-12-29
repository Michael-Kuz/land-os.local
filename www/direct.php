<?php
require_once "start.php";

    /* функция отправляет запрос  на API Yandex и возвращает ответ от API yandex */
	function sendRequest($params, $obj, $method) {
		$request = array(
			"method" => $method,
			"params" => $params
		);
		$request = json_encode($request);
		$opts = array(
			"http" => array(
				"header" => "Content-Type: application/json; charset=utf-8\r\nAuthorization: Bearer ".Config::DIRECT_TOKEN."\r\nAccept-Language: en\r\n",
				"method" => "POST",
				"content" => $request
			)
		);
		$context = stream_context_create($opts);
		$result = json_decode(file_get_contents("https://api-sandbox.direct.yandex.com/json/v5/$obj", false, $context));
		return $result;
	}
	
	$sc = new stdClass(); //для получения всех компаний нужно указать пустой sc (SelectionCriteria)
	$params = array(
		"SelectionCriteria" => $sc,
		"FieldNames" => array("Id", "Name", "StartDate", "EndDate", "Type", "Status", "State")
	);
	$banners = sendRequest($params, "campaigns", "get");

	$banners = $banners->result->Campaigns;
	for( $i=0; $i<count($banners); $i++ ){
		print_r($banners[$i]);
		echo "<br>";
	}
	//print_r($banners);
?>