<?php 

$arrayName = array(
	'state' => 'Finalizada', 
	);

$id = $_GET['id'];

$url = 'http://localhost:3000/transaction/'.$id.'.json';


$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'PUT', 
		'content' => http_build_query($arrayName), 
		'ignore_errors' =>true

		)
	);

$context  = stream_context_create($options);
$response = file_get_contents($url,false,$context);


if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'error'));

}else{
	header('Content-Type: application/json');
	echo json_encode(array('message' => $response));
}


