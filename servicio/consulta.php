<?php
if (file_exists('../config/conexion.php')) {
      require_once('../config/conexion.php');
}else{
      require_once('./config/conexion.php');
}

class consulta {


    public function obten_productos_carrito($productos){
        $productos = unserialize($productos);

        $productos_append = array();

        foreach($productos as $key => $producto){
            $producto_id = $producto['producto_id'];
            $productos_append[$key]['producto_id'] = $producto['producto_id'];
            $productos_append[$key]['cantidad'] = $producto['cantidad'];
            $producto_result = $this->obten_producto_por_id($producto_id);
            $productos_append[$key]['foto'] = $producto_result[0]['foto'];
            $productos_append[$key]['descripcion'] = $producto_result[0]['descripcion'];


        }
        return $productos_append;

    }
    public function filtro_productos($filtro){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $consulta ="SELECT A.descripcion AS descripcion,
                            A.foto AS foto,
                            A.ancho_imagen AS ancho_imagen,
                            A.alto_imagen AS alto_imagen,
                            A.observaciones AS observaciones,
                            A.id AS id,
                            B.descripcion AS grupo_producto

                      FROM galeria_producto AS A
                      INNER JOIN galeria_grupo_producto AS B
                      ON B.id = A.galeria_grupo_producto_id
                      WHERE A.descripcion  LIKE  '%$filtro%'  ";
        $resultado = $link->query($consulta);
        $n_registros = $resultado->num_rows;

        echo $link->error;

        if($n_registros == 0){
            return false;
        }

        while( $row = mysqli_fetch_assoc( $resultado)){
            $new_array[] = $row;
        }
        return $new_array;


    }


     public function remover_productos_carrito($productos){
        $productos = unserialize($productos);

        $productos_append = array();

        foreach($productos as $key=>$producto){
            $producto_id = $producto['producto_id'];
            $productos_append[$key]['producto_id'] = $producto['producto_id'];
            $productos_append[$key]['cantidad'] = $producto['cantidad'];
            $producto_result = $this->obten_producto_por_id($producto_id);


            $productos_append[$key]['foto'] = $producto_result[0]['foto'];
            $productos_append[$key]['descripcion'] = $producto_result[0]['descripcion'];


        }


        return $productos_append;

    }




    public function obten_producto_por_id($id){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $consulta ="SELECT * FROM galeria_producto WHERE id='$id'";
// echo($consulta);
        $resultado = $link->query($consulta);
        $n_registros = $resultado->num_rows;

        if($n_registros == 0){
            return false;
        }

        while( $row = mysqli_fetch_assoc( $resultado)){
            $new_array[] = $row;
        }
        return $new_array;
    }

    public function obten_datos_por_correo($correo){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $consulta ="SELECT * FROM clientes WHERE c_electronico='$correo'";
// echo($consulta);
        $resultado = $link->query($consulta);
        $n_registros = $resultado->num_rows;

        if($n_registros == 0){
            return false;
        }

        while( $row = mysqli_fetch_assoc( $resultado)){
            $new_array[] = $row;
        }
        return $new_array;
    }
    public function valida_datos_usuario_facebook($correo){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $consulta ="SELECT * FROM clientes WHERE c_electronico='$correo'";
        $resultado = $link->query($consulta);
        $n_registros = $resultado->num_rows;

        if($n_registros == 0){
            return false;
        }

        while( $row = mysqli_fetch_assoc( $resultado)){
            $new_array[] = $row;
        }
        return $new_array;
    }

    public function valida_datos_usuario( $correo, $contrasena){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $consulta ="SELECT * FROM clientes WHERE c_electronico='$correo'";
        // echo($consulta);
        $resultado = $link->query($consulta);
        $n_registros = $resultado->num_rows;

        if($n_registros == 0){
            return false;
        }

        while( $row = mysqli_fetch_assoc( $resultado)){
            $new_array[] = $row;
        }
        return $new_array;
    }

