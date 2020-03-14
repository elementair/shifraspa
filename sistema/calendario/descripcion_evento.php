<?php

/**
**
**  BY iCODEART
**
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/
date_default_timezone_set("America/Mexico_City");

    
    //incluimos nuestro archivo config
    include 'config.php'; 

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';

    // Obtenemos el id de de la cita.
    $id  = $_GET['id'];

    // y lo buscamos en la base de dato
    // $bd  = $conexion->query("SELECT id, nombre_servicio, nombre_usuario, hora_inicio, hora_fin  FROM control_citas WHERE id=5");

    // Obtenemos los datos
    // $row = $bd->fetch_row_assoc();


    $bd = "SELECT id, nombre_servicio, nombre_usuario, hora_inicio, hora_fin, total, nombre_empleado, nombre_cabina FROM control_citas WHERE id=$id";

    if ($resultado = $conexion->query($bd)) {

        /* obtener un array asociativo */
        while ($row = $resultado->fetch_assoc()) {
        // printf ("%s (%s)\n", $row["nombre_servicio"], $row["id"]);

            // titulo 
            $titulo=$row['nombre_servicio'];

            // cuerpo
            $evento='</br><b class="linea">Cliente: </b><span class="linea1">'.$row['nombre_usuario'].'</span></br><b class="linea">Empleado: </b><span class="linea1">'.$row['nombre_empleado'].'</span></br><b class="linea">Cabina: </b><span class="linea1">'.$row['nombre_cabina'].'</span>';

            $h_inicio =explode(" ",$row['hora_inicio']);
            
            $horai = date($h_inicio[1],time() - 3600*date('I')); 
            // Fecha inicio
            $fecha = $h_inicio[0].'</br>';
            $inicio=$horai.'</br>';


            
                                            



            $h_fin =explode(" ",$row['hora_fin']);

            $horaf = date($h_fin[1],time() - 3600*date('I')); 

            // Fecha Termino
            $final=$horaf;


            }
            /* liberar el conjunto de resultados */
            $resultado->free();
        }

        // Eliminar evento
        if (isset($_POST['eliminar_evento'])) 
        {
            $id  = $_GET['id'];
            $sql = "DELETE FROM control_citas WHERE id = $id";
            if ($conexion->query($sql)) 
            {
                echo "Evento eliminado";
            }
            else
            {
                echo "El evento no se pudo eliminar";
            }
        }
     ?>



<div class="contenedor_cita_modal">
  <div class="container">
    <div class="fila">
    <div class="titulo"><?=$titulo?></div>
    <hr>
    <div class="desc_inicio">Cita agendada para el:</div>
      <div class="columna ">Dia</div>
      <div class="columna">Inicio</div>
      <div class="columna">Fin</div>
    </div>   
    <div class="fila">
      <div class="columna "><?=$fecha?></div>
      <div class="columna"><?=$inicio?></div>
      <div class="columna"><?=$final?></div>
    </div>
    <div class="fila">
    <div class="desc_inicio">Informe de atencion al cliente:</div>
    
     <?=$evento?>
        
   
    
    </div>  
    
  </div>
</div>

       
<style>

.fila{
  display:inline-block;
  width:90%;
  margin-left:5%;
  margin-right:5%;
  padding:5px 0px;
}
.titulo{
  font-size:25px;
  font-style:bold;
  padding:5px;
  text-align:center;
  color: #4D0000;
}
hr{
  border:2px solid #f3f3f3;
}
.linea{
  display:inline-block;
  width:47%;
  padding:5px;
  color:#000;
  font-size:15px;
  text-align:right;
  border:1px solid #f3f3f3;
  background-color: #f3f3f3;

}

.linea1{
  display:inline-block;
  width:47%;
  padding:5px;
  color:#000;
  font-size:15px;
  text-align:left;
  border:1px solid #f3f3f3;
  background-color: #f3f3f3;

}
.desc_inicio{
  font.size:14px;
  padding:5px;
}
.columna{
  display:inline-block;
  width:30%;
  padding:5px;
  color:#000;
  font-size:15px;
  text-align:center;
  border:1px solid #f3f3f3;
  background-color: #f3f3f3;

}
.contenedor_cita_modal{
  width:100%;
  display:inline-block;
  font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
}
ul li{
  list-style:none;
}
@media only screen and (max-width: 520px) {
.fila{
  display:inline-block;
  width:100%;
  margin-left:0%;
  margin-right:0%;
  padding:2px 0px;
}
.columna{
  width:26%;
  padding:2px;
  color:#000;
  font-size:12px;
  

}
.linea{
  
  width:35%;
  padding:2px;
  color:#000;
  font-size:12px;

}

.linea1{

  width:40%;
  padding:2px;
  color:#000;
  font-size:12px;
  
 

}
}

</style>
