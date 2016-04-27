<?php 

$user_id = $_GET['id'];

$url = "http://localhost:3000/product/productUser?user_id=".$user_id;



$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'GET',
		'ignore_errors' =>true

		)
	);

$context  = stream_context_create($options);
$response = file_get_contents($url,false,$context);
$response = json_decode($response);

if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'error'));

}else{
	header('Content-Type: application/json');
	echo json_encode(array('message' => $response));
}