    public function obten_fecha_espanol_mes($fecha){

        $fecha_separada = explode('-',$fecha);

        $mes_numero = $fecha_separada[1];
        $dia_separado = explode(' ',$fecha_separada[2]);

        $mes_texto = '';

        if($mes_numero=='01'){
            $mes_texto = 'Enero';
        }
        elseif ($mes_numero=='02'){
            $mes_texto = 'Febrero';
        }
        elseif ($mes_numero=='03'){
            $mes_texto = 'Marzo';
        }
        elseif ($mes_numero=='04'){
            $mes_texto = 'Abril';
        }
        elseif ($mes_numero=='05'){
            $mes_texto = 'Mayo';
        }
        elseif ($mes_numero=='06'){
            $mes_texto = 'Junio';
        }
        elseif ($mes_numero=='07'){
            $mes_texto = 'Julio';
        }
        elseif ($mes_numero=='08'){
            $mes_texto = 'Agosto';
        }
        elseif ($mes_numero=='09'){
            $mes_texto = 'Septiembre';
        }
        elseif ($mes_numero=='10'){
            $mes_texto = 'Octubre';
        }
        elseif ($mes_numero=='11'){
            $mes_texto = 'Noviembre';
        }
        elseif ($mes_numero=='12'){
            $mes_texto = 'Diciembre';
        }

        $fecha_espanol = $dia_separado[0].' de '.$mes_texto;
        return $fecha_espanol;

    }

    public function crea_session(){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;



        if(isset($_COOKIE['idConversacion'])){
            $conversacion_id = $_COOKIE['idConversacion'];

            $mensaje = $_POST["mensaje"];
            $consulta = "INSERT INTO comentario (conversacion_id,status,usuario_id,descripcion)
                            VALUES('$conversacion_id','1','-1','$mensaje')";
            $link->query($consulta);
            echo $link->error;
        }
        else{

            $consulta = "INSERT INTO conversacion (ip,session,status) values('111','-1','1')";
            $link->query($consulta);
            $id = $link->insert_id;
            setcookie('idConversacion',$id);
            echo $id;

        }

    }

    public function obten_servicios_general($grupo_servicios_id,$id ){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;
        $consulta = "SELECT s.id,s.nombre,s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,sgs.nombre,gs.nombre
                     from ((servicios as s left outer join subgrupo_servicios as sgs on sgs.id=s.subgrupo_servicios_id)
                                           left outer join grupo_servicios as gs on sgs.grupo_servicios_id=gs.id)
                                           where sgs.grupo_servicios_id=$grupo_servicios_id and sgs.id=$id";
        $resultado = $link->query($consulta);
        $servicios = array();
        foreach ($resultado as $servicio){
            $servicios[] = $servicio;
        }
        return $servicios;
    }

    public function obten_comentarios($conversacion_id){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;
        $consulta = "SELECT
                            comentario.descripcion as descripcion,
                            comentario.fecha as fecha,
                            comentario.conversacion_id as conversacion_id,
                            comentario.usuario_id as usuario_id,
                            ifnull(usuario.user,'') as usuario
                            FROM
                            comentario
                            LEFT JOIN usuario ON usuario.id = comentario.usuario_id
                            WHERE comentario.conversacion_id = $conversacion_id ORDER BY comentario.id DESC";
        $resultado = $link->query($consulta);



        $comentarios = array();


        foreach ($resultado as $comentario){
            $comentarios[] = $comentario;
        }
        return $comentarios;

    }

    public function get_usuario_cliente(){
    $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $consulta = "SELECT * FROM usuario_cliente ";




            $result = $link->query($consulta);
            $n_registros = $result->num_rows;

        if($link->error){
            return array('usuario'=>$link->error.''.$consulta, 'error'=>True);
        }
        $new_array = array();
        while( $row = mysqli_fetch_assoc( $result)){

            $row['nombre'] = "".substr($row['nombre'],0);
            $new_array[] = $row;
        }
        return $new_array;
    }
    public function obten_id_usuario($usuario_id){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;
        $consulta = "SELECT *FROM conversacion WHERE usuario_id = $usuario_id";
        $resultado = $link->query($consulta);

        $conversacion = array();



        foreach ($resultado as $conversacion){
            $comentarios[] = $conversacion;
        }
        return $conversacion;

    }


