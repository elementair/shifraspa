<?php 
$id_now = $_POST['id'];
$dia_now = $_POST['dia'];
$hora_now = $_POST['hora'];

	
	
	header('Content-Type: application/json');
	//Guardamos los datos en un array
	$datos = array(
	'estado' => 'ok',
	'id' => $id_now,  
	'dia' => $dia_now, 
	'hora' => $hora_now
	);
	//Devolvemos el array pasado a JSON como objeto
	$info = json_encode($datos, JSON_FORCE_OBJECT);
	echo($info);

	


 ?> 	

