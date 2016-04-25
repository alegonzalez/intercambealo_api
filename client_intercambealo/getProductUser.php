<?php 

//Hay que mandar el user_id para traer los productos de esa usuario
$user_id = $_GET['id'];


$json_url = "http://localhost:3000/product/productUser";
$json= file_get_contents($json_url."?user_id=".$user_id);


echo $json;
die;

if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => "error"));

}else{
	
	header('Content-Type: application/json');
	echo json_encode(array('message' => $response));
}

