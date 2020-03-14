<?php
require_once ('../servicio/consulta.php');
$datos = new consulta();
$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;

$num = $_POST["numFolioCantidad"];



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
$prepagos_cantidad = mysqli_query($link, "SELECT c.id AS 'c_id', 
    c.nombre AS 'c_nombre', 
    c.c_electronico AS 'c_c_electronico', 
    p.id AS 'p_id', 
    p.clientes_id AS 'p_clientes_id', 
    p.tipo_prepago_id AS 'p_tipo_prepago_id',
    p.categoria_prepago_id AS 'p_categoria_prepago_id',
    pc.prepagos_id AS 'pc_prepagos_id', 
    pc.folio AS 'pc_folio', 
    pc.cupon AS 'pc_cupon', 
    pc.cantidad AS 'pc_cantidad'
    FROM ((clientes AS c 
    LEFT OUTER JOIN prepagos p ON p.clientes_id=c.id)
    LEFT OUTER JOIN prepagos_cantidad pc ON pc.prepagos_id=p.id) 
    WHERE p.tipo_prepago_id=1
    AND pc.folio='$num';");

$cadena = "";
$dato = '';
$cuenta_prepagos2 = 1;
$tipo_prepago='';
$categoria_prepago='';

foreach ($prepagos_cantidad as $prepago){

    $folio = $prepago['pc_folio'];
	
    if($prepago['p_tipo_prepago_id']==1){

        $tipo_prepago='En monedero';

    }
    if($prepago['p_tipo_prepago_id']==2){

        $tipo_prepago='Servicio';

    }
    if($prepago['p_categoria_prepago_id']==1){

        $categoria_prepago='Expediente Prepago';

    }
    if($prepago['p_categoria_prepago_id']==2){

        $categoria_prepago='Certificado Regalo';

    }
    if($prepago['p_categoria_prepago_id']==3){

        $categoria_prepago='Certificado Cortesía';

    }

	if($num == $folio){
  
        $dato=' <div class="col-md-4 tajeta_prepago">
         <div class="card">
            <div class="card-body">
                <h4 class="card-title">'.$categoria_prepago.'</h4>
                <p class="card-text">'.$tipo_prepago.'</p>
                <h3>$'.$prepago['pc_cantidad'].'.00</h3>         
            </div>
            <input type="hidden" id="envia_cantidad" value='.$prepago['pc_cantidad'].' >
        
            <a onclick="aplicarcupon()" class="btn btn_format_personal btn-default disabled">Usar
                Ahora</a>
        </div>  
        </div>
        ';
        
	}else{  
		
		$dato = '';
			
    }
    
	$cuenta_prepagos2 ++;
	echo $dato;
}

?>

