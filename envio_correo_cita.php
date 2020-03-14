<?php
session_start();
require_once ('servicio/consulta.php');
require './lib/PHPMailerAutoload.php';
require ("./lib/class.phpmailer.php");
require_once "./config/ruta.php";

function _formatear($fecha){

        return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;

    }


$datos = new consulta();
$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;
$mensaje = False;
$m_error="";

// $idServicio     = $_POST['deacuerdo'];
$duracion       = $_POST['duracion'];
$nombreServicio = $_POST['nombre_serv'];
$precio         = $_POST['precio'];
$dia            = $_POST['booking_arrival_date'];
$hora           = $_POST['booking_treatment'];
$usuario        = $_POST['usuario'];
$id  		 	= $_POST['id_cliente'];
$nombreUsuario  = $_POST['nombre'];
$numerotelefono = $_POST['telefono'];
$email          = $_POST['email'];
$formaPago      = $_POST['opcion_pago'];
$terminos       = $_POST['terminos'];
$empleado 	    =$_POST['empleado'];
// $id_empleado	= $_POST['id_empl'];


if(isset($_POST['dejarenblanco'])){
$dejarenblanco = $_POST['dejarenblanco'];
}
if(isset($_POST['nocambiar'])){
    $nocambiar = $_POST['nocambiar'];
}
if ($dejarenblanco == 'nada' && $nocambiar == 'http://') {

	// código para enviar el formulario

	$mail = new PHPMailer;
	//Luego tenemos que iniciar la validación por SMTP:
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = "mail.shifraspaandares.com.mx"; // SMTP a utilizar. Por ej. smtp.elserver.com
	$mail->Username = "contacto@shifraspaandares.com.mx"; // Correo completo a utilizar
	$mail->Password = "cont*ssa99"; // Contraseña
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
	$mail->FromName = "ShifraSpa";
	//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
	// $mail->AddAddress("contacto@shifraspa.com.mx"); // Esta es la dirección a
	$mail->AddAddress("emanuel_arias@creactivmedia.com.mx");
	$mail->AddAddress($email);

	$mail->IsHTML(true); // El correo se envía como HTML
	$mail->Subject = "Sistema de citas ShifraSpa"; // Este es el titulo del email.
	$mail->AddEmbeddedImage($ruta_universal.'img/logo_blanco.png', 'logo_blanco');

	$body = '<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:800px; font-family:Verdana, Geneva, sans-serif;">';
	$body = $body. '<caption style="background-color:#400400; color: #fff; font-size: 12px;"><p><b>Asunto:</b>'.$nombreServicio.' agendado.</p></caption>';
	$body = $body. '<thead>';
	$body = $body. '<tr>';
	$body = $body. '<th style="background-color:#4D0000; color: #fff; padding:5px;">';
	$body = $body. '<img  height="80" src="cid:logo_blanco" alt="" style="width: 150px;">';
	$body = $body. '<p style="color: #fff; font-size: 20px;">&#161;Gracias por confiar en nosotros&#33;</p>';
	$body = $body. '<p style="color: #fff; padding-bottom:10px; font-size: 12px;"> R e s u m e n  &nbsp;&nbsp; d e  &nbsp;&nbsp; t u &nbsp;&nbsp;  s e r v i c i o :</p>';
	$body = $body. '</th>';
	$body = $body. '</tr>';
	$body = $body. '</thead>';
	$body = $body. '<tbody>';
	$body = $body. '<tr>';
	$body = $body. '<td>';
	$body = $body. '<p style="font-size:16px; font-weight: 900; margin:0; padding:5px; background-color:#cccccc; color:#4D0000; text-align:center;">Informaci&oacute;n del servicio agendado</p>';
	$body = $body. '</td>';
	$body = $body. '</tr>';
	$body = $body. '<tr>';
	$body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
	$body = $body. '<p style="font-size:14px; padding-right:20px; "><b>&nbsp;&nbsp;Nombre del servicio:&nbsp;</b>'.$nombreServicio.'</p>';
	$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Dia:&nbsp;</b>'.$dia.'</p>';
	$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Hora :&nbsp;</b>'.$hora.'</p>';
	$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Duraci&oacute;n :&nbsp;</b>'.$duracion .' min</p>';
	$body = $body. '</td>';
	$body = $body. '</tr>';
	$body = $body. '<tr>';
   	$body = $body. '<td>';
	$body = $body. '<p style="font-size:16px; font-weight: 900; margin:0; padding:5px; background-color:#cccccc; color:#4D0000; text-align:center;">Informaci&oacute;n del cliente</p>';
	$body = $body. '</td>';
	$body = $body. '</tr>';
   	$body = $body. '<tr>';
	$body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
	$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Nombre:&nbsp;</b>'.$nombreUsuario.'</p> ';
	$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Telefono:&nbsp;</b>'.$numerotelefono.'</p>';
	$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Correo:&nbsp;</b>'.$email.'</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
    $body = $body. '<tr>';
    $body = $body. '<td>';
    $body = $body. '<p style="font-size:16px;  font-weight: 900; margin:0; padding:5px; background-color:#cccccc; color:#4D0000; text-align:center;">Informaci&oacute;n del pago</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
    $body = $body. '<tr>';
    $body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
    $body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Forma de pago:&nbsp;</b> '.$formaPago.'</p>';
    $body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Total pagado:&nbsp;</b> $'.$precio.'</p>';
    $body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Fecha de operacion:&nbsp;</b> '.date("d/m/y",time()).'</p>';
    $body = $body. '</td>';
	$body = $body. '</tr>';
    $body = $body. '<tr>';
    $body = $body. '<td>';
    $body = $body. '<p style="font-size:16px; font-weight: 900; margin:0; padding:5px; background-color:#cccccc; color:#4D0000; text-align:center;">Informaci&oacute;n adicional</p>';
    $body = $body. '</td>';
    $body = $body. '</tr>';
 	$body = $body. '<tr>';
    $body = $body. '<td style="padding:25px; background-color:#dddddd50;">';
    $body = $body. '<p style="font-size:12px; padding-right:20px; color: #00000080;">
                    <b style="color:#4D000090;">CONDICIONES DE SALUD</b>
                    <br><br>
                    Para otorgar el servicio, el cliente deber&aacute; proporcionar informaci&oacute;n en su historia cl&iacute;nica.
                    <br><br>
                    La empresa NO se hace responsable de negligencias o alteraciones a la verdad que proporcione.
                    <br><br>
                    <b style="color:#4D000090;">RETARDOS</b>
                    <br><br>
                    Si usted llega 10 minutos tarde su servicio ser&aacute; recortada si usted llega 15 minutos tarde su servicio ser&aacute; cancelado.
                    <br><br>
                    Los paquetes tienen vigencia de 6 meses m&aacute;ximo para tomar los servicios, pasando este tiempo se le cobrara una reactivaci&oacute;n de servicio tomado.
                    <br><br>
                    <b style="color:#4D000090;">POL&Iacute;TICAS DE CANCELACI&Oacute;N</b>
                    <br><br>
                    En caso de no poder asistir  a su cita, le pedimos haga su cancelaci&oacute;n con tres horas de anticipaci&oacute;n. De lo contrario se toma como servicio tomado. As&iacute; mismo si desea cambiar su tratamiento debe avisar con m&iacute;nimo de 2 horas de anticipaci&oacute;n.
                    <br><br>
                    <b style="color:#4D000090;">DURANTE SU VISITA</b>
                    <br><br>
                    El cliente deber&aacute; mostrar un comportamiento adecuado y respetuoso hacia el personal, evitando insinuaciones o faltas a la moral.
                    De presentarse algunos de estos casos el servicio ser&aacute; suspendido.
                    <br><br>
                    Shifra Spa NO se hace responsable de objetos olvidados dentro de las instalaciones.
                    <br><br>
                    No hay devoluciones. Sin excepci&oacute;n.
                    <br><br><hr>';
 	$body = $body. '<p style="text-align: center; margin:0; font-size: 14px; color: #400400;">
                    Es mi decisi&oacute;n libre de aceptar el servicio que he adquirido, deslindando a ANDARES SPA & MEDICAL CENTER S DE RL DE CV  de cualquier responsabilidad Civil, contractual y extracontractual que surja durante la realizaci&oacute;n de los servicios as&iacute; como el pago de cualquier indemnizaci&oacute;n.
                    <br><br>
                    Por medio de la presente yo:<span style=" font-size:13px; text-decoration: underline; text-transform: uppercase; font-weight: 900;">&nbsp;'.$nombreUsuario.'&nbsp;</span> certifico que he manifestado la verdad y adem&aacute;s estoy ampliamente informado (a) del diagn&oacute;stico y plan de tratamiento, as&iacute; como de las modificaciones que se juzgan necesarias para el mejoramiento del mismo.';
 	$body = $body. '</p>';
 	$body = $body. '</p>';
 	$body = $body. '</td>';
 	$body = $body. '</tr>';
 	$body = $body. '<tr>';
 	$body = $body. '<td>';
 	$body = $body. '<p style="font-size:14px;  margin:0; padding:5px; background-color:#cccccc; color:#000000; text-align:center; font-family:Verdana, Geneva, sans-serif;">
                     <br>
                    Si tienes dudas nos puedes llamar a las siguientes l&iacute;neas de atenci&oacute;n:
                    <br><br>
                    01 (33) 3611-3310
                    <br>01 (33) 3611-3313<br><br> ';
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

	if(!$mail->Send()) {

		echo "Error al enviar: " . $mail->ErrorInfo;

	} else {

       $nuevo=$datos->registra_cita();
       header('Location: index.php?mensaje=cita_ajendada');
       return "Ok";

	}
}
?>