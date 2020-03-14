<?php
	session_start();
	require_once ('servicio/consulta.php');
	require './lib/PHPMailerAutoload.php';
	require ("./lib/class.phpmailer.php");

	$datos = new consulta();
	
	$emailContacto = $_POST['correo_electronico'];
	$asuntoContacto = utf8_decode("¿olvidaste tu contraseña?");

	$datos_usuario = $datos->obten_datos_por_correo($emailContacto);
	foreach ($datos_usuario as $obtenContrasena ){
	   
	}

	$password = False;
	// print_r($datos_usuario);
	if($datos_usuario){
		$password = $obtenContrasena['contrasena'];
		$nombre = $obtenContrasena['nombre'];
	}
	else{
		header('Location: index.php');

	}

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
    $mail->AddAddress($emailContacto);
    
    $mail->IsHTML(true); // El correo se envía como HTML
    $mail->Subject = "Recuperacion de password"; // Este es el titulo del email.

    $body = '<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:800px; font-family:Verdana, Geneva, sans-serif;">';
    $body = $body. '<caption style="background-color:#400400; color: #fff; font-size: 12px;"><p><b>Asunto:</b>'.$asuntoContacto;
    $body = $body. '<thead>';
    $body = $body. '<tr>';
    $body = $body. '<th style="background-color:#4D0000; color: #fff; padding:5px;">';
    $body = $body. '<p style="color: #fff; font-size: 20px;">&#161;Gracias por confiar en nosotros&#33;</p>';
    $body = $body. '<p style="color: #fff; font-size: 12px;"> E S T A M O S  &nbsp;&nbsp;&nbsp; P A R A  &nbsp;&nbsp;&nbsp; S E R V I R T E : &nbsp; </p>';
    $body = $body. '</th>';
    $body = $body. '</tr>';
    $body = $body. '</thead>';
    $body = $body. '<tbody>';
    $body = $body. '<tr>';
    $body = $body. '<td>';
    $body = $body. '<p style="width:900px; font-size:18px; padding:5px; margin:0; background-color:#cccccc; color:#4D0000; text-align:center; font-family:Verdana, Geneva, sans-serif;">'.$nombre.'';
    $body = $body. '</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
    $body = $body. '<tr>';
    $body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
    $body = $body. '<p align="center" style="font-size:14px; padding-right:20px; color: #909090"><b>SHIFRA SPA agradece tu preferencia.</b><br><br><b>Tu password es:</b><span style="font-size:20px; color:green;">'.$password;'</span><br><br>
                
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
                    <b>Fecha de consulta:</b> '.date("d/m/y",time()).'<br>';
    $body = $body. '</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
    $body = $body. '</tbody>';
    $body = $body. '</table>';

    $mail->Body = $body; // Mensaje a enviar
    if(!$mail->Send()) {
    echo "Error al enviar: " . $mail->ErrorInfo;
    }else{    
		header('Location: index.php?mensaje=password_enviado');
	}


?>