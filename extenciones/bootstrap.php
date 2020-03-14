<?php
require __DIR__ .'/vendor/autoload.php';

if (file_exists('../config/conexion.php')) {
      require_once('../config/conexion.php');
}else{
      require_once('./config/conexion.php');
}

// $datos = new consulta();
$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;



use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$respuesta=mysqli_query($link,"SELECT clienteIdPaypal, llaveSecretaPaypal, modoPayPal FROM comercio");
foreach ($respuesta as $respuest ) {
	# code...
}
$clienteIdPaypal = $respuest["clienteIdPaypal"];
$llaveSecretaPaypal = $respuest["llaveSecretaPaypal"]; 
$modoPaypal = $respuest["modoPayPal"];

// print_r($clienteIdPaypal);
// print_r($llaveSecretaPaypal);
// print_r($modoPaypal);

$apiContext = new ApiContext(
	new OAuthTokenCredential(
		$clienteIdPaypal, 
		$llaveSecretaPaypal
	)
);

$apiContext->setConfig(
    array(
        'mode' => $modoPaypal,
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'DEBUG',
        'http.CURLOPT_CONNECTTIMEOUT' => 30
    )
);

?>