<?php 

$user_id = $_GET['id'];


$response = @file_get_contents('http://localhost:3000/transaction?user_id='.$user_id);
$response = json_decode($response);



$url = "http://localhost:3000/transaction/dateProduct/?user_id=".$response[0]->user_id."&id=".$response[0]->id;

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

	for ($i=0; $i < count($response); $i++) { 

		if($response[$i]->id==null)
		{
			unset($response[$i]);
			$response = array_values($response);
		}

	}


if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => "error"));

}else{
	
	header('Content-Type: application/json');
	echo json_encode(array('message' => $response));
}