    public function get_chat($tabla){
    $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;


        $order = '';

        if($tabla == 'comentario'){
            // $order = ' ORDER BY galeria_producto.descripcion ASC';
        }

        $consulta = "SELECT * FROM $tabla  ORDER BY id DESC";


            $result = $link->query($consulta);
            $n_registros = $result->num_rows;

        if($link->error){
            return array('mensaje'=>$link->error.''.$consulta, 'error'=>True);
        }
        $new_array = array();
        while( $row = mysqli_fetch_assoc( $result)){

            $row['descripcion'] = "".substr($row['descripcion'],0);
            $new_array[] = $row;
        }
        return $new_array;
    }
    public function get_cookie($tabla){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;


        $order = '';

        if($tabla == 'comentario'){
            // $order = ' ORDER BY galeria_producto.descripcion ASC';
        }

         if(isset($_COOKIE['idConversacion'])){
            $conversacion_id = $_COOKIE['idConversacion'];

            $mensaje = $_POST["mensaje"];
            $consulta = "SELECT * FROM $tabla WHERE conversacion_id=$conversacion_id";


            $result = $link->query($consulta);
            $n_registros = $result->num_rows;
        }
        if($link->error){
            return array('mensaje'=>$link->error.''.$consulta, 'error'=>True);
        }
        $new_array = array();
        // while( $row = mysqli_fetch_assoc( $result)){

        //     $row['descripcion'] = "".substr($row['descripcion'],0);
        //     $new_array[] = $row;
        // }
        return $new_array;
    }

    public function obten_numero_productos(){
        $productos = unserialize($_SESSION["productos"]);

        $cantidad = 0;

        foreach ($productos as $producto) {
            $cantidad = $cantidad + $producto["cantidad"];
        }
        return $cantidad;

    }
    public function get($tabla, $limit=false, $campo_filtro=false,$dato_filtro=false){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $sql_limit = '';
        if($limit){
            $sql_limit = " LIMIT $limit" ;
        }

        $filtro = '';
        if($campo_filtro){
            $filtro = " AND $campo_filtro = $dato_filtro ";
        }
        $order = '';
        if($tabla == 'servicios'){
            $order = ' ORDER BY servicios.nombre ASC';
        }
        $consulta = "SELECT * FROM $tabla WHERE status = 1 $filtro $order $sql_limit";

         //if($tabla == 'comentario'){

           // $consulta = "SELECT * FROM $tabla" ;
        //}



        //$result = $link->query("SELECT * FROM $tabla WHERE status = 1");
            $result = $link->query($consulta);
            $n_registros = $result->num_rows;

        if($link->error){
            return array('mensaje'=>$link->error.' '.$consulta, 'error'=>True);
        }
        $new_array = array();
        while( $row = mysqli_fetch_assoc( $result)){
            // $row['nombre'] = "./sistema".substr($row['foto'],1);
            // $new_array[] = $row;
        }
        return $new_array;
    }


