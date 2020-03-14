<?php
class ConexionPaypal{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=creactiv_shifra",
						"root",
						"",
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);
		// foreach($link->query('SELECT * from clientes') as $fila) {
		//         print_r($fila);
		//     }

		return $link;

	}

}



