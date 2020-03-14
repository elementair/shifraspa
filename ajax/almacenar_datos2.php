<?php 
 	//Obtenemos los datos de los input
 	$idServicio 	= $_POST['recibe_id'];
	$nombreServicio = $_POST['recibe_nombre'];
	$duracion       = $_POST['recibe_duracion'];
 	$precio         = $_POST['recibe_precio'];
	
	//Hacemos las comprobaciones que sean necesarias... (sanitizar los textos para evitar XSS e inyecciones de código, comprobar que la edad sea un número, etc.)
	//Omitido para la brevededad del código
	//PERO NO OLVIDES QUE ES ALGO IMPORTANTE.

	//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
	header('Content-Type: application/json');
	//Guardamos los datos en un array
	$datos = array(
	'estado' => 'ok',
	'recibe_id' => $idServicio, 
	'recibe_nombre' => $nombreServicio, 
	'recibe_duracion' => $duracion, 
	'recibe_precio' => $precio
	);
	//Devolvemos el array pasado a JSON como objeto
	$info = json_encode($datos, JSON_FORCE_OBJECT);
	echo($info);
	
 ?> 	

