<?php
session_start();
require_once('consulta.php');

$action = isset($_GET['a']) ? $_GET['a'] : null;
$tabla = isset($_GET['b']) ? $_GET['b'] : null;

if(isset($_GET['accion'])){
	$action = $_GET['accion'];
}

switch($action) {
    case 'get':
    	$consulta = new consulta();
    	if ($tabla != null) {
	        header('Content-Type: application/json');
	        print_r(json_encode($consulta->get($tabla)));
	    }
   	break;
   	case 'get_chat':
    	$consulta = new consulta();
    	if ($tabla != null) {
	        header('Content-Type: application/json');
	        print_r(json_encode($consulta->get($tabla)));
	    }
   	break;

    case 'crea_session':
    	$consulta = new consulta();
    	$consulta->crea_session();
   	break;
   	case 'get_cookie':
    	$consulta = new consulta();
    	if ($tabla != null) {
	        header('Content-Type: application/json');
	        print_r(json_encode($consulta->get($tabla)));
	    }
   	break;

    case 'valida_session':
        $session_valida = 0;
        if(isset($_SESSION["session_valida"])){
            if($_SESSION["session_valida"]==1){
                $session_valida = 1;
            }
        }
        echo $session_valida;
        
    break;


    case 'agrega_producto':
        $producto_id = $_POST["producto_id"];
        $cantidad = $_POST["cantidad"];

        if(!isset($_SESSION["productos"])){
            $productos = array();
            $productos[] = $_POST;

            $_SESSION["productos"] = serialize($productos);
            header('Content-Type: application/json');
            $salida = array('mensaje'=> 'producto agregado', 'n_productos'=> $cantidad);
            print_r(json_encode($salida));
            exit;
        }

        $productos = unserialize($_SESSION["productos"]);
        $productos[] = $_POST;

        $cantidad_completa = 0;
        foreach ($productos as $producto) {
            $cantidad_completa = $cantidad_completa + $producto["cantidad"];
        }

         $_SESSION["productos"] = serialize($productos);
        header('Content-Type: application/json');
        $salida = array('mensaje'=> 'producto agregado', 'n_productos'=> $cantidad_completa);
        print_r(json_encode($salida));
        exit;

        
    break;
    case 'remover_producto':
        // $producto_id = unset($_POST["producto_id"]);
        // $cantidad = unset($_POST["cantidad"]); 
    break;

    case 'get_comentarios':
        $consulta = new consulta();
        $conversacion_id = $_COOKIE['idConversacion'];
        $comentarios = $consulta->obten_comentarios($conversacion_id);


        
        
        

        foreach ($comentarios as $sms_chat){
    


            $descripcion = $sms_chat['descripcion'];
            $fecha = $sms_chat['fecha'];
            $conversacion_id = $sms_chat['conversacion_id'];
            $usuario_id=$sms_chat['usuario_id'];
            $usuario = $sms_chat['usuario'];



            if( $usuario_id=='-1'){
            ?> <div class="fondotxt">
                <span style="width: 90%; color: #000; "> <?php echo($descripcion); ?></span><br>
                <span style="font-size: 10px;"><?php echo($fecha); ?></span>
            </div><br>
            <?php
            }
            else{
                ?>
                <div class="fondotxt2">
                <span style="width: 90%; color: #000; "> <?php echo($descripcion); ?></span><br>
                <span style="font-size: 10px;"><?php echo($fecha." "); ?><p style="background: #95C11F; border-radius:30px; padding: 1%; display: inline-block; color: #000;"><?php echo($usuario); ?></p></span>
            </div><br>
            <?php
                
            }

            ?>

            
        <?php
        }



        break;


}

?>