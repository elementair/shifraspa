<?php
class Conexion{
	public $nombre_base_datos = 'creactiv_shifra';
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '';
	public $link;

	function __construct(){
		$this->link = mysqli_connect($this->host, $this->user, $this->pass);


        mysqli_set_charset($this->link, "utf8");

	}

	public function selecciona_base_datos($nombre_base_datos=false){ //Pruebas finalizadas
		if($nombre_base_datos){
			$this->nombre_base_datos = $nombre_base_datos;
		}
		$consulta = "USE ".$this->nombre_base_datos;
		$this->link->query($consulta);




        if($this->link->error){
			return array('mensaje' => $this->link->error, 'error' => True );
		}
		else{
			return true;
		}
	}

	// public function conectar(){

	// 	try {

	// 		$link = new PDO("mysql:host=localhost;dbname=creactiv_shifraspa",
	// 				"root",
	// 				"",
	// 				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	//                       PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	// 				);
	// 		var_dump('conexion exitosa');

	// 	} catch (Exception $e) {

	// 		var_dump('no es posible conectar');

	// 	}

	// return $link;

	// }

}
?>