    public function registra_usuario(){
        require './lib/PHPMailerAutoload.php';
        require ("./lib/class.phpmailer.php");

        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;
        // $fecha = date("d/m/y",time());
        $consulta = "INSERT INTO clientes (nombre,archivo,telefono,c_electronico,contrasena,modo, status)
                            VALUES('".$_POST['nombre']."','views/clientes/archivos/men.jpg',
                            '".$_POST['telefono']."','".$_POST['c_electronico']."'
                            ,'".$_POST['contrasena']."','directo', '1')";
            $link->query($consulta);

            //===================================
            //  ENVIAR CORREO DE CONFIRMACION
            //===================================

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
            $mail->FromName = "Shifra Spa";
            //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
            // $mail->AddAddress("contacto@shifraspa.com.mx"); // Esta es la dirección a
            $mail->AddAddress("emanuel_arias@creactivmedia.com.mx");
            $mail->AddAddress($_POST['c_electronico']);

            $mail->IsHTML(true); // El correo se envía como HTML
            $mail->Subject = "Reguistro de usuario"; // Este es el titulo del email.

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
            $body = $body. '<p style="width:900px; font-size:18px; padding:5px; margin:0; background-color:#cccccc; color:#4D0000; text-align:center; font-family:Verdana, Geneva, sans-serif;">'.$_POST['nombre'].'';
            $body = $body. '</p>';
            $body = $body. '</td>';
            $body = $body. '</tr>';
            $body = $body. '<tr>';
            $body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
            $body = $body. '<p align="center" style="font-size:14px; padding-right:20px; color: #909090"><b>SHIFRA SPA agradece tu preferencia.</b><br><br>Este correo es para informarte acerca de la seguridad de tu informaci&oacute;n personal, tus datos est&aacute;n 100% seguros, somos una empresa comprometida con el bienestar de nuestros clientes. Te invitamos a revisar nuestras pol&iacute;ticas de privacidad y cookies.<br><br>
                        Tus datos personales son privados y nuestro objetivo es usarlas &uacute;nicamente para reservar tus citas,  notificarte nuestras promociones y regalos.<br><br>
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
            if(!$mail->Send()) {
            echo "Error al enviar: " . $mail->ErrorInfo;
            } else {

                if(!$link->error){
                    return True;
                }
                else{
                    return False;
                }
        }

    }

    public function registra_usuario_facebook(){

        // require './lib/PHPMailerAutoload.php';
        // require("./lib/class.phpmailer.php");

        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;
        // $fecha = date("d/m/y",time());
        $consulta = "INSERT INTO clientes (nombre,archivo,telefono,c_electronico,contrasena, modo, status)
                            VALUES('".$_POST['nombre']."','".$_POST['foto']."','','".$_POST['email']."'
                            ,'','facebook', '1')";

        $link->query($consulta);

        if(!$link->error){
            return True;
        }
        else{
            return False;
        }

    }

    public function moficar_usuario(){

        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $nombre   = $_POST['nombre_mod'];
        $telefono = $_POST['telefono_mod'];
        $email    = $_POST['c_electronico_mod'];
        $id       = $_POST['id_mod'];

        if (isset($nombre)) {

            $consulta ="UPDATE clientes SET  nombre='". $nombre."' WHERE id='".$id."'";

        }
        if (isset($telefono)) {

             $consulta ="UPDATE clientes SET  telefono='".$telefono."' WHERE id='".$id."'";

        }
        if (isset($email)) {

            $nuevo= mysqli_query($link,"SELECT COUNT(*) AS total FROM clientes WHERE c_electronico='".$email."'");
            $row=mysqli_fetch_object($nuevo);
            if($row->total > 0){
                header('Location: index?mensaje=registro_nomodificado');
            }
            else
            {

                    $consulta ="UPDATE clientes SET  c_electronico='".$email."' WHERE id='".$id."' AND ";

                    $_SESSION['c_electronico']=$email;

                }
            }
         if (isset($nombre) AND isset($telefono)) {

            $consulta ="UPDATE clientes SET  nombre='". $nombre."', telefono='".$telefono."' WHERE id='".$id."'";

        }

         if (isset($nombre) AND isset($telefono) AND isset($email)) {
            $nuevo= mysqli_query($link,"SELECT COUNT(*) AS total FROM clientes WHERE c_electronico='".$email."'");
            $row=mysqli_fetch_object($nuevo);
            if($row->total > 0){
                header('Location: index?mensaje=registro_nomodificado');
            }
            else
            {

                $consulta ="UPDATE clientes SET  nombre='". $nombre."', telefono='".$telefono."', c_electronico='".$email."' WHERE id='".$id."'";

                $_SESSION['c_electronico']=$email;

            }
        }

        $link->query($consulta);

        if(!$link->error){

            return True;
        }
        else{

            return False;
        }
    }
    public function _formatear($fecha){

        return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;

    }

