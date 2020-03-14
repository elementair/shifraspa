<?php
	session_start();
	require_once ('../servicio/consulta.php');
	require '../lib/PHPMailerAutoload.php';
	require("../lib/class.phpmailer.php");
	$datos = new consulta();
	$conexion = new Conexion();
	$conexion->selecciona_base_datos();
	$link = $conexion->link;
	$mensaje = False;
	$m_error="";

 	//Obtenemos los datos de los input
 	
 	$capturar_nombre 	  	= $_POST['nombre'];;
 	$capturar_c_electronico = $_POST['email']; ; 
	$capturar_archivo       = $_POST['foto'];;
	
	// hacer una insercion de datos por redes sociales en esta parte. 
	
	// $myDateTime = DateTime::createFromFormat('Y-m-d', $weddingdate);
	// $formattedweddingdate = $myDateTime->format('d-m-Y');
	
	// código para enviar el formulario

	$mail = new PHPMailer;
	//Luego tenemos que iniciar la validación por SMTP:
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "mail.shifraspa.com.mx"; // SMTP a utilizar. Por ej. smtp.elserver.com
	$mail->Username = "contacto@shifraspa.com.mx"; // Correo completo a utilizar
	$mail->Password = "P3+?q.1GF}6h"; // Contraseña
	$mail->Port = 587; // Puerto a utilizar

	$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		));
	//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
	$mail->From = "contacto@shifraspa.com.mx"; // Desde donde enviamos (Para mostrar)
	// $mail->From = "element.earias20@gmail.com"; // Desde donde enviamos (Para mostrar)
	$mail->FromName = "Shifra Spa";
	//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
	// $mail->AddAddress("contacto@shifraspa.com.mx"); // Esta es la dirección a 
	$mail->AddAddress("emanuel_arias@creactivmedia.com.mx");
	$mail->AddAddress($capturar_c_electronico);
	
	$mail->IsHTML(true); // El correo se envía como HTML
	$mail->Subject = "Reguistro de usuario con Facebook"; // Este es el titulo del email.

	$body = '<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:800px; font-family:Verdana, Geneva, sans-serif;">';
    $body = $body. '<caption style="background-color:#400400; color: #fff; font-size: 12px;"><p><b>Asunto:</b>Registro Exitoso.</p></caption>';
    $body = $body. '<thead>';
    $body = $body. '<tr>';
    $body = $body. '<th style="background-color:#4D0000; color: #fff; padding:5px;">';
    $body = $body. '<p style="color: #fff; font-size: 20px;">&#161;Gracias por confiar en nosotros&#33;</p>';
    $body = $body. '<p style="color: #fff; font-size: 12px;"> B I E N V E N I D O  &nbsp;&nbsp;&nbsp;   A  &nbsp;&nbsp;&nbsp; S H I F R A  &nbsp; S P A :</p>';
    $body = $body. '</th>';
    $body = $body. '</tr>';
    $body = $body. '</thead>';
    $body = $body. '<tbody>';
    $body = $body. '<tr>';
    $body = $body. '<td>';
    $body = $body. '<p style="width:900px; font-size:18px; padding:5px; margin:0; background-color:#cccccc; color:#4D0000; text-align:center; font-family:Verdana, Geneva, sans-serif;">'.$capturar_nombre.'';
    $body = $body. '</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
 	$body = $body. '<tr>';
    $body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
    $body = $body. '<p align="center" style="font-size:14px; padding-right:20px; color: #909090"><b>SHIFRA SPA agradece tu preferencia.</b><br><br>Este correo es para informarte acerca de la seguridad de tu informaci&oacute;n personal, tus datos est&aacute;n 100% seguros, somos una empresa comprometida con el bienestar de nuestros clientes. Te invitamos a revisar nuestras pol&iacute;ticas de privacidad y cookies.<br><br>
                Tus datos personales son privados y nuestro objetivo es usarlas &uacute;nicamente para reservar citas,  notificarte nuestras promociones y regalos.<br><br>
                Gracias por confiar en nosotros.<br><br>
                Si tienes dudas nos puedes llamar a las siguientes l&iacute;neas de atenci&oacute;n:<br><br>
                01 (33) 3611-3310<br>01 (33) 3611-3313<br><br>';
	$body = $body. '</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
 	$body = $body. '<tr>';
    $body = $body. '<td  style="font-size:12px;">';
    $body = $body. '<p align="center" style="padding:10px; margin:0; background-color:#4D0000; font-family:Verdana, Geneva, sans-serif; color:#fff;" >
                &copy; COPYRIGHT 2018, desarrollado por <strong>CreActiv Media.</strong><br>';
    $body = $body. '</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
    $body = $body. '<tr>';
    $body = $body. '<td  style="font-size:10px;">';
    $body = $body. '<p align="center" style="padding:5px; margin:0; background-color:#400400; font-family:Verdana, Geneva, sans-serif; color:#fff;" >
                    <b>Fecha de registro:</b> '.date("d/m/y",time()).'<br>';
    $body = $body. '</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
    $body = $body. '</tbody>';
	$body = $body. '</table>';

	$mail->Body = $body; // Mensaje a enviar
		       
	// REGUISTRAR AL USUARIO
    $nuevo= mysqli_query($link,"SELECT COUNT(*) AS total FROM clientes WHERE c_electronico='".$_POST['email']."'");
    $row=mysqli_fetch_object($nuevo);

    // SI YA EXISTE UN REGUISTRO
    if($row->total > 0){

    	$_SESSION['session_valida'] = 1;
        $_SESSION['c_electronico'] = $_POST["email"];        

		if($_SESSION['session_valida'] = 1){
			$clientes=mysqli_query($link,'SELECT id, nombre, c_electronico, telefono, status FROM clientes WHERE c_electronico="'.$_SESSION['c_electronico'].'"');
			            
			foreach ($clientes as $cliente) {
                $id_cliente = $cliente['id'];
				$nombre_cliente = $cliente['nombre'];
				$c_electronico_cliente = $cliente['c_electronico'];
				$telefono_cliente = $cliente['telefono']; 
					
			}
				$res_id=$id_cliente;
                $res_nombre=$nombre_cliente;
                $res_email=$c_electronico_cliente;
                $res_phone=$telefono_cliente;

		}else{

			$MJEerror='<center><div class="alert alert-warning">no has iniciado sesion</div></center>';
			$res_id="";
            $res_nombre="";
            $res_email="";
            $res_phone="";
		}
    }
    else
    {
			        
		// ANTES DE REDIRECCIONAR LOGUEO AUTOMATICO
  
		$nuevo = $datos->registra_usuario_facebook();

		if(!$mail->Send()) {
			echo "Error al enviar: " . $mail->ErrorInfo;
		} else {


	        $_SESSION['session_valida'] = 1;
	        $_SESSION['c_electronico'] = $_POST["email"];

	        
			if($_SESSION['session_valida'] = 1){
				$clientes=mysqli_query($link,'SELECT id, nombre, c_electronico, telefono, status FROM clientes WHERE c_electronico="'.$_SESSION['c_electronico'].'"');
				
				foreach ($clientes as $cliente) {
	                $id_cliente = $cliente['id'];
					$nombre_cliente = $cliente['nombre'];
					$c_electronico_cliente = $cliente['c_electronico'];
					$telefono_cliente = $cliente['telefono']; 
						
				}
				 	$res_id=$id_cliente;
	                $res_nombre=$nombre_cliente;
	                $res_email=$c_electronico_cliente;
	                $res_phone=$telefono_cliente;

	          
			}else{

			$MJEerror='<center><div class="alert alert-warning">no has iniciado sesion</div></center>';

			 	$res_id="";
	            $res_nombre="";
	            $res_email="";
	            $res_phone="";
			}

		}
			    			       
       //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
		header('Content-Type: application/json');
		//Guardamos los datos en un array
		$datos = array(
		'respuesta' => 'ok',
		'nombre' => $capturar_nombre, 
		'c_electronico' => $capturar_c_electronico, 
		'archivo' => $capturar_archivo
		);
		//Devolvemos el array pasado a JSON como objeto
		$info = json_encode($datos, JSON_FORCE_OBJECT);
		echo($info);
		
	} 
	
?>