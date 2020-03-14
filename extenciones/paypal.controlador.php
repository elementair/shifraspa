<?php

require_once "../modelos/carrito.modelo.php";

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class Paypal{

	static public function mdlPagoPaypal($datospay){

		require __DIR__ . '/bootstrap.php';
		$url= 'http://localhost/shifra/';

		// seleccionamos el metodo de pago

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$titulo   = $datospay["n_servicio"];
		$precio   = $datospay["precio"];
		$duracion = $datospay["duracion"];
		$total    = $datospay["total"];
		$subtotal = $datospay["subtotal"];
		$impuesto = $datospay["impuesto"];
		$id       = $datospay["id_servicio"];

		$nomServicio= $datospay["nomServicio"];
		$diaCita	= $datospay["diaCita"];
		$horaCita	= $datospay["horaCita"];
		$usuarioTipo= $datospay["usuarioTipo"];
		$idCliente	= $datospay["idCliente"];
		$nomCliente	= $datospay["nomCliente"];
		$telefono	= $datospay["telefono"];
		$email		= $datospay["email"];
		$opcionPago	= $datospay["opcionPago"];
		$terminos	= $datospay["terminos"];

		$rfc		= $datospay["rfc"];
		$razonSocial	= $datospay["razonSocial"];
		$cfdi	= $datospay["cfdi"];

		$item = new Item();
		// $variosItem = array();

		// $item= new Item();
		$item->setName($titulo)
		     ->setPrice($total);

		// // Agrupamos los items de una lista de ITEMS
		 $itemList = new ItemList();
		 $itemList->setItems($item);


		//Agregamos los detalles del pago: impuestos, envios... etc
		$details=new Details();
		$details->setTax($impuesto)
	            ->setSubtotal($subtotal);

	    //definimos el pago total en sus detalles
	    $amount = new Amount();
	    $amount->setCurrency("MXN")
		       ->setTotal($total)
               ->setDetails($details);

        $transaction = new Transaction();
		$transaction->setAmount($amount)

                    ->setDescription("CITA:SHIFRASPA </br> Servicio: ".$titulo.'<br> '.$total)
                    ->setInvoiceNumber(uniqid());

        #Agregamos las URL´s después de realizar el pago. o cuando el pago es cancelado
        #importante agregar la URL principal en la API developers de Paypal

		// servicio_ind.php?servicio_id=".$id
		// index.php?ruta=finalizar-compra&paypal=true&servicios=".$id_servicio

        $redirectUrls = new RedirectUrls();

		$redirectUrls->setReturnUrl("$url/index?pagina=finalizar_pago&paypal=true&servicios=".$id)
                     ->setCancelUrl("$url/index");

        #Agregamos todas las caracteristicas de pago

        $payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));

		// $request = clone $payment;
		// var_dump($payment);

		#tratar de ejecutas un proceso y si falla ejecutar una rutina de error
		try{

			$payment->create($apiContext);

			// var_dump(json_decode($payment));

		}catch(PayPal\Exception\PayPalConnectionException $ex){

			echo $ex->getCode();
			echo $ex->getData();
			die($ex);
			return "$url/index?pagina=error";
		}

		foreach ($payment->getLinks() as $link) {

			if($link->getRel() == "approval_url"){

				$redirectUrl = $link->getHref();

			}
		}

		return $redirectUrl;

	}

}

 ?>