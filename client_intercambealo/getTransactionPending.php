<?php 

$user_id = $_GET['id'];

$url = "http://localhost:3000/transaction/getNameProductReq?user_id=".$user_id;


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

$nameProduct = [];

for ($i=0; $i <count($response); $i++) { 

	$url = "http://localhost:3000/transaction/getNameProductOffer/?product_id=".$response[$i]->product_req_id;

	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'GET',
			'ignore_errors' =>true

			)
		);

	$context  = stream_context_create($options);
	$r = file_get_contents($url,false,$context);
	$r = json_decode($r);

	$nameProduct[$i] = $r;

}

$result = array_merge($response,$nameProduct);
header('Content-Type: application/json');
echo json_encode(array('message' => $response , 'message2' =>$nameProduct));
