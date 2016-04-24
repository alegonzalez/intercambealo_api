<?php
$arrayName = array(
	'token' => $_POST['Token'], 

	);
$ls = $_POST['Token'];
$url = 'http://localhost:3000/session/logout';
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n" . "*". $ls,
		'method'  => "GET",
		'content' => http_build_query($arrayName),
		'ignore_errors' => true
		
		)
	);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
header('Content-Type: application/json');
$value = json_decode($response);
var_dump($value);
die;
echo json_encode( $response);