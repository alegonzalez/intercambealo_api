<?php 

$arrayName = array(
	'product_req_id' => $_POST['product_req_id'], 
	'product_offered_id' => $_POST['product_offered_id'], 
	'user_id' => $_POST['user_id'],
	'state' => 'Pendiente'
);


$url = 'http://localhost:3000/transaction';

$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
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

