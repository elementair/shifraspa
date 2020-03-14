<?php
session_start();
require_once('../servicio/consulta.php');
$datos = new consulta();
$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;

$id_now   = $_POST['id'];
$dia_now  = $_POST['dia'];
$hora_now = $_POST['hora'];


$array_dias['Sunday']    = "domingo";
$array_dias['Monday']    = "lunes";
$array_dias['Tuesday']   = "martes";
$array_dias['Wednesday'] = "miercoles";
$array_dias['Thursday']  = "jueves";
$array_dias['Friday']    = "viernes";
$array_dias['Saturday']  = "sabado";

$fecha = str_replace("/", "-", $dia_now);

$obtener_dia_letra = $array_dias[date('l', strtotime($fecha))];

$consultaempleados = mysqli_query($link, "SELECT 
            s.id AS 's_id',
            s.nombre AS 's_nombre', 
            s.duracion AS 's_duracion',
            e.id AS 'e_id', 
            e.nombre AS 'e_nombre', 
            er.entrada AS 'er_entrada', 
            er.salida AS 'er_salida',
            er.descanso AS 'er_descanso', 
            er.duracion AS 'er_duracion', 
            er.lunes AS 'lunes',
            er.martes AS 'martes', 
            er.miercoles AS 'miercoles',  
            er.jueves AS 'jueves', 
            er.viernes AS 'viernes',  
            er.sabado AS 'sabado', 
            er.domingo AS 'domingo' 
        FROM(((servicios as s
        left outer join servicios_empleados as ss on s.id=ss.servicios_id)
        left outer join empleados as e on e.id=ss.empleados_id)
        left outer join empleados_rol as er on er.empleados_id=e.id) 
        WHERE e.status=1 AND servicios_id=".$id_now." AND ".$obtener_dia_letra."= 1");

$cadena= "<select id='lista_empleados_disponibles' name='lista_empleados_disponibles'>";

while($ver = mysqli_fetch_row($consultaempleados)){
    
    $cadena=$cadena .'<option value='.$ver[4].'$>'.utf8_encode($ver[4]).'</option><br>';

}
echo $cadena , "</select>";