    public function registra_cita(){
        require_once "../config/ruta.php";
        require_once ("../lib/PHPMailerAutoload.php");
        require_once ("../lib/class.phpmailer.php");
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;
        $ruta_base = $ruta_universal_calendario;

        $date= date('Y-m-j H:i:s');
        $fecha = strtotime ( '-6 hour' , strtotime ($date) ) ;
        $fecha = date ( 'Y-m-j H:i:s' , $fecha);

        $Hora_f= $_POST['horaCita'];
        $hora_final = strtotime ( '-0 hour' , strtotime ($Hora_f) ) ;
        $hora_final = strtotime ( '+ '.$_POST['duracion'].' minute' , $hora_final ) ;
        $hora_final_o = date ( 'H:i' , $hora_final);

        $start=$_POST['diaCita'].' '.$_POST['horaCita'];
        $end=$_POST['diaCita'].' '.$hora_final_o;

        $inicio =_formatear($start);
        // y la formateamos con la funcion _formatear
        $final = _formatear($end);

        $consulta = "INSERT INTO control_citas (servicio_id, nombre_servicio, precio, duracion, fecha, hora_inicio, hora_fin, cliente_id, nombre_usuario, email, telefono, opcion_pago, total, fecha_operacion, title, start, end, url, empleados_id, nombre_empleado, nombre_cabina, rfc, razon_social, cfdi, status)
                    VALUES('".$_POST['id_servicio']."',
                           '".$_POST['n_servicio']."',
                           '".$_POST['precio']."',
                           '".$_POST['duracion']."',
                           '".$_POST['diaCita']."',
                           '".$start."',
                           '".$end."',
                           '".$_POST['idCliente']."',
                           '".$_POST['nomCliente']."',
                           '".$_POST['email']."',
                           '".$_POST['telefono']."',
                           '".$_POST['opcionPago']."',
                           '".$_POST['precio']."',
                           '".$fecha."',
                           '".$_POST['n_servicio']."',
                           '".$inicio."',
                           '".$final."',
                           '',
                           '1',
                           'empleado 1',
                           'cabina 1',
                            '".$_POST['rfc']."',
                           '".$_POST['razonSocial']."',
                           '".$_POST['cfdi']."',
                           '1')";

        $link->query($consulta);

         // Obtenemos el ultimo id insetado
        $im=$link->query("SELECT MAX(id) AS id FROM control_citas");
        $row = $im->fetch_row();
        $id = trim($row[0]);

        // para generar el link del evento
        $links = "".$ruta_base."descripcion_evento.php?id=$id";


        // y actualizamos su link
        $query="UPDATE control_citas SET url = '$links' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $link->query($query);

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
		$mail->From = "contacto@shifraspaandares.com.mx"; // Desde donde enviamos (Para mostrar)
		// $mail->From = "element.earias20@gmail.com"; // Desde donde enviamos (Para mostrar)
		$mail->FromName = "ShifraSpa";
		//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
		// $mail->AddAddress("contacto@shifraspa.com.mx"); // Esta es la dirección a
		$mail->AddAddress("emanuel_arias@creactivmedia.com.mx");
		$mail->AddAddress($_POST["email"]);

		$mail->IsHTML(true); // El correo se envía como HTML
		$mail->Subject = "Sistema de citas ShifraSpa"; // Este es el titulo del email.
		$mail->AddEmbeddedImage($ruta_universal.'img/logo_blanco.png', 'logo_blanco');

		$body = '<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:800px; font-family:Verdana, Geneva, sans-serif;">';
		$body = $body. '<caption style="background-color:#400400; color: #fff; font-size: 12px;"><p><b>Asunto:</b>'.$_POST["n_servicio"].' agendado.</p></caption>';
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
		$body = $body. '<p style="font-size:14px; padding-right:20px; "><b>&nbsp;&nbsp;Nombre del servicio:&nbsp;</b>'.$_POST["n_servicio"].'</p>';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Dia:&nbsp;</b>'.$_POST["diaCita"].'</p>';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Hora :&nbsp;</b>'.$_POST["horaCita"].'</p>';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Duraci&oacute;n :&nbsp;</b>'.$_POST["duracion"] .' min</p>';
		$body = $body. '</td>';
		$body = $body. '</tr>';
		$body = $body. '<tr>';
		$body = $body. '<td>';
		$body = $body. '<p style="font-size:16px; font-weight: 900; margin:0; padding:5px; background-color:#cccccc; color:#4D0000; text-align:center;">Informaci&oacute;n del cliente</p>';
		$body = $body. '</td>';
		$body = $body. '</tr>';
		$body = $body. '<tr>';
		$body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Nombre:&nbsp;</b>'.$_POST["nomCliente"].'</p> ';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Telefono:&nbsp;</b>'.$_POST["telefono"].'</p>';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Correo:&nbsp;</b>'.$_POST["email"].'</p>';
		$body = $body. '</td>';
		$body = $body. '</tr>';
		$body = $body. '<tr>';
		$body = $body. '<td>';
		$body = $body. '<p style="font-size:16px;  font-weight: 900; margin:0; padding:5px; background-color:#cccccc; color:#4D0000; text-align:center;">Informaci&oacute;n del pago</p>';
		$body = $body. '</td>';
		$body = $body. '</tr>';
		$body = $body. '<tr>';
		$body = $body. '<td style="padding:15px; background-color:#dddddd40;">';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Forma de pago:&nbsp;</b> '.$_POST["opcionPago"].'</p>';
		$body = $body. '<p style="font-size:14px; padding-right:20px;"><b>&nbsp;&nbsp;Total pagado:&nbsp;</b> $'.$_POST["precio"].'</p>';
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
						Por medio de la presente yo:<span style=" font-size:13px; text-decoration: underline; text-transform: uppercase; font-weight: 900;">&nbsp;'.$_POST["nomCliente"].'&nbsp;</span> certifico que he manifestado la verdad y adem&aacute;s estoy ampliamente informado (a) del diagn&oacute;stico y plan de tratamiento, as&iacute; como de las modificaciones que se juzgan necesarias para el mejoramiento del mismo.';
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
						<b>Fecha de operaci&oacuten:</b> '.date("d/m/y",time()).'<br>';
		$body = $body. '</p>';
		$body = $body. '</td>';
		$body = $body. '</tr>';
		$body = $body. '</tbody>';
		$body = $body. '</table>';
		$mail->Body = $body; // Mensaje a enviar

		if(!$mail->Send()) {

			echo "Error al enviar: " . $mail->ErrorInfo;

		} else {

            if(!$link->error){
                return True;
            }
            else{
                return False;
            }

		}

    }

