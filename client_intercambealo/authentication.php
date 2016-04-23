<?php
$arrayName = array(
	'username' => $_POST['username'], 
	'password' => $_POST['password']
	);
//$jsonData = json_encode(array('user' => $arrayName));
$jsonData = array('user' => $arrayName);
//$jsonData = json_encode($arrayName);
//$data = "{'user': $jsonData }";
$url = 'http://localhost:3000/session/authenticate';
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($jsonData)
		)
	);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => "error"));

}else{
	header('Content-Type: application/json');
	echo json_encode(array('message' => $response));
}