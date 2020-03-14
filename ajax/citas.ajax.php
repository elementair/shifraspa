<?php
require "../extenciones/paypal.controlador.php";
require_once ('../servicio/consulta.php');
require '../lib/PHPMailerAutoload.php';
require ("../lib/class.phpmailer.php");
// require_once "../config/ruta.php";



class AjaxCarrito{

	/* =================
		MÉTODO PAYPAL
	 ================= */

	public $total;
 	public $impuesto;
 	public $subtotal;
 	public $n_servicio;
 	public $precio;
 	public $duracion;
	public $id_servicio;

    public $nomServicio;
    public $diaCita;
    public $horaCita;
    public $usuarioTipo;
    public $idCliente;
    public $nomCliente;
    public $telefono;
    public $email;
    public $opcionPago;
    public $terminos;

    public $rfc;
    public $razonSocial;
    public $cfdi;


 	public function ajaxEnviarPaypal(){

		$datos = new consulta();

		$nuevo=$datos->registra_cita();

 		$datospay = array(
	 			"total"=>$this->total,
			 	"impuesto"=>$this->impuesto,
			 	"subtotal"=>$this->subtotal,
			 	"n_servicio"=>$this->n_servicio,
			 	"precio"=>$this->precio,
			 	"duracion"=>$this->duracion,
				"id_servicio"=>$this->id_servicio,
				"nomServicio"=>$this->nomServicio,
				"diaCita"=>$this->diaCita,
				"horaCita"=>$this->horaCita,
				"usuarioTipo"=>$this->usuarioTipo,
				"idCliente"=>$this->idCliente,
				"nomCliente"=>$this->nomCliente,
				"telefono"=>$this->telefono,
				"email"=>$this->email,
				"opcionPago"=>$this->opcionPago,
				"terminos"=>$this->terminos,

				"rfc"=>$this->rfc,
				"razonSocial"=>$this->razonSocial,
				"cfdi"=>$this->cfdi,

			
			);

		 $respuesta = Paypal::mdlPagoPaypal($datospay);

		 echo $respuesta;
		 
	 }

}
/* =================
MÉTODO PAYPAL
================= */
if(isset($_POST["total"])){

	$paypal = new AjaxCarrito();
	$paypal->total = $_POST["total"];
	$paypal->impuesto = $_POST["impuesto"];
	$paypal->subtotal = $_POST["subtotal"];
	$paypal->n_servicio = $_POST["n_servicio"];
	$paypal->precio = $_POST["precio"];
	$paypal->duracion = $_POST["duracion"];
	$paypal->id_servicio = $_POST["id_servicio"];
    $paypal->nomServicio= $_POST["nomServicio"];
    $paypal->diaCita= $_POST["diaCita"];
    $paypal->horaCita= $_POST["horaCita"];
    $paypal->usuarioTipo= $_POST["usuarioTipo"];
    $paypal->idCliente= $_POST["idCliente"];
    $paypal->nomCliente= $_POST["nomCliente"];
    $paypal->telefono= $_POST["telefono"];
    $paypal->email= $_POST["email"];
    $paypal->opcionPago= $_POST["opcionPago"];
	$paypal->terminos= $_POST["terminos"];

	$paypal->rfc= $_POST["rfc"];
    $paypal->razonSocial= $_POST["razonSocial"];
	$paypal->cfdi= $_POST["cfdi"];

	$paypal-> ajaxEnviarPaypal();

}	

function _formatear($fecha){

	return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;

}

?>