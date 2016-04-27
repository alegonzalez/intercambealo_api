<?php 
$arrayName = array(
	//'user_id' => 1, 
	'user_id' => $_POST['user_id'], 
	'name' => $_POST['name'], 
	'description' => $_POST['description'],
	'state' =>$_POST['state'],
	//'imagen' => $_FILES['archivo']['name'],
	'id' => $_POST['idProduct']
	//'imagen' => $_FILES['archivo']['tmp_name']
	);
$url = 'http://localhost:3000/product/'. $arrayName['id'] . '.json' ;
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
	echo json_encode(array('message' => 'El producto se creo exitosamente'));
}

