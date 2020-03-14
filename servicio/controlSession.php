<?php
/**
 * Created by PhpStorm.
 * User: Emanuel
 * Date: 04/10/2018
 * Time: 04:41 PM
 */

/**********************************************************************************
 * INGRESAR
 **********************************************************************************/
$_SESSION['session_valida'] = 0;
$id_cliente = '';
$nombre_cliente = '';
$c_electronico = '';
$c_electronico_cliente = '';
$telefono_cliente = '';
$modo_cliente = '';
$res_id = "";

if (isset($_POST['btnEntrar'])) {
    // error_reporting(0);
    if (!isset($_POST["c_electronico"])) {
        $CORREO = "";
    } else {
        $CORREO = $_POST['c_electronico'];
    }
    if (!isset($_POST["contrasena"])) {
        $PASSWORD = "";
    } else {
        $PASSWORD = $_POST['contrasena'];
    }
    $valida = $datos->valida_datos_usuario($CORREO, $PASSWORD);

    foreach ($valida as $validaDatos) {
    }
    if (!empty($_POST)) {

        if (isset($_POST["c_electronico"]) && isset($_POST["contrasena"])) {

            if ($_POST["c_electronico"] != "" && $_POST["contrasena"] != "") {

                if ($_POST["c_electronico"] == $validaDatos['c_electronico'] && $_POST["contrasena"] == $validaDatos['contrasena']) {
                    $_SESSION['session_valida'] = 1;
                    $_SESSION['c_electronico'] = $_POST["c_electronico"];



                    if ($_SESSION['session_valida'] = 1) {
                        $clientes = mysqli_query($link, 'SELECT id, nombre, c_electronico, telefono, modo, status 
                        FROM clientes WHERE c_electronico="' . $_SESSION['c_electronico'] . '"');


                        foreach ($clientes as $cliente) {
                            $id_cliente = $cliente['id'];
                            $nombre_cliente = $cliente['nombre'];
                            $c_electronico_cliente = $cliente['c_electronico'];
                            $telefono_cliente = $cliente['telefono'];
                            $modo_cliente = $cliente['modo'];
                        }
                        $res_id = $id_cliente;
                        $res_nombre = $nombre_cliente;
                        $res_email = $c_electronico_cliente;
                        $res_phone = $telefono_cliente;

                        // echo "myFunction()";
                    } else {
                        $MJEerror = '<center><div class="alert alert-warning">no has iniciado sesion</div></center>';
                        $res_id = "";
                        $res_nombre = "";
                        $res_email = "";
                        $res_phone = "";
                    }
                } else {
                    $m_error = " Los datos son incorrectos :(";
                    header('Location: index.php?mensaje=usuario_invalido');
                }
                // $m_error=$valida['correo_electronico'];
            } else {

                // $m_error=$valida['c_electronico']	;

                // header('Location: index.php');

            }
        }
    }
}


/**********************************************************************************
 * RECUPERAR CONTRASEÑA
 **********************************************************************************/

else if (isset($_POST['btnRecuperar'])) {
    include "consultaPassword.php";
}

/**********************************************************************************
 * REGISTRAR
 **********************************************************************************/

else if (isset($_POST['btnReguistra'])) {
    // Comprobamos si el email esta registrado

    $nuevo = mysqli_query($link, "SELECT COUNT(*) AS total FROM clientes WHERE c_electronico='" . $_POST['c_electronico'] . "'");
    $row = mysqli_fetch_object($nuevo);
    if ($row->total > 0) {
        header('Location: index.php?mensaje=registro_noaceptado');
    } else {
        $nuevo = $datos->registra_usuario();
        header('Location: index.php?mensaje=registro_aceptado');
        $_SESSION['session_valida'] = 1;
        $_SESSION['c_electronico'] = $_POST["c_electronico"];



        if ($_SESSION['session_valida'] = 1) {
            $clientes = mysqli_query($link, 'SELECT id, nombre, c_electronico, telefono, modo, status FROM clientes WHERE c_electronico="' . $_SESSION['c_electronico'] . '"');


            foreach ($clientes as $cliente) {
                $id_cliente = $cliente['id'];
                $nombre_cliente = $cliente['nombre'];
                $c_electronico_cliente = $cliente['c_electronico'];
                $telefono_cliente = $cliente['telefono'];
                $modo_cliente = $cliente['modo'];
            }
            $res_id = $id_cliente;
            $res_nombre = $nombre_cliente;
            $res_email = $c_electronico_cliente;
            $res_phone = $telefono_cliente;

            // echo "myFunction()";
        } else {

            $MJEerror = '<center><div class="alert alert-warning">no has iniciado sesion</div></center>';

            $res_nombre = "";
            $res_email = "";
            $res_phone = "";
            $res_id = "";
        }
    }
}


/**********************************************************************************
 * MODIFICAR
 **********************************************************************************/

else if (isset($_POST['btnModifica'])) {
    $clientes = mysqli_query($link, 'SELECT id FROM clientes WHERE c_electronico="' . $_SESSION['c_electronico'] . '"');

    foreach ($clientes as $cliente) {
        $id_cliente = $cliente['id'];
    }

    if ($id_cliente == $_POST['id_mod']) {

        $nuevo = $datos->moficar_usuario();
        header('Location: index?mensaje=registro_modificado');
    } else {

        header('Location: index?mensaje=registro_nomodificado');
    }
}

/**
 * REGISTRAR CITA BD
 **/

/**********************************************************************************
 * SALIR
 **********************************************************************************/

else if (isset($_POST['btnSalir'])) {
    // $mensaje = "Estas seguro";

    $_SESSION['session_valida'] = -1;
    $_SESSION['c_electronico'] = -1;
    unset($_SESSION['index']);
    header("Location: index.php");
}

/**********************************************************************************
 * VALIDACIONES ACEPTADAS
 **********************************************************************************/

if (isset($_GET['mensaje'])) {
    if ($_GET["mensaje"] == "password_enviado") {

        $mensaje = "Tu contraseña ha sido enviada a tu correo.";
    } else if ($_GET["mensaje"] == "registro_aceptado") {

        $mensaje = "Tu registro ha sido aceptado.";
    } else if ($_GET["mensaje"] == "registro_noaceptado") {

        $mensaje = "El correo ya existe.";
    } else if ($_GET["mensaje"] == "usuario_invalido") {

        $mensaje = "Los datos son incorrectos";
    } else if ($_GET["mensaje"] == "registro_modificado") {

        $mensaje = "Tu registro ha sido modificado.";
    } else if ($_GET["mensaje"] == "cita_ajendada") {

        $mensaje = "Tu cita se hiso exitosamente. revisa tu correo, te hemos mandado un correo.";
    } else if ($_GET["mensaje"] == "registro_nomodificado") {

        $mensaje = "Tu registro no pudo ser modificado, intentelo mas tarde.";
    }
}

/**********************************************************************************
 * VALIDACIONES SESSION
 **********************************************************************************/

if (isset($_SESSION['session_valida'])) {

    if ($_SESSION['session_valida'] == 1) {
        $etiqueta = "VER MI PERFIL";
        $archivo_cliente = '';
        $SesionModal = "#Modal_salir";
        if (isset($_SESSION['c_electronico'])) {


            $clientes = mysqli_query($link, "SELECT id, nombre, archivo, c_electronico, telefono, modo, fecha FROM clientes WHERE c_electronico='" . $_SESSION['c_electronico'] . "'");




            foreach ($clientes as $cliente) {
                $id_cliente = $cliente["id"];
                $nombre_cliente = $cliente["nombre"];
                $c_electronico_cliente = $cliente["c_electronico"];
                $telefono_cliente = $cliente["telefono"];
                $archivo_cliente = $cliente["archivo"];
                $modo_cliente = $cliente["modo"];
            }
        }
        if ($modo_cliente == 'directo') {
            $img_inicio_ruta = "img/svg/icono_salir.svg";
        } else {
            $img_inicio_ruta = $archivo_cliente;
        }

        $usuario_session = 'usuario_session_logeado';
        $usuario = 'usuario_logeado';
        $res_id = $id_cliente;
        $res_nombre = $nombre_cliente;
        $res_email = $c_electronico_cliente;
        $res_phone = $telefono_cliente;
        $MJEerror = '<center><div class="alert alert-success"> Te damos la bienvenida ' . $res_nombre . ' </div></center>';
    } else {
        $usuario_session = 'usuario_session';
        $usuario = 'usuario';
        $MJEerror = '<center><div class="alert alert-warning">No has iniciado sesión</div></center>';
    }
}
