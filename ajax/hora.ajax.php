<?php
session_start();
require_once ('../servicio/consulta.php');
$datos = new consulta();
$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;
/* php comment
|
|====================================================
|
|   Obtenemos los datos de los input
|
|====================================================
|
*/
$id = $_POST['id'];
$Dia= $_POST['dia'];
$obtener_id = $id;
$obtener_fecha = $Dia;
// ej: $obtener_fecha = 19/06/2019

/* php comment
|
|====================================================
|
|   DEFINIMOS UN ARRAY PARA TRADUCIR DIAS
|
|====================================================
|
*/
$array_dias['Sunday']   = "domingo";
$array_dias['Monday']   = "lunes";
$array_dias['Tuesday']  = "martes";
$array_dias['Wednesday']= "miercoles";
$array_dias['Thursday'] = "jueves";
$array_dias['Friday']   = "viernes";
$array_dias['Saturday'] = "sabado";
/* php comment
|
|====================================================
|
|   Cambiamos formato de la fecha
|
|====================================================
|   obtenemos día actual y  remplazarlo con el día 
|   correspondiente en español EJEMPLO:(19/06/2019 = 19-06-2019)
*/
$fecha = str_replace("/", "-", $obtener_fecha);

$obtener_dia_letra= $array_dias[date('l', strtotime($fecha))];
//EJEMPLO:  (19-06-2019 = Monday & Monday = miercoles)

