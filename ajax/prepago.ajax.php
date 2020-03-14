<?php

require_once ('../servicio/consulta.php');
$datos = new consulta();
$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;

$num = $_POST["numFolio"];

sleep(2);
/* php comment
|
|====================================================
|
|   CONSULTAS 
|
|====================================================
|
*/
$prepagos_servicios = mysqli_query($link, "SELECT 	s.id AS 's_id',
		s.nombre AS 's_nombre', 
		s.descripcion AS 's_descripcion', 
		s.archivo AS 's_archivo',
		s.duracion AS 's_duracion',
		s.precio AS 's_precio',
		s.status AS 's_status',
		s.subgrupo_servicios_id AS 's_subgrupo_servicios_id',
		ps.id AS 'ps_id', 
		ps.nombre AS 'ps_nombre', 
		ps.prepagos_id AS 'ps_prepagos_id',
		ps.servicios_id AS 'ps_servicios_id',
		ps.folio AS 'ps_folio',
		ps.cupon AS 'ps_cupon',
		ps.fecha_vencimiento AS 'ps_fecha_vencimiento',
		ps.status AS 'ps_status'
	FROM servicios AS s
	LEFT OUTER JOIN prepagos_servicios AS ps ON s.id=ps.servicios_id	
	WHERE folio='$num';");

$cadena = "";
$dato = '';
$cuenta_prepagos2 = 1;

foreach ($prepagos_servicios as $prepago){

	$folio = $prepago['ps_folio'];
	$servicio_id = $prepago['ps_servicios_id'];

	if($num == $folio){

		// $nombre = "pedicure";
		// $duracion = 80;
		// $precio = 5000;
		// $deacuerdo = 5;
		
		$dato = '<div class="panel panel-default">';
		$dato = $dato.'<div class="panel-heading" style="display: flex;">';
		$dato = $dato.'<div class="col-xs-12 col-md-10">';
		$dato = $dato.'<h5 class="panel-title">';
		$dato = $dato.'<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion70" href="#accordion890_30'.$cuenta_prepagos2.'">'.$prepago['s_nombre'].'</a>';
		$dato = $dato.'</h5>';
		$dato = $dato.'</div>';
		$dato = $dato.'</div>';
		$dato = $dato.'<div id="accordion890_30'.$cuenta_prepagos2.'" class="panel-collapse collapse">';
		$dato = $dato.'<div class="panel-body desc_individual">';
		$dato = $dato.'<div class="col-md-12">';
		$dato = $dato.'<br>';
		$dato = $dato.'<p>'.$prepago['s_descripcion'].'</p>';
		$dato = $dato.'<hr>';
		$dato = $dato.'<div class="col-xs-6 col-md-4">';
		$dato = $dato.'<label title="servicio pagado en prepago">Precio<p><strike>$'.$prepago['s_precio'].'</strike> Pagado</p>';
		$dato = $dato.'</label>';
		$dato = $dato.'</div>';
		$dato = $dato.'<div class="col-xs-6 col-md-4">';
		$dato = $dato.'<label>Duración <p>'.$prepago['s_duracion'].'min';
		$dato = $dato.'</p></label>';
		$dato = $dato.'</div>';	
		$dato = $dato.'<div class="col-xs-12 col-md-4">';
		$dato = $dato.'<label class="container">';
		
		$dato = $dato.'<input type="hidden" id="p_id" value="'.$prepago['s_id'].'">';
		$dato = $dato.'<input type="hidden" id="p_precio" value="'.$prepago['s_precio'].'">';
		$dato = $dato.'<input type="hidden" id="p_nombre" value="'.$prepago['s_nombre'].'">';
		$dato = $dato.'<input type="hidden" id="p_duracion" value="'.$prepago['s_duracion'].'">';

		$dato = $dato.'<input onclick='."capturarvalor()".' type='."radio".' class='."capturar_valor".'   name='."deacuerdo".' value="'.$prepago['s_id'].'" recibe_id="'.$prepago['s_id'].'" recibe_precio="'.$prepago['s_precio'].'" recibe_nombre="'.$prepago['s_nombre'].'" recibe_duracion="'.$prepago['s_duracion'].'" required>';
		$dato = $dato.'<div class='."respuesta".'> </div>';
		$dato = $dato.'<span class='."checkmark".'  title="seleccionar y continuar" >seleccionar</span>';
		$dato = $dato.'</label>';
		$dato = $dato.'</div>';
		$dato = $dato.'</div>';
		$dato = $dato.'<br>';
		$dato = $dato.'</div>';
		$dato = $dato.'</div>';
		$dato = $dato.'</div>';
		
	}else{
		
		$dato = '';
			
	}
	$cuenta_prepagos2 ++;
	
}

echo $dato;

?>