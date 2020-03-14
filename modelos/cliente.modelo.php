<?php

require_once "../config/conexion.php";

class ModeloUsuarios{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlRegistroUsuario($tabla, $datos){
		$conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link; 
        $consulta = "INSERT INTO $tabla (nombre,a_paterno,a_materno,archivo,telefono,c_electronico,contrasena, status) 
                            VALUES('".$datos['nombre']."', '".$datos['a_paterno']."','".$datos['a_materno']."'
                            ,'".$datos['archivo']."','".$datos['telefono']."','".$datos['c_electronico']."'    
                            ,'".$datos['contrasena']."', '1')";
            $link->query($consulta);
            if(!$link->error){
               return "ok";
            }
            else{
               return "error";
            }





		// $sql = ("INSERT INTO $tabla(nombre, a_paterno, a_materno, telefono, contrasena, c_electronico, archivo, modo, status) VALUES (:nombre, :a_paterno, :a_materno, :telefono, :contrasena, :c_electronico, :archivo, :modo, :status");

		// $stmt = ConexionPaypal::conectar()->prepare($sql);

		// $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		// $stmt->bindParam(":a_paterno", $datos["a_paterno"], PDO::PARAM_STR);
		// $stmt->bindParam(":a_materno", $datos["a_materno"], PDO::PARAM_STR);
		// $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		// $stmt->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
		// $stmt->bindParam(":c_electronico", $datos["c_electronico"], PDO::PARAM_STR);
		// $stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);
		// $stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		// $stmt->bindParam(":status", $datos["status"], PDO::PARAM_INT);

		// if($stmt->execute()){

		// 	return "ok";

		// }else{

		// 	return "error";
		
		// }

		// $stmt->close();
		// $stmt = null;

	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	// static public function mdlMostrarUsuario($tabla, $item, $valor){

	// 	$stmt = ConexionPaypal::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

	// 	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	// 	$stmt -> execute();

	// 	return $stmt -> fetch();

	// 	$stmt-> close();

	// 	$stmt = null;

	// }

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	// static public function mdlActualizarUsuario($tabla, $id, $item, $valor){

	// 	$stmt = ConexionPaypal::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

	// 	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	// 	$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

	// 	if($stmt -> execute()){

	// 		return "ok";

	// 	}else{

	// 		return "error";

	// 	}

	// 	$stmt-> close();

	// 	$stmt = null;

	// }

	/*=============================================
	ACTUALIZAR PERFIL
	=============================================*/

	// static public function mdlActualizarPerfil($tabla, $datos){

	// 	$stmt = ConexionPaypal::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, password = :password, foto = :foto WHERE id = :id");

	// 	$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

	// 	if($stmt -> execute()){

	// 		return "ok";

	// 	}else{

	// 		return "error";

	// 	}

	// 	$stmt-> close();

	// 	$stmt = null;

	// }
}