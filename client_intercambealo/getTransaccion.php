<?php 
$response = file_get_contents('http://localhost:3000/transaction.json');
$response = json_decode($response);

if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => "error"));

}else{
	
	header('Content-Type: application/json');
	echo json_encode(array('message' => $response));
}
