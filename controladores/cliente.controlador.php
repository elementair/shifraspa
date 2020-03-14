<?php 	
require_once "../modelos/cliente.modelo.php";
class ControladorUsuarios{

	/*=============================================
	REGISTRO CON REDES SOCIALES
	=============================================*/

	static public function ctrRegistroRedesSociales($datos){

		$tabla = "clientes";
	
		$respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla,  $datos);

		return $respuesta;

	}
}



 ?>