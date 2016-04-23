<?php 
$arrayName = array(
	'username' => $_POST['username'], 
	'password' => $_POST['password'], 
	'firstname' => $_POST['firstname']
	);
$url = 'http://localhost:3000/users';
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($arrayName)
		)
	);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'error'));

}else{
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'El usuario se creo exitosamente'));
}