    public function valida_Login(){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;
        $correo=$_POST['c_electronico'];
        $contrasena=$_POST['contrasena'];
        $consulta = "SELECT * FROM clientes WHERE c_electronico='$correo'  AND contrasena='$contrasena'";
        // print_r($link->error);
        $resultadoConsulta=$link->query($consulta);
        $row=$resultadoConsulta->fetch_array(MYSQLI_ASSOC);
        // print_r($correo);
        // print_r($contrasena);
        // printf("%s %s", $row['correo_electronico'], $row['contrasena']);
        // print_r($resultadoConsulta);
            if(!$link->error){
                return True;
            }
            else{
                return False;
            }

    }
    public function obten_usuario_cliente($tabla, $limit=false, $campo_filtro=false,$dato_filtro=false){
        $conexion = new Conexion();
        $conexion->selecciona_base_datos();
        $link = $conexion->link;

        $sql_limit = '';
        if($limit){
            $sql_limit = " LIMIT $limit" ;
        }

        $filtro = '';
        if($campo_filtro){
            $filtro = " AND $campo_filtro = $dato_filtro ";
        }
        $order = '';

        $consulta = "SELECT * FROM $tabla WHERE status = 1 $filtro $order $sql_limit";

         //if($tabla == 'comentario'){

           // $consulta = "SELECT * FROM $tabla" ;
        //}

        //$result = $link->query("SELECT * FROM $tabla WHERE status = 1");
        $result = $link->query($consulta);
        $n_registros = $result->num_rows;

        if($link->error){
            return array('mensaje'=>$link->error.' '.$consulta, 'error'=>True);
        }
        $new_array = array();
        while( $row = mysqli_fetch_assoc( $result)){

            $new_array[] = $row;
        }
        return $new_array;
    }
}

?>