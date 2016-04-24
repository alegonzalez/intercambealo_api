<?php
$arrayName = array(
	'token' => $_POST['token'], 
	'id' => $_POST['username']

	);

$url = 'http://localhost:3000/session/logout';
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => "GET",
		'content' => http_build_query($arrayName),
		'ignore_errors' => true
		
		)
	);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
header('Content-Type: application/json');
$value = json_decode($response);
echo json_encode( $response);