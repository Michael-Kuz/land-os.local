<?php
require_once "start.php";

$manage = new Manage(); 
 

$link = false;
$func = "";
$func = $_REQUEST["func"];
//$data = array("send"=>false, "text"=>$_REQUEST["func"]);
//echo json_encode($data);
//exit;
if ( !session_id() ) session_start();
if($func == "landing_order" || $func == "landing_order_bottom" || $func == "landing_order_top"){ // обрабатываем данные из окна формы заказать обратный звонок
	$manage->landing_order();
}elseif($func === "admin_auth"){
	$manage->admin_auth();
}elseif($func === "logout" ){
	$manage->logout();
}

if( $link === false )
	$link = $_SERVER["HTTP_REFERER"];
header("Location: $link");		
exit;
?>