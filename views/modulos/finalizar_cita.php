<?php
// session_start();
// $url='http://localhost/shifra//';

require 'extenciones/bootstrap.php';
require_once 'modelos/carrito.modelo.php';
require_once 'controladores/carrito.controlador.php';

// require_once 'extenciones/paypal.controlador.php';

$url=$ruta_universal;

/**
 * Control session
 **/
// require_once ('../servicio/controlSession.php');


#importamos librería del SDK
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

/*====================================
	PAGO PAYPAL
====================================*/
// var_dump($apiContext);
#evaluamos si la compra esta aprobada
if(isset( $_GET['paypal']) && $_GET['paypal'] === 'true'){

	// $servicios =explode("-", $_GET['servicios']);

	#recibo el servicio agendado
	$servicios =$_GET['servicios'];

	#capturamos el Id del pago que arroja PayPal
	$paymentId = $_GET['paymentId'];

	#creamos un objeto de payment para confirmar que las credenciales di tengan el Id de pago resuelto
	$payment = Payment::get($paymentId, $apiContext);

	#creamos la ejecucion de pago, invocando la clase PaymentExecution() y extraemosel id del pagador
	$execution = new PaymentExecution();
	$execution->setPayerId($_GET['PayerID']);

	#validamos con las credenciales que el Id del pagador si coincida
	$payment->execute($execution, $apiContext);

	$datosTransaccion = $payment->toJSON();

	// var_dump($datosTransaccion);

	$datosUsuario = json_decode($datosTransaccion);

	// print_r($datosUsuario);
	// var_dump($datosUsuario);

	$emailComprador = $datosUsuario->payer->payer_info->email;
	$dir = $datosUsuario->payer->payer_info->shipping_address->line1;
	$ciudad = $datosUsuario->payer->payer_info->shipping_address->city;
	$estado = $datosUsuario->payer->payer_info->shipping_address->state;
	$codigoPostal = $datosUsuario->payer->payer_info->shipping_address->postal_code;
	$pais = $datosUsuario->payer->payer_info->shipping_address->country_code;

	$direccion = $dir.", ".$ciudad.", ".$estado.", ".$codigoPostal;
	// var_dump($direccion);

	#Actualizamos la base de datos
	for($i = 0; $i < count($servicios); $i++){
		// var_dump($i);

		$datospay = array("idCliente"=>'1',
					"idServicio"=>$servicios[$i],
					"metodo"=>'paypal',
					"email"=>$emailComprador,
					"direccion"=>$direccion,
					"pais"=>$pais);
		// var_dump($datospay);
		// try {
		// 	$db = new PDO('mysql:host=localhost; dbname=creactiv_shifraspa; charset=utf8mb4', 'root', '');
		// 	echo 'Conectado a '.$db->getAttribute(PDO::ATTR_CONNECTION_STATUS);
		//   } catch(PDOException $ex) {
		// 	echo 'Error conectando a la BBDD. '.$ex->getMessage();
		//   }

		$respuesta = ControladorCarrito::ctrNuevasCompras($datospay);

		if($respuesta=='ok'){
		// echo '¿estamos aqui?';
		// var_dump($datospay);

		?>
		<script>
		// window.location = "../envio_correo_cita.php";
			swal({
					title: "Wow!",
					text: "Tu cita se hiso exitosamente. revisa tu correo, te hemos mandado un correo.",
					type: "success"
				}).then(function() {
					window.location = "<?php echo $ruta_universal;?>";
				});

		</script>
		<?php
		}

	}

}



?>