/* php comment
|
|====================================================
|
|   obtener lista de empleados para X servicio
|
|====================================================
|    disponibles en el dia seleccionado
*/
$empleados=mysqli_query($link,"SELECT 	s.id AS 's_id', 
    s.nombre AS 's_nombre', 
    s.duracion AS 's_duracion', 
    e.descripcion AS 'e_descripcion', 
    e.id AS 'e_id', 
    e.nombre AS 'e_nombre', 
    e.status AS 'e_status', 
    er.entrada AS 'er_entrada', 
    er.salida AS 'er_salida', 
    er.lunes AS 'lunes',
    er.martes AS 'martes', 
    er.miercoles AS 'miercoles',  
    er.jueves AS 'jueves', 
    er.viernes AS 'viernes',  
    er.sabado AS 'sabado', 
    er.domingo AS 'domingo' 
    from(((servicios as s 
    left outer join servicios_empleados as ss on s.id=ss.servicios_id)
    left outer join empleados as e on e.id=ss.empleados_id)
    left outer join empleados_rol as er on er.empleados_id=e.id) 
    WHERE  e.status=1 
    AND servicios_id=".$obtener_id." 
    AND ".$obtener_dia_letra."= 1");

$intervalo_duracion=0;

foreach ($empleados as $empleado) {

    $nombre_empleado = $empleado['e_nombre'];
    $estado_empleado = $empleado['e_status'];
    $servicio_duracion = $empleado['s_duracion'];

    if ($estado_empleado == 1) {
     /*==============================================================
        En esta seccion se identifican los empleados que estan activos
        (pueden brindar el servicio y asisten el dia seleccionado.)
     ==============================================================*/
    //  print_r($nombre_empleado);
     
    }

}

/*==============================================================
                        VARIABLES A LLENAR
==============================================================*/
$capsula_select = '';
$empleado_seleccionado = "";
$intervalo_duracion = $servicio_duracion;


function intervaloHora($hora_inicio, $hora_fin, $intervalo_duracion) {

    $inter = $intervalo_duracion;
    $intervalo= $inter;
    $hora_inicio = new DateTime( $hora_inicio);
    $hora_fin    = new DateTime( $hora_fin);
    $hora_fin->modify('+1 second'); // Añadimos 1 segundo para que nos muestre $hora_fin
    $array_final = [];
        // Si la hora de inicio es superior a la hora fin
        // añadimos un día más a la hora fin
    if ($hora_inicio > $hora_fin) {

        $hora_fin->modify('+1 day');

    }
    // Establecemos el intervalo en minutos
    $intervalo = new DateInterval('PT'.$intervalo.'M');
    // Sacamos los periodos entre las horas
    $periodo   = new DatePeriod($hora_inicio, $intervalo, $hora_fin);
    foreach($periodo as $hora ) {
        // Guardamos las horas intervalos
        $horas[] =  $hora->format('g:i a');
    }
    return $horas;
    }

    /*==============================================================
                            DEFINIR HORA DE INICIO
    ==============================================================*/
    $rol_entrada=mysqli_query($link,"SELECT s.id AS 'sid', s.nombre AS 'snombre', s.duracion, e.id AS 'eid', e.nombre AS 'enombre', min(er.entrada) AS 'entrada', er.salida AS 'salida', er.lunes, er.martes, er.miercoles,  er.jueves, er.viernes,  er.sabado, er.domingo from(((servicios as s
            left outer join servicios_empleados as ss on s.id=ss.servicios_id)
            left outer join empleados as e on e.id=ss.empleados_id)
            left outer join empleados_rol as er on er.empleados_id=e.id) WHERE e.status=1 AND servicios_id=".$obtener_id." AND ".$obtener_dia_letra."= 1");

    foreach ($rol_entrada as $entrada) {
        // echo '<option>'.$empleado['entrada'];'</option>';
    }

    /*==============================================================
                            DEFINIR HORA DE SALIDA
    ==============================================================*/
    $rol_salida=mysqli_query($link,"SELECT s.id AS 'sid', s.nombre AS 'snombre', s.duracion, e.id AS 'eid', e.nombre AS 'enombre', er.entrada AS 'entrada', max(er.salida) AS 'salida', er.lunes, er.martes, er.miercoles,  er.jueves, er.viernes,  er.sabado, er.domingo from(((servicios as s
            left outer join servicios_empleados as ss on s.id=ss.servicios_id)
            left outer join empleados as e on e.id=ss.empleados_id)
            left outer join empleados_rol as er on er.empleados_id=e.id) WHERE e.status=1 AND servicios_id=".$obtener_id." AND ".$obtener_dia_letra."= 1");

    foreach ($rol_salida as $salida) {
        // echo '<option>'.$empleado['entrada'];'</option>';
    }
    // $entrada['entrada'] =  $salida->format('g:i a');
    // $salida['salida']= $salida->format('g:i a');
    // $recibe_h_inicio=$entrada['entrada'];
    // $recibe_h_fin=$salida['salida'];  
    
    
    // $dateEntrada = $entrada['entrada'];

    

    // $dateEntrada->format('g:i a');

    // $dateSalida = $salida['salida'];
   
    $recibe_h_inicio=$entrada['entrada'];
    $recibe_h_fin=$salida['salida'];
    // $dateSalida->format('g:i a');

    $array=(intervaloHora($recibe_h_inicio , $recibe_h_fin, $intervalo_duracion));
    /**===============================
    ==saco el numero de elementos==
    ===============================**/
    $longitud = count($array);

    //estado de get_shortcode_atts_regex();

    $estado='';
    /**===============================
    ==generamos consulta de empleados.==
    ===============================**/

    $contador=0;
    // $obtener_fecha = '20/02/2019';

    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++){

    //saco el valor de cada elemento
    /*==============================================================
            ROL DESCANSO, comprobar y bloquer horario de manera dinamica.
    ==============================================================*/
    $rol_descanso = mysqli_query($link,"SELECT 
            s.id AS 'sid',
            s.nombre AS 'snombre', 
            s.duracion, 
            e.id AS 'eid', 
            e.nombre AS 'enombre', 
            er.entrada AS 'entrada', 
            er.salida AS 'salida',
            er.descanso AS 'descanso', 
            er.duracion AS 'erduracion', 
            er.lunes AS 'lunes', 
            er.viernes AS 'viernes' 
        FROM(((servicios as s
        left outer join servicios_empleados as ss on s.id=ss.servicios_id)
        left outer join empleados as e on e.id=ss.empleados_id)
        left outer join empleados_rol as er on er.empleados_id=e.id) 
        WHERE e.status=1 
        AND servicios_id=".$obtener_id." 
        AND ".$obtener_dia_letra."= 1");
            

    $citas_ocupados = mysqli_query($link,'SELECT 
            empleados_id, 
            nombre_empleado, 
            fecha, 
            hora_inicio, 
            hora_fin, 
            duracion 
        FROM control_citas 
        WHERE fecha="'.$obtener_fecha.'"');

    // HORAS OCUPADAS DE LOS EMPLEADOS

    $capsula_select='<select name="booking_treatment" class="form-control hora" required aria-required="true">';

    foreach ($rol_descanso as $key1oc =>  $empleado) {

            // echo '<option>f1('.$empleado['enombre'].')</option>';
            foreach ($citas_ocupados as $key2oc => $ocupados) {

                $h_inicio1 = explode(" ",$ocupados['hora_inicio']);
                $h_fin1 = explode(" ",$ocupados['hora_fin']);

                $iniciof1= $h_inicio1[1];
                $finf1= $h_fin1[1];
                
                switch ($key2oc) {

                    case $key1oc:

                    if ($key2oc !== $key1oc ){

                        // echo '<option>'.$empleado['enombre'].$ocupados['nombre_empleado'].'son iguales</option>';
                        if($empleado['eid'] == $ocupados['empleados_id']){
                            // echo '<option>'.$empleado['enombre'].$ocupados['nombre_empleado'].'son iguales</option>';


                                if($array[$i]>=$iniciof1  AND $array[$i]<$finf1){
                                    // echo '<option>true</option>';
                                    $estado='disabled title="Este horario no está disponible." style="color:red;"';

                                }else{

                                    $estado='';

                                }
                                continue;
                                
                        }else{
                            // echo '<option>'.$empleado['enombre'].$ocupados['nombre_empleado'].'no son iguales</option>';

                            if($array[$i]>=$iniciof1  AND $array[$i]<$finf1){
                                $estado='disabled title="Este horario no está disponible." style="color:red;"';
                            }else{

                                $estado='';
                            }
                            break 3;
                            // exit();
                        }

                    }else{
                        // echo "<option >salio un chango que esta desocupado</option>";
                        // echo '<option>'.$empleado['enombre'].$ocupados['nombre_empleado'].'son iguales</option>';
                        if($array[$i]>=$iniciof1  AND $array[$i]<$finf1){
                            // echo '<option>true</option>';
                            $estado='disabled title="Este horario no está disponible." style="color:red;"';
                        }else{
                            $estado='';
                        }
                        continue;
                        // echo "<option  value=".$array[$i].">aqui no paso nada</option>";
                    }
                    default:

                    if( $iniciof1 !== $empleado['entrada'] AND  $empleado['entrada'] < $iniciof1){
                        // if(isset($ocupados['nombre_empleado'])){
                        // echo '<option>'.$empleado['enombre'].$ocupados['nombre_empleado'].'no son iguales</option>';
                        $estado='';

                        // }
                    }
                }

                // echo '<option>f2('.$ocupados['nombre_empleado'].')</option>';

            }

        }
        $est1=$estado;
        $contenido1=$array[$i];

        // if(!$array[$i]){

        // TOTAL DE EMPLEADOS - LIMITE DEL MAS PROXIMO Y ULTIMO EN EL ROL(ETRADA, SALIDA, DESCANSO).

        foreach ($rol_descanso as $key1 => $descanso1) {

            foreach ($rol_descanso as $key2 => $descanso2) {

                switch ($key2) {

                    case $key1:

                    if ($key1[0][1]==$key2[0][1]){

                        if ($descanso1['descanso'] != $descanso2['descanso']){

                            if($array[$i]>=$descanso2['descanso']  AND $array[$i]<$descanso2['descanso']+'1'){
                                $estado='disabled title="Este horario no está disponible." style="color:red;"';
                            }else{
                                $estado='';
                            }
                            continue;

                        }else{

                            if($array[$i]>=$descanso2['descanso']  AND $array[$i]<$descanso2['descanso']+'1'){
                                $estado="disabled title='Este horario no está disponible.'style='color:red;'";
                            }else{
                                $estado='';
                            }
                            break 3;

                        }

                    }else{
                        // echo "<option  value=".$array[$i].">aqui no paso nada</option>";
                    }

                }
                // aqui aremos una prueba
            }

        }

        $res_estado = str_replace('\"', '"', $estado);
        $est2=$res_estado;
        $contenido2 = $array[$i];
        $array_final[] = '<option  value='.$contenido2.'>'.$contenido2.'</option><br>';

        // $capsula_select= $capsula_select.'<option '.$est1.$est2.'  value='.$contenido2.'>'.$contenido2;'</option>';
        // $capsula_select= $capsula_select. '<br>';
        // Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal

        $resultado = array($array_final);
        $empleado_seleccionado = '<input class="empleado_select" type="text"  name="id_empl" value='.$descanso2['enombre'].'>';
    }

    header('Content-Type: application/json');
    //Guardamos los datos en un array

    $datos = array(
    'estado'    => 'ok',
    'id'        => $id,
    'dia'       => $Dia,
    'select'    => $capsula_select,
    'empleado'  => $empleado_seleccionado,
    'contenido' => $resultado
    );

//Devolvemos el array pasado a JSON como objeto
$info = json_encode($datos, JSON_FORCE_OBJECT);
echo($info);
