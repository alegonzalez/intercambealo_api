<?php 


$arrayName = array(
	'id' => $_GET['id'], 
);

$id = $_GET['id'];

$url = 'http://localhost:3000/product/'.$id.'.json';

$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'DELETE', 
		'ignore_errors' =>true

		)
	);

$context  = stream_context_create($options);
$response = file_get_contents($url,false,$context);
var_dump($response);
die;

if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'error'));

}else{
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'El producto se creo exitosamente'));
}

