<!-- html comment
|
|====================================================
|
|   FORMULARIO INICIAR CITA
|
|====================================================
|
-->
<?php
$display = 'none';
?>
<div class="modal fade" id="Modal_formulario_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6 class="modal-title" id="exampleModalLabel"><strong> <img src="img/logo_blanco.png"></strong></h6>
            </div>

            <div class="modal-body formulario_style">
                <div class="row">
                    <div class="form">
                        <form name="formcitas" id="regForm" action="envio_correo_cita.php" method="POST">
                            <input type="hidden" name="conektaTokenId" id="conektaTokenId" value="">
                            <!-- html comment
                            |
                            |====================================================
                            |
                            |   STEP 1  SELECCIONAR SERVICIO
                            |
                            |====================================================
                            |
                            -->
                            <div class="tab">

                                <h3><span>1</span>Selecciona tu servicio:</h3><br>

                                <ul class="nav nav-tabs opciones">
                                    <li class="active"><a data-toggle="tab" href="#Todos">TODOS</a></li>
                                    <?php
                                    $contador = 1;

                                    foreach ($grupo_servicios as $grupo) {

                                        $id_grupo_servicios = $grupo["id"];
                                        $nombre_grupo_servicio = explode(" ", $grupo['nombre']);

                                        if ($contador <= 5) {
                                    ?>
                                            <li><a data-toggle="tab" href="#<?php echo 'menu-' . $contador; ?>"><?php echo $nombre_grupo_servicio[0]; ?></a>
                                            </li>
                                    <?php
                                        }

                                        $contador += 1;
                                    }
                                    ?>
                                    <?php

                                    if ($_SESSION['session_valida'] == 1) {

                                        $tipo_permiso = 1
                                    ?>

                                        <li style="background: #cec813;"><a data-toggle="tab" href="#<?php echo 'menu-16'; ?>"><span class="glyphicon glyphicon-asterisk"></span> CERTIFICADO/PREPAGO</a></li>

                                    <?php
                                    } else {
                                        $tipo_permiso = 0;
                                    ?>
                                        <li style="background: #cec813;"><a data-toggle="tab" href="#<?php echo 'menu-18'; ?>"><span class="glyphicon glyphicon-asterisk"></span> CERTIFICADO</a></li>
                                    <?php

                                    }

                                    ?>

                                </ul>
                                <div class="tab-content">
                             
                                    <?php

                                    if ($_SESSION['session_valida'] == 1) {

                                        $tipo_permiso = 1;
                                    } else {

                                    ?>
                                        <div class="input-group verificar_prepago">
                                            <input type="search" placeholder="FOLIO del servicio que pagaste o te obsequiaron..." class="form-control" value="CER002" id="numero_folio">
                                            <span class="input-group-btn">
                                                <a id="calc" class="btn btn-default buscar_folio" href="#<?php echo 'menu-18'; ?>">Verificar</a>
                                            </span>

                                        </div>

                                    <?php
                                    }

                                    ?>
                                    <?php

                                    ?>
                                    <div id="mostrar_noficacion"></div>
                                    <div class="gifCarga"><img id="loading_spinner" src="img/loading.gif"></div>


                                    <div id="Todos" class="tab-pane fade in active">

                                        <div class="panel-group intervalo" id="accordion1">

                                            <input type="text" name="intervalo_horas" id="resultado" style="display:none">



                                            <?php
                                            $valor_grupo_servicios_id = 0;

                                            if ($valor_grupo_servicios_id == 0) {
                                                $servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_serv',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre,
                                                gs.nombre, gs.id AS 'grupo_servicio_id' from((servicios as s
                                                left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id)
                                                left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) ");
                                            } else {
                                                $servicios = mysqli_query($link, "SELECT s.id,s.nombre AS 'nombre_serv',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre, gs.nombre, gs.id AS 'grupo_servicio_id' from((servicios as s
                                                left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id)
                                                left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) where gs.id=$valor_grupo_servicios_id");
                                            }

                                            $cont = 2;

                                            foreach ($servicios as $res) {
                                            ?>

                                                <div class="captura" style="display: none;">

                                                    <?php echo $res['duracion']; ?>

                                                </div>

                                                <div class="panel panel-default ">
                                                    <div class="panel-heading" style="display: flex;">

                                                        <div class="col-xs-12 col-md-10">


                                                            <h5 class="panel-title autopoint"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#<?php echo 'accordion0_' . $cont; ?>">
                                                                    <?php echo $res['nombre_serv']; ?></a>
                                                            </h5>

                                                        </div>

                                                    </div>

                                                    <div id="<?php echo 'accordion0_' . $cont; ?>" class="panel-collapse collapse">
                                                        <div class="panel-body desc_individual">
                                                            <div class="col-md-12">
                                                                <br>
                                                                <p><?php echo $res['descripcion']; ?><a href="index?pagina=servicio_individual&servicio_id=<?php echo  $res['id']; ?>&grupo_servicio_id=<?php echo $res['grupo_servicio_id']; ?>" title=""> Mas detalles</a>
                                                                </p>
                                                                <hr>
                                                                <div class="col-xs-6 col-md-4">
                                                                    <label>Precio <p>$<?php echo $res['precio']; ?></p>
                                                                    </label>
                                                                </div>

                                                                <div class="col-xs-6 col-md-4">
                                                                    <label>Duración <p><?php echo $res['duracion']; ?>min
                                                                        </p></label>
                                                                </div>

                                                                <div class="col-xs-12 col-md-4">

                                                                    <label class="container">
                                                                        <input type="radio" class="capturar_valor" name="deacuerdo" value="<?php echo $res['id']; ?>" recibe_id="<?php echo $res['id']; ?>" recibe_precio="<?php echo $res['precio']; ?>" recibe_nombre="<?php echo $res['nombre_serv']; ?>" recibe_duracion="<?php echo $res['duracion']; ?>" required>

                                                                        <div class="respuesta">
                                                                        </div>
                                                                        <span class="checkmark" title="seleccionar y continuar">seleccionar</span>
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                                $cont++;
                                            }
                                            ?>

                                        </div>
                                        <span class="view-more">Ver mas...</span>
                                    </div>
                                    <?php
                                    $cont2 = 3;
                                    foreach ($grupo_servicios as $grupo) {
                                        $id_grupo_servicios = $grupo["id"];
                                    ?>
                                        <div id="<?php echo 'menu-' . $id_grupo_servicios ?>" class="tab-pane fade">
                                            <div class="panel-group intervalo" id="accordion<?php echo $id_grupo_servicios . '0'; ?>">

                                                <?php
                                                $valor_grupo_servicios_id = $id_grupo_servicios;
                                                if ($valor_grupo_servicios_id == -1) {
                                                    $servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_serv',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre, gs.nombre, gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) ");
                                                } else {
                                                    $servicios = mysqli_query($link, "SELECT s.id,s.nombre AS 'nombre_serv',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre, gs.nombre, gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) where gs.id=$valor_grupo_servicios_id");
                                                }

                                                $cont2 = 2;
                                                foreach ($servicios as $res) {
                                                ?>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" style="display: flex;">

                                                            <div class="col-xs-12 col-md-10">

                                                                <h5 class="panel-title">
                                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion<?php echo $id_grupo_servicios . '0'; ?>" href="#<?php echo 'accordion' . $id_grupo_servicios . '_' . $cont2; ?>"><?php echo $res['nombre_serv']; ?></a>

                                                                </h5>

                                                            </div>

                                                        </div>

                                                        <div id="<?php echo 'accordion' . $id_grupo_servicios . '_' . $cont2; ?>" class="panel-collapse collapse">

                                                            <div class="panel-body desc_individual">

                                                                <div class="col-md-12">
                                                                    <br>
                                                                    <p><?php echo $res['descripcion']; ?><a href="index?pagina=servicio_individual&servicio_id=<?php echo  $res['id']; ?>&grupo_servicio_id=<?php echo $res['grupo_servicio_id']; ?>" title=""> Mas detalles</a></p>
                                                                    <hr>

                                                                    <div class="col-xs-6 col-md-4">
                                                                        <label>Precio <p>$<?php echo $res['precio']; ?></p>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-xs-6 col-md-4">
                                                                        <label>Duración <p><?php echo $res['duracion']; ?>min
                                                                            </p></label>
                                                                    </div>

                                                                    <div class="col-xs-12 col-md-4">

                                                                        <label class="container">
                                                                            <input type="radio" class="capturar_valor" name="deacuerdo" value="<?php echo $res['id']; ?>" recibe_id="<?php echo $res['id']; ?>" recibe_precio="<?php echo $res['precio']; ?>" recibe_nombre="<?php echo $res['nombre_serv']; ?>" recibe_duracion="<?php echo $res['duracion']; ?>" required>

                                                                            <div class="respuesta">
                                                                            </div>
                                                                            <span class="checkmark" title="seleccionar y continuar">seleccionar</span>
                                                                        </label>

                                                                    </div>


                                                                </div>

                                                                <br>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $cont2++;
                                                    }
                                                    ?>

                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- html comment
                                    |
                                    |====================================================
                                    |
                                    |   test
                                    |
                                    |====================================================
                                    |
                                    -->


                                    <!-- html comment
                                    |
                                    |====================================================
                                    |
                                    |   PREPAGOS SERVICIOS 
                                    |
                                    |====================================================
                                    |
                                    -->
                                    <div id="<?php echo 'menu-16' ?>" class="tab-pane fade">

                                        <div class="panel-group intervalo" id="accordion60">

                                            <?php
                                            /* php comment
                                            |
                                            |====================================================
                                            |
                                            |   CONSULTA PREPAGOS POR SERVICIOS 
                                            |
                                            |====================================================
                                            |   Obtener servicios de los clientes logueados.
                                            */
                                            $correo_electronico = "";

                                            if (isset($_POST["c_electronico"])) {

                                                $correo_electronico = $_POST["c_electronico"];
                                            }

                                            $prepagos_servicios = mysqli_query($link, "SELECT  c.id AS 'c_id', 
                                                c.nombre AS 'c_nombre', 
                                                c.c_electronico AS 'c_c_electronico', 
                                                p.id AS 'p_id', 
                                                p.clientes_id AS 'p_clientes_id', 
                                                p.tipo_prepago_id AS 'p_tipo_prepago_id',
                                                ps.prepagos_id AS 'ps_prepagos_id', 
                                                ps.folio AS 'ps_folio', 
                                                ps.cupon AS 'ps_cupon', 
                                                ps.servicios_id AS 'ps_servicios_id',
                                                s.id AS 's_id',
                                                s.nombre AS 's_nombre', 
                                                s.descripcion AS 's_descripcion', 
                                                s.archivo AS 's_archivo',
                                                s.duracion AS 's_duracion',
                                                s.precio AS 's_precio',
                                                s.status AS 's_status'
                                            FROM (((clientes AS c 
                                            LEFT OUTER JOIN prepagos p ON p.clientes_id=c.id)
                                            LEFT OUTER JOIN prepagos_servicios ps ON ps.prepagos_id=p.id) 
                                            LEFT OUTER JOIN servicios s ON s.id=ps.servicios_id)
                                            WHERE p.tipo_prepago_id=2
                                            AND c.c_electronico='$correo_electronico';");


                                            if (isset($_POST["c_electronico"])) {

                                                $servicios_id = "";
                                                $folio = "";
                                                $cupon = "";

                                                $cuenta_prepagos = 1;

                                                foreach ($prepagos_servicios as $prepago) {

                                                    $servicios_id = $prepago["s_id"];
                                                    $folio = $prepago["ps_folio"];
                                                    $cupon = $prepago["ps_cupon"];
                                                    $correo = $prepago["c_c_electronico"];

                                                    if (isset($_POST["c_electronico"]) && isset($_POST["c_electronico"]) == $correo) {

                                            ?>

                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="display: flex;">

                                                                <div class="col-xs-12 col-md-10">

                                                                    <h5 class="panel-title">
                                                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion60" href="#<?php echo 'accordion890_20' . $cuenta_prepagos; ?>"><?php echo $prepago['s_nombre']; ?></a>

                                                                    </h5>

                                                                </div>

                                                            </div>

                                                            <div id="<?php echo 'accordion890_20' . $cuenta_prepagos; ?>" class="panel-collapse collapse">

                                                                <div class="panel-body desc_individual">

                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <p><?php echo $prepago['s_descripcion']; ?></p>

                                                                        <hr>

                                                                        <div class="col-xs-6 col-md-4">

                                                                            <label title="servicio pagado en prepago">Precio<p>

                                                                            <strike>$<?php echo $prepago['s_precio']; ?></strike>Pagado</p>

                                                                            </label>

                                                                        </div>

                                                                        <div class="col-xs-6 col-md-4">
                                                                            <label>Duración <p><?php echo $prepago['s_duracion']; ?>min
                                                                                </p></label>
                                                                        </div>

                                                                        <div class="col-xs-12 col-md-4">

                                                                            <label class="container">

                                                                                <input type="radio" class="capturar_valor" name="deacuerdo" value="<?php echo $prepago['s_id']; ?>" recibe_id="<?php echo $prepago['s_id']; ?>" recibe_precio="<?php echo $prepago['s_precio']; ?>" recibe_nombre="<?php echo $prepago['s_nombre']; ?>" recibe_duracion="<?php echo $prepago['s_duracion']; ?>" required>

                                                                                <div class="respuesta">


                                                                                </div>

                                                                                <span class="checkmark" title="seleccionar y continuar">seleccionar</span>

                                                                            </label>

                                                                        </div>

                                                                    </div>
                                                                    <br>
                                                                </div>

                                                            </div>

                                                        </div>

                                            <?php

                                                    } else {
                                                    }
                                                    $cuenta_prepagos++;
                                                }
                                            }

                                            ?>


                                        </div>

                                    </div>
                                    <div id="<?php echo 'menu-18' ?>" class="tab-pane fade">

                                        <div class="panel-group intervalo" id="accordion70">

                                            <!-- html comment
                                            |
                                            |====================================================
                                            |
                                            |   Datos Ajax servicio
                                            |
                                            |====================================================
                                            |   obtener datos del servicio por el folio consultado.
                                            -->

                                            <div id="resultado_folio">

                                            </div>
                                           
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- html comment
                            |
                            |====================================================
                            |
                            |   STEP 2  DIA
                            |
                            |====================================================
                            |
                            -->
                            <div class="tab">
                                <h3><span>2</span>Seleccione el Día:</h3><br>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <input id="idxhora" class="form-control id" name="id_xhora" type="text" style="display:<?php echo $display; ?>">
                                    </div>
                                    <div class="form-group">

                                        <input class="form-control dia" type="text" placeholder="Selecionar el Día" class="form-control date-picker hasDatepicker" name="booking_arrival_date" aria-required="true" id="ya" required>

                                    </div>
                                </div>
                            </div>
                            <!-- html comment
                            |
                            |====================================================
                            |
                            |   STEP 3  HORA
                            |
                            |====================================================
                            |
                            -->
                            <div class="tab">
                                <h3><span>3</span>Selecciona la hora:</h3><br>

                                <div class="col-sm-12 col-md-12">

                                    <div class="form-group">

                                        <!-- input ocultos -->

                                        <!-- <input type="text" id="id_ser" value=""> -->
                                        <input type="text" id="dia_cita" value="" style="display:<?php echo $display; ?>">


                                        <input type="text" id="cptura_servicio_id" value="" style="display:<?php echo $display; ?>">

                                        <div class="respuestaEmp">

                                        </div>
                             
                                        </div>
                                        <div class="form-group idempleado" style="display:<?php echo $display; ?>">



                                        </div>

                                    </div>

                                </div>
                                <!-- html comment
                                |
                                |====================================================
                                |
                                |   STEP 4 EMPLEADO
                                |
                                |====================================================
                                |
                                -->
                                <div class="tab">
                                    <h3><span>4</span>¿Quién te atenderá?:</h3><br>
                                    <div class="col-md-12">

                                        <span class="recibe_id_again" id="enviar_id" style="display:<?php echo $display; ?>" ></span>
                                        <span class="recibe_dia_again" id="enviar_dia" style="display:<?php echo $display; ?>"></span>
                                        <span class="recibe_hora_again" id="enviar_hora" style="display:<?php echo $display; ?>"></span>
                                        


                                        <!-- SCRIPT PARA CACHAR LOS DATOS DEL USUARIO LOGUEADO -->
                                        <script>
                                            function EligeOpcion() {
                                                var x = document.getElementById('empleado_type');
                                                // document.getElementById('empleado').value = "MAGALYS";

                                                if (x.value == 'aleatorio') {
                                                    //AC    TIVAMOS LOS CAMPOS A RELLENAR
                                                    document.getElementById('empleado').disabled = true


                                                } else if (x.value == 'eleccion') {
                                                    //ACTIVAMOS LOS CAMPOS A RELLENAR
                                                    document.getElementById('empleado').disabled = false
                                                    
                                                    // document.getElementById('empleado').value = "MAGALYS";
                                                    recargarLista();
                                                    // $('#select_id').change(function(){
                                                    //     regargarLista();
                                                    // });
                                                    $('#empleado_type').val('eleccion');
                                                    recargarLista();

                                                    $('#empleado_type').change(function(){
                                                        recargarLista();
                                                    });

                                                    function recargarLista(){

                                                        /* js comment
                                                        |
                                                        |====================================================
                                                        |
                                                        |   obtengo el valor de los id 
                                                        |
                                                        |====================================================
                                                        |
                                                        */
                                                        
                                                        var id_now = document.getElementById('enviar_id');
                                                        var dia_now = document.getElementById('enviar_dia');
                                                        var hora_now = document.getElementById('enviar_hora');
                                                        /* js comment
                                                        |
                                                        |====================================================
                                                        |
                                                        |   paso solo el valor dentro de la etiqueta span 
                                                        |
                                                        |====================================================
                                                        |
                                                        */
                                                        
                                                        var e_id=id_now.innerHTML;
                                                        var e_dia=dia_now.innerHTML;
                                                        var e_hora=hora_now.innerHTML;
                                                       
                                                        var datos = {
                                                            "hora": e_hora,
                                                            "dia": e_dia,
                                                            "id": e_id,
                                                        };

                                                        // console.log(datos);

                                                        $.ajax({
                                                            type:"POST",
                                                            url:"ajax/empleados.ajax.php",
                                                            data: datos,
                                                            success:function(r){
                                                                console.log(r);
                                                                $('#empleado').html(r);
                                                            }
                                                        });
                                                    }                                                   
                                                }
                                            }
                                        </script>
                                     

                                        <div class="form-group">
                                            <input type="text" id="hora_cita" value="" style="display:<?php echo $display; ?>">
                                        </div>

                                        <div class="form-group">
                                            <div id="select_id">
                                                <select name="empleado_type" id="empleado_type" class="form-control" onchange="EligeOpcion()" required>
                                                    <option value="aleatorio">Dejar que el sistema lo elija</option>
                                                    <option value="eleccion">Escoger terapeuta</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="respuestalistaEmp">

                                            </div>
                                            <!-- continuar -->
                                            <div id="mostraraquilalista">
                                            <select name="empleado" id="empleado" class="form-control empleadolista" required disabled>
                                                    <!-- traer consulta de empleados cachados -->
                                                    <!-- <option value="MAGALYS">MAGALYS</option>

                                                    <option value="TETE">TETE</option> -->
                                            </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- html comment
                            |
                            |====================================================
                            |
                            |   STEP 5 USUARIO
                            |
                            |====================================================
                            |
                            -->
                                <div class="tab">
                                    <h3><span>5</span>Selecciona un usuario:</h3><br>
                                    <div class="col-md-12">

                                        <!-- SCRIPT PARA CACHAR LOS DATOS DEL USUARIO LOGUEADO -->
                                        <script>
                                            function myFunction() {

                                                var x = document.getElementById('user_type');
                                                document.getElementById('nombre_user').value = "";
                                                document.getElementById('email_user').value = "";
                                                document.getElementById('telefono_user').value = "";

                                                if (x.value == 'usuario' || x.value == 'usuario_logeado') {
                                                    //ACTIVAMOS LOS CAMPOS A RELLENAR
                                                    document.getElementById('nombre_user').disabled = false
                                                    document.getElementById('email_user').disabled = false
                                                    document.getElementById('telefono_user').disabled = false
                                                    //VASIAR LOS CAMPOS
                                                    document.getElementById('nombre_user').value = "";
                                                    document.getElementById('email_user').value = "";
                                                    document.getElementById('telefono_user').value = "";

                                                } else if (x.value == 'usuario_session_logeado') {
                                                    //ACTIVAMOS LOS CAMPOS A RELLENAR
                                                    document.getElementById('nombre_user').disabled = false
                                                    document.getElementById('email_user').disabled = false
                                                    document.getElementById('telefono_user').disabled = false
                                                    document.getElementById('nombre_user').value = "<?php echo $res_nombre; ?>";
                                                    document.getElementById('email_user').value = "<?php echo $res_email; ?>";
                                                    document.getElementById('telefono_user').value =
                                                        "<?php echo $res_phone; ?>";

                                                } else if (x.value == 'usuario_session') {
                                                    //     alert('No has iniciado sesión');
                                                    swal("Algo salio mal", "No has iniciado sesión!", "warning");
                                                    //ACTIVAMOS LOS CAMPOS A RELLENAR
                                                    document.getElementById('nombre_user').disabled = true
                                                    document.getElementById('email_user').disabled = true
                                                    document.getElementById('telefono_user').disabled = true
                                                    document.getElementById('nombre_user').value = "";
                                                    document.getElementById('email_user').value = "";
                                                    document.getElementById('telefono_user').value = "";

                                                } else {
                                                    //DESACTIVAMOS LOS CAMPOS A RELLENAR
                                                    document.getElementById('nombre_user').disabled = true
                                                    document.getElementById('email_user').disabled = true
                                                    document.getElementById('telefono_user').disabled = true
                                                    //VASIAR LOS CAMPOS
                                                    document.getElementById('nombre_user').value = "";
                                                    document.getElementById('email_user').value = "";
                                                    document.getElementById('telefono_user').value = "";
                                                }
                                            }
                                        </script>

                                        <div class="form-group">

                                            <select name="usuario" id="user_type" class="form-control" onchange="myFunction()" required>

                                                <option value="nada">
                                                    <p>Seleccionar usuario</p>
                                                </option>
                                                <option value="<?php echo $usuario_session; ?>">Usar datos de mi cuenta
                                                </option>
                                                <option value="<?php echo $usuario; ?>">Ingresar manualmente</option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">

                                            <input type="text" name="id_cliente" value="<?php echo $res_id; ?> " style="display: none;">
                                            <input type="text" id="nombre_user" name="nombre" placeholder="Ingrese  su Nombre/apellidos" required disabled>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">

                                            <input type="email" id="email_user" name="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" placeholder="Ingrese su Coreo electrónico" required disabled>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">

                                            <input type="text" id="telefono_user" name="telefono" placeholder="Ingrese su Teléfono/móvil" required disabled>
                                            <input type="text" name="dejarenblanco" value="nada" style="display: none;">
                                            <input type="text" name="nocambiar" value="http://" style="display: none;">

                                        </div>
                                    </div>
                                </div>
                                <!-- html comment
                            |
                            |====================================================
                            |
                            |   STEP 6 RESUMEN
                            |
                            |====================================================
                            |
                            -->
                                <div class="tab">
                                    <h3><span>6</span>RESUMEN:</h3>
                                    <div class="col-md-12">
                                        
                                        <fieldset>
                                        <legend><label>VERIFICA TUS DATOS ANTES DE CONFIRMAR </label></legend>

                                        <div class="table-responsive">

                                            <table class="table">

                                                <thead>
                                                    <tr class="active">
                                                        <th>Especificaciones del servicio</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="respuestaResumen">

                                                    <!-- datos desde Ajax -->

                                                </tbody>

                                            </table>
                                            <div class="etiqueta_remover_cupon"></div>

                                        </div>
                                        </fieldset>


                                        FORMA DE PAGO:

                                    </div>



                                    <div class="col-md-12 status_forma_pago"> 


                                        <div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">

                                            <a style="width: 33.3%;" href="#paypal" class="btn btn-default active" data-toggle="tab">
                                                <input id="metodo_1" type="radio" name="opcion_pago" value="paypal" required />PayPal
                                            </a>

                                            <a style="width: 33.3%;" href="#tarjeta" class="btn btn-default" data-toggle="tab">
                                                <input id="metodo_2" type="radio" name="opcion_pago" value="tarjeta" required />Tarjeta
                                            </a>
                                            <a style="width: 33.3%;" href="#regalo_prepago" class="btn btn-default autopoint" data-toggle="tab">
                                                <input id="metodo_3" type="radio" name="opcion_pago" value="prepago" required />C.Regalo | Prepago.
                                            </a>
                                            <div id="mostrarOtraOpcion">
                                            </div>


                                        </div>

                                        <div class="tab-content">

                                        <!-- html comment
                                        |
                                        |====================================================
                                        |
                                        |   Metod de Pago: PAYPAL
                                        |
                                        |====================================================
                                        |
                                        -->
                                        <div class="tab-pane active" id="paypal">

                                            <div class="img_pagos">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <img style="width: 100%;" src="img/forma_de_pago/credito.jpg" alt="">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img style="width: 100%;" src="img/forma_de_pago/debito.jpg" alt="">
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                        <!-- html comment
                                        |
                                        |====================================================
                                        |
                                        |   Metod de Pago: TARJETA
                                        |
                                        |====================================================
                                        |
                                        -->
                                            <div class="tab-pane" id="tarjeta">

                                                <div class="img_pagos">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img style="width: 100%;" src="img/forma_de_pago/credito.jpg" alt="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img style="width: 100%;" src="img/forma_de_pago/debito.jpg" alt="">
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Formulario  Pagos por Tarjeta -->

                                                <br>
                                                <div class="card well">
                                                    <div class="card-body">

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <label>
                                                                    Nombre del Tarjeta-habiente
                                                                </label>
                                                                <input value="Fulanito Pérez" data-conekta="card[name]" class="form-control" name="name" id="name" type="text">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Número de tarjeta
                                                                </label>
                                                                <input value="4242424242424242" name="card" id="card" data-conekta="card[number]" class="form-control" type="text" maxlength="16">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>
                                                                    CVC
                                                                </label>
                                                                <input value="399" data-conekta="card[cvc]" class="form-control" type="text" maxlength="4">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>
                                                                    Fecha de expiración (MM/AA)
                                                                </label>
                                                                <div>
                                                                    <input style="width:50px; display:inline-block" value="12" data-conekta="card[exp_month]" class="form-control" type="text" maxlength="2"> /
                                                                    <input style="width:50px; display:inline; display:inline-block;" value="20" data-conekta="card[exp_year]" class="form-control" type="text" maxlength="2">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <!-- <label>Concepto</label> -->
                                                                <input class="form-control" type="text" name="description" id="description" maxlength="100" value="" style="display:<?php echo $display; ?>">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <!-- <label>Monto</label> -->
                                                                <input class="form-control" type="number" name="total" id="total" value="" style="display:<?php echo $display; ?>">
                                                            </div>
                                                        </div>
                                                        <br>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- html comment
                                        |
                                        |====================================================
                                        |
                                        |   Metod de Pago: CERTIFICADO O PREPAGO
                                        |
                                        |====================================================
                                        |
                                        -->
                                            <div class="tab-pane" id="regalo_prepago">
                                                <?php

                                                if ($_SESSION['session_valida'] == 1) {

                                                    $tipo_permiso = 1;

                                                ?>

                                                    <div class="row">

                                                        <?php

                                                        $correo = $_POST["c_electronico"];

                                                        $prepagos_cantidad = mysqli_query($link, "SELECT c.id AS     'c_id', 
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
                                                        AND c.c_electronico='$correo';");

                                                        $contador = 1;
                                                        $tipo_prepago = '';
                                                        $categoria_prepago = '';


                                                        foreach ($prepagos_cantidad as $cantidad) {

                                                            $folio = $cantidad['pc_folio'];

                                                            if (isset($_POST["c_electronico"]) && isset($_POST["c_electronico"]) == $correo) {

                                                                if ($cantidad['p_tipo_prepago_id'] == 1) {

                                                                    $tipo_prepago = 'En monedero';
                                                                }
                                                                if ($cantidad['p_tipo_prepago_id'] == 2) {

                                                                    $tipo_prepago = 'Servicio';
                                                                }
                                                                if ($cantidad['p_categoria_prepago_id'] == 1) {

                                                                    $categoria_prepago = ' Expediente Prepago';
                                                                }
                                                                if ($cantidad['p_categoria_prepago_id'] == 2) {

                                                                    $categoria_prepago = 'Certificado Regalo';
                                                                }
                                                                if ($cantidad['p_categoria_prepago_id'] == 3) {

                                                                    $categoria_prepago = 'Certificado Cortesía';
                                                                }

                                                        ?>
                                                                <div class="col-md-4">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title"><?php echo $categoria_prepago; ?></h4>
                                                                            <p class="card-text"><?php echo $tipo_prepago ?></p>
                                                                            <h3>$<?php echo $cantidad['pc_cantidad'] . '.00'; ?></h3>

                                                                        </div>
                                                                        <a href="#" class="btn btn_format_personal btn-default">Usar
                                                                            Ahora
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                        <?php

                                                            } else {

                                                                echo "<small class='bg-warning text-danger'>No tienes ningún certificado/prepago...</small>";
                                                            }
                                                        }
                                                        $contador++;

                                                        ?>

                                                    </div>

                                                <?php

                                                } else {

                                                ?>
                                                    <div class="input-group verificar_prepago">
                                                        <input type="search" placeholder="FOLIO del prepago en cantidad que pagaste o te obsequiaron..." class="form-control" value="CER001" id="numero_folio_cantidad">
                                                        <span class="input-group-btn">
                                                            <a id="buscarfolio" class="btn btn-default buscar_folio_cantidad">Verificar</a>
                                                        </span>

                                                    </div>

                                                    <div class="gifCarga"><img id="loading_spinner2" src="img/loading.gif"></div>
                                                    <div class="row">

                                                        <div id="mostrar_notificacion_busqueda"></div>
                                                        <div id="mostrarResultadoBusqueda"></div>
                                                        


                                                    </div>



                                                <?php
                                                }

                                                ?>

                                            </div>


                                        </div>
                                    </div>
                                    <!-- html comment
                                |
                                |====================================================
                                |
                                |   SOLICITAR FACTURA
                                |
                                |====================================================
                                |
                                -->
                                    <div class="col-md-12">

                                        <input class="opcion_factura" style="width: auto !important; margin-right: 5px;" type="checkbox" name="c1" onclick="showMe('contenido_factura')">Solicitar
                                        Factura

                                        <div class="contenido_factura" id="contenido_factura" style="display:none">

                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <input id="rfc" class="campo rfc" type="text" name="rfc" value="0" placeholder="R.F.C.">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <input id="razonSocial" class="campo razonSocial" type="text" name="razonSocial" value="0" placeholder="Razón Social">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <select id="cfdi" class="campo cfdi" name="cfdi">
                                                        <option value="D01">D01 - Honorarios médicos, dentales y gastos
                                                            hospitalarios.</option>
                                                        <option value="D02">D02 - Gastos médicos por incapacidad o
                                                            discapacidad</option>
                                                        <option value="D03">D03 - Gastos funerales.</option>
                                                        <option value="D04">D04 - Donativos.</option>
                                                        <option value="D05">D05 - Intereses reales efectivamente pagados por
                                                            créditos hipotecarios (casa habitación).</option>
                                                        <option value="D06">D06 - Aportaciones voluntarias al SAR.</option>
                                                        <option value="D07">D07 - Primas por seguros de gastos médicos.
                                                        </option>
                                                        <option value="D08">D08 - Gastos de transportación escolar
                                                            obligatoria.</option>
                                                        <option value="D09">D09 - Depósitos en cuentas para el ahorro,
                                                            primas que tengan como base planes de pensiones.</option>
                                                        <option value="D10">D10 - Pagos por servicios educativos
                                                            (colegiaturas)</option>
                                                        <option value="G01">G01 - Adquisición de mercancías</option>
                                                        <option value="G02">G02 - Devoluciones, descuentos o bonificaciones
                                                        </option>
                                                        <option value="G03">G03 - Gastos en general</option>
                                                        <option value="I01">I01 - Construcciones</option>
                                                        <option value="I02">I02 - Mobiliario y equipo de oficina por
                                                            inversiones</option>
                                                        <option value="I03">I03 - Equipo de transporte</option>
                                                        <option value="I04">I04 - Equipo de computo y accesorios</option>
                                                        <option value="I05">I05 - Dados, troqueles, moldes, matrices y
                                                            herramental</option>
                                                        <option value="I06">I06 - Comunicaciones telefónicas</option>
                                                        <option value="I07">I07 - Comunicaciones satelitales</option>
                                                        <option value="I08">I08 - Otra maquinaria y equipo</option>
                                                        <option value="P01">P01 - Por definir</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- html comment
                            |
                            |====================================================
                            |
                            |   STEP 7 TÉRMINOS Y CONDICIONES
                            |
                            |====================================================
                            |
                            -->
                                <div class="tab">
                                    <h3><span>7</span>TÉRMINOS Y CONDICIONES: </h3>
                                    <div class="form-group">

                                        <input class="obtube_payment" type="text" id="payment_metod" value="" style="display:<?php echo $display; ?>">

                                    </div>

                                    <div class="terminos">


                                        <h6> RESPONSIVA: </h6>

                                        Por medio de la presente yo: <span style="text-decoration: underline; text-transform: uppercase; font-weight: 900;"><?php echo $res_nombre; ?></span>
                                        certifico que he manifestado la verdad y además estoy ampliamente informado (a) del
                                        diagnóstico y plan de tratamiento, así como de las modificaciones que se juzgan
                                        necesarias para el mejoramiento del mismo.

                                        <h6>CONDICIONES DE SALUD:</h6>

                                        Para otorgar el servicio el cliente deberá proporcionar información en su historia
                                        clínica.
                                        <br><br>
                                        La empresa NO se hace responsable de negligencias o alteraciones a la verdad que
                                        proporcione.

                                        <h6>RETARDOS:</h6>

                                        Si usted llega 10 minutos tarde su servicio será recortada si usted llega 15 minutos
                                        tarde su servicio será cancelado.
                                        <br><br>
                                        Los paquetes tienen vigencia de 6 meses máximo para tomar los servicios, pasando
                                        este tiempo se le cobrara una reactivación de servicio tomado.

                                        <h6>POLÍTICAS DE CANCELACIÓN:</h6>

                                        En caso de no poder asistir a su cita, le pedimos haga su cancelación con tres horas
                                        de anticipación. De lo contrario se toma como servicio tomado. Así mismo si desea
                                        cambiar su tratamiento debe avisar con mínimo de 2 horas de anticipación.

                                        <h6>DURANTE SU VISITA</h6>

                                        El cliente deberá mostrar un comportamiento adecuado y respetuoso hacia el personal,
                                        evitando insinuaciones o faltas a la moral.
                                        De presentarse algunos de estos casos el servicio será suspendido.
                                        <br><br>

                                        Shifra Spa NO se hace responsable de objetos olvidados dentro de las instalaciones.
                                        <br><br>

                                        No hay devoluciones. Sin excepción.
                                        <br><br>

                                        Es mi decisión libre aceptar el servicio que he adquirido, deslindando a ANDARES SPA
                                        & MEDICAL CENTER S DE RL DE CV de cualquier responsabilidad Civil, contractual y
                                        extra contractual que surja durante la realización de los servicios así como el pago
                                        de cualquier indemnización.

                                    </div>

                                    <br>

                                    <div class="radio-inline checTermin"> He leído y acepto los términos
                                        <label for="terminos" class="container">
                                            <input type="radio" name="terminos" id="terminos" value="deacuerdo" required>

                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    

                                </div>

                                <!-- INDICADORES DE LOS PASOS: -->
                                <div class="col-md-12" style="text-align:center;margin-top:40px; bottom: 0;">

                                    <!--1 SERVICIO -->
                                    <span class="step"></span>
                                    <!--2 DIA -->
                                    <span class="step"></span>
                                    <!--3 HORA -->
                                    <span class="step"></span>
                                    <!--4 USUARIO -->
                                    <span class="step"></span>
                                    <!--5 EMPLEADO -->
                                    <span class="step"></span>
                                    <!--6 RESUMEN/METODO PAGO -->
                                    <span class="step"></span>
                                    <!--7 TERMINOS -->
                                    <span class="step"></span>

                                </div>

                        </form>

                    </div>
                    <div class="col-sm-12 modal-footer">

                        <?php echo $MJEerror; ?>

                        <button type="button" class="btn" id="prevBtn" onclick="nextPrev(-1)">Regresar</button>
                        <button type="button" name="siguiente" class="btn" id="nextBtn" onclick="nextPrev(1)">Continuar</button>
                        <button type="button" class="btn" data-dismiss="modal">Salir</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>