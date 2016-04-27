<?php 
$array = array(
     'name' => $_FILES['archivo']['name'],
     'tmp_name' => $_FILES['archivo']['tmp_name'],
     'type' => $_FILES['archivo']['type'],
     'size' => $_FILES['archivo']['size']

	);
$array = json_encode($array);
$arrayName = array(
	'user_id' => 1, 
	//'user_id' => $_POST['user_id'], 
	'name' => $_POST['name'], 
	'description' => $_POST['description'],
	'state' =>$_POST['state'],
	'imagen' => $_FILES['archivo']['name']
	//'imagen' => $_FILES['archivo']['tmp_name']
	);
$url = 'http://localhost:3000/product';
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
var_dump($response);
die;

if($response === FALSE){
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'error'));

}else{
	header('Content-Type: application/json');
	echo json_encode(array('message' => 'El producto se creo exitosamente'));
}

