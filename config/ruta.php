<?php
	/* Rutas universales */
    
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
        || $_SERVER['SERVER_PORT'] == 443) {

        // HTTPS
        $ruta_universal = "https://www.shifraspaandares.com.mx/";
        //BD server
        $bd_name='shifrasp_shifraspabd';
        $bd_user='shifrasp_user';
        $bd_pass='shifra2019*';


    } else {

        // HTTP
        $ruta_universal = "http://localhost/shifra/";
        // BD Local
        $bd_name='creactiv_shifra';
        $bd_user='root';
        $bd_pass='';
 
    }

    $ruta_universal_sistema = $ruta_universal."sistema/";

    $ruta_universal_calendario = $ruta_universal_sistema."calendario/";
    $citas_status=1;    
    /*
    * 
    **************************************
    *
    o = inactivo
    1 = activo
    *
    **************************************
    *
    */
   if ($citas_status==1) {
        /* Ruta citas activas*/
        $modal_cita="#Modal_formulario_cita";
        $modal_cita_individual="#Modal_formulario_cita_individual";

    }
    else{
        /* Ruta citas lanzamiento */
        $modal_cita="#Modal_formulario_cita_lanzamiento";
        $modal_cita_individual="#Modal_formulario_cita_lanzamiento";

    }

?>