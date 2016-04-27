<?php 
$arrayName = array(
	'username' => $_POST['username'], 
	'password' => $_POST['password'], 
	'firstname' => $_POST['firstname'],
	'token' => $_POST['Token'],
	'id' => $_POST['id']
	);
$token = array('token' => $_POST['Token']);
$url = 'http://localhost:3000/users';
$options = array(
	'http' => array(
		'header'  => "Content-type:application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($arrayName),
		'ignore_errors' => true,
	//application/x-www-form-urlencoded\r\n
		)
	);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$header = $http_response_header;
echo $header[4];
var_dump($response);
die;
header('Content-Type: application/json');
$value = json_decode($response);
echo json_encode(array($value));