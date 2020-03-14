<?php 
 	//Obtenemos los datos de los input
 	$metodo = $_POST['opcion_pago'];

	//Hacemos las comprobaciones que sean necesarias... (sanitizar los textos para evitar XSS e inyecciones de código, comprobar que la edad sea un número, etc.)
	//Omitido para la brevededad del código
	//PERO NO OLVIDES QUE ES ALGO IMPORTANTE.

	//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
	header('Content-Type: application/json');
	//Guardamos los datos en un array
	$datos = array(
	'estado' => 'ok',
	'metodopago' => $metodo
	);
	
	//Devolvemos el array pasado a JSON como objeto
	$info = json_encode($datos, JSON_FORCE_OBJECT);
	echo($info);
	
 ?> 	