<?php
require_once "conexionPaypal.php";


class ModeloCarrito{

	/*=============================================
	MOSTRAR TARIFAS
	=============================================*/

	static public function mdlMostrarTarifas($tabla){
		
		$stmt = ConexionPaypal::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$tmt =null;

	}

	/*=============================================
	NUEVAS CITAS
	=============================================*/

	static public  function _formatear($fecha){

        return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;

    }

	static public function mdlNuevasCompras($tabla, $datospay){
		


		$stmt = ConexionPaypal::conectar()->prepare("INSERT INTO $tabla (id_cliente, id_servicio, metodo, email, direccion, pais) VALUES (:id_cliente, :id_servicio, :metodo, :email, :direccion, :pais)");

		$stmt->bindParam(":id_cliente", $datospay["idCliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_servicio", $datospay["idServicio"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo", $datospay["metodo"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datospay["email"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datospay["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datospay["pais"], PDO::PARAM_STR);

		if($stmt->execute()){ 

			return "ok"; 
	
		}else{ 

			return "error"; 

		}

		$stmt->close();

		$tmt =null;
	}

	
		
}