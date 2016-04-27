<?php
$arrayName = array(
	'username' => $_POST['username'], 
	'password' => $_POST['password']
	);

$jsonData = array('user' => $arrayName);

$url = 'http://localhost:3000/session/authenticate';
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($jsonData),
		'ignore_errors' => true
		)
	);
$context  = stream_context_create($options);
$response = @file_get_contents($url, false, $context);

header('Content-Type: application/json');
$value = json_decode($response);
echo json_encode( $value);


