<?php
require_once ('./servicio/consulta.php');
require './lib/PHPMailerAutoload.php';
require ("./lib/class.phpmailer.php");

class ControladorCarrito{
	

	/*=============================================
	MOSTRAR TARIFAS
	=============================================*/

	public function ctrMostrarTarifas(){

		$tabla = "comercio";

		$respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);

		return $respuesta;

	}	

	/*=============================================
	NUEVAS COMPRAS
	=============================================*/

	static public function ctrNuevasCompras($datospay){

		$tabla = "citas";

		$respuesta = ModeloCarrito::mdlNuevasCompras($tabla, $datospay);

		if($respuesta == "ok"){
		// 	echo('¿cual es la respuesta de esto?');
		// var_dump($respuesta);	
		// var_dump($datospay);	

		}
		return $respuesta;

	

	}
	
	
	/*=============================================
		VERIFICAR PRODUCTO COMPRADO
	=============================================*/

	static public function ctrVerificarProducto($datos){
		

		$tabla = "citas";

		$respuesta = ModeloCarrito::mdlVerificarProducto($tabla, $datos);
	 
	    return $respuesta;
				
	}
	
}