<section class="contenedor_servicio_individual">

    <!-- ==================================
    >  		DESCRIPCION CORTA             <
    ==================================  -->
    <?php

    foreach ($servicios as $servicio) {
        $id_servicio          = $servicio['id'];
        $nombre               = $servicio['nombre_servicio'];
        $archivo_pad          = $servicio['archivo'];
        $descripcion          = $servicio['descripcion'];
        $descripcion_res      = str_replace(".", ".<br>", $descripcion);
        $caracteristicas      = $servicio['caracteristicas'];
        $duracion             = $servicio['duracion'];
        $precio               = $servicio['precio'];
        $precio_formato_comas = number_format($precio);
        $nombre_subgrupo      = $servicio['nombre_subgrupo'];
        $subgrupo_servicios_id = $servicio['subgrupo_servicios_id'];
        $nombre_grupo         = $servicio['nombre_grupo'];
        $grupo_servicio_id    = $servicio['grupo_servicio_id'];
    ?>
        <section class="seccion_1_servicios_individual">

            <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                <center>
                    <h2> <?php echo $nombre ?></h2>
                </center>
                <br />


                <!-- ==================================
                >		IMAGENES SLIDER				  <
                ==================================  -->
                <!-- https://bootsnipp.com/snippets/featured/carousel-extended-320-compatible -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div id="main_area">

                        <!-- Slider -->
                        <div class="row">
                            <div class="col-md-12" id="slider">
                                <!-- Top part of the slider -->
                                <div class="row">

                                    <div class="col-md-12" id="carousel-bounding-box">
                                        <ul class="breadcrumb">
                                            <li style="text-transform: uppercase;"><a href="index?pagina=servicios">
                                                    <font color="white">Servicios</font>
                                                </a></li>

                                            <li style="text-transform: uppercase;"><a href="index?pagina=servicios&grupo_servicios_id= <?php echo $grupo_servicio_id; ?>">
                                                    <font color="white"><?php echo $nombre_grupo; ?></font>
                                                </a></li>

                                            <li style="text-transform: uppercase; border-bottom: 1px solid; opacity: .9;"><?php echo $nombre_subgrupo; ?></li>

                                        </ul>
                                        <div class="carousel slide" id="myCarousel2">
                                            <!-- Carousel items -->

                                            <div class="carousel-inner">
                                                <div class="active item" data-slide-number="0">
                                                    <img src="<?php echo $ruta_base . $archivo_pad; ?>"></div>

                                                <?php

                                                $contador1 = 1;

                                                foreach ($imagen_servicios as $img_servicio) {
                                                    $id = $img_servicio['id'];
                                                    $archivo = $ruta_base . $img_servicio['archivo'];
                                                    $id_servicios = $img_servicio['servicios_id'];


                                                    if ($id_servicios == $id_servicio) {




                                                ?>

                                                        <div class="item" data-slide-number="<?php echo $contador1; ?>">
                                                            <img src="<?php echo $archivo; ?>"></div>

                                                <?php  }
                                                    $contador1 += 1;
                                                } ?>


                                            </div><!-- Carousel nav -->
                                            <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/Slider-->
                        <div class="row hidden-xs miniaturas" id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="hide-bullets">
                                <li class="col-md-2">
                                    <a class="thumbnail" data-target="#myCarousel2" data-slide-to="0" id="carousel-selector-0"><img src="<?php echo $ruta_base . $archivo_pad; ?>"></a>
                                </li>
                                <?php

                                $contador = 0;

                                foreach ($imagen_servicios as $img_servicio) {
                                    $id = $img_servicio['id'];
                                    $archivo = $ruta_base . $img_servicio['archivo'];
                                    $id_servicios = $img_servicio['servicios_id'];

                                    if ($id_servicio == $id_servicios && $id_servicio != -1) {

                                        $contador += 1;

                                ?>



                                        <li class="col-md-2">
                                            <a class="thumbnail" data-target="#myCarousel2" data-slide-to="<?php echo $contador; ?>" id="carousel-selector-<?php echo $contador; ?>"><img src="<?php echo $archivo; ?>"></a>
                                        </li>

                                <?php }
                                } ?>


                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="contenedor">
                        <div class="col-xs-12 col-md-10 col-md-offset-1 descripcion_serv_ind">
                            <div id="id_subgrupo_oculto" style="display: none">
                                <?php echo $subgrupo_servicios_id; ?>
                            </div>
                            <strong>Descripción:</strong><br>
                            <p><?php echo $descripcion_res; ?></p>
                            <br>


                            <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" style="border: 1px solid;  margin-top:20px;"></div>

                            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1">


                                <div class="col-xs-6 col-sm-6 col-md-6 duracion_precio">
                                    <p style="text-align: center;"> <br><b>Duración:</b> <br>

                                        <?php

                                        $valor = $duracion;
                                        if ($valor == 11) {
                                            $tiempo = str_replace("11", "Indet.", $valor);
                                            echo $tiempo;
                                        } else {
                                            echo $valor . ' min.';
                                        }

                                        ?>
                                    </p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 duracion_precio">
                                    <p style="text-align: center;"> <br><b>Precio:</b> <br> <?php echo "$" . $precio_formato_comas . ".00"; ?></p>
                                </div>

                            </div>
                            <!--   <div class="col-xs-12 col-sm-12 col-md-12">
                    <br>                           
                    <input class="recibe_id" type="text" name="recibe_id" value="<?php echo $id_servicio; ?>" style="display: none;"> 
                    <input class="recibe_nombre" type="text" name="recibe_nombre" value="<?php echo $nombre; ?>" style="display: none;">
                    <input class="recibe_duracion" type="text" name="recibe_duracion" value="<?php echo $duracion; ?>" style="display: none;">
                    <input class="recibe_precio" type="text" name="recibe_precio" value="<?php echo $precio; ?>" style="display: none;">


                    <button class="btnAgendaInd btn-default"  name="deacuerdo" style="border-radius: 10px; color: #000; margin-top: 10px;" data-toggle="modal" data-target="#Modal_formulario_cita_individual" recibe_precio="<?php echo $precio; ?>" recibe_nombre="<?php echo $nombre; ?>" recibe_duracion="<?php echo $duracion; ?>">AGENDAR</button>
                </div> -->

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label class="container">
                                    <input type="radio" class="capturar_valor_ind" name="deacuerdo" value="<?php echo $id_servicio; ?>" recibe_id="<?php echo $id_servicio; ?>" recibe_precio="<?php echo $precio; ?>" recibe_nombre="<?php echo $nombre; ?>" recibe_duracion="<?php echo $duracion; ?>">

                                    <div class="respuesta">

                                    </div>

                                    <span data-toggle="modal" data-target="<?php echo $modal_cita_individual; ?>" class="checkmark2" title="selecciona el servicio">AGENDAR</span>
                                </label>


                                <!--   <button class="btnAgendaInd" type="btn btn-danger" style="border-radius: 10px; color: #000; margin-top: -10px;" data-toggle="modal" data-target="#Modal_formulario_cita_individual">AGENDAR</button> -->

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:flow-root;">

                    <center>
                        <h2>CARACTERÍSTICAS</h2>
                    </center>
                    <hr style="opacity: .2">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2" style="text-align: center;  min-height: 200px;">

                    <p style="text-align: left; padding: 20px 40px;">
                    <?php
                        $cadena1 = $caracteristicas;
                        $resultado1 = str_replace("+", "<br/>-", $cadena1);

                        echo $resultado1; 
                    ?>
                    </p>

                </div>



        </section>
        <section class="seccion_2_servicios_individual">
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                <!-- ==================================
            >		DETALLES        			  <
            ==================================  -->
                <div class="col-xs-12 col-md-12" style="padding-bottom: 40px;">
                    <script>
                        var resultado = 0;
                        document.getElementById("id_subgrupo_oculto").value = resultado;
                        document.getElementById("mostrar_id_subgrupo").value = resultado;
                    </script>


                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <center>
                            <h3>SERVICIOS RELACIONADOS</h3>
                        </center>
                    </div>

                    <?php
                    if (isset($_GET['grupo_servicio_id'])) {
                        $datosgrupoervicio = $_GET['grupo_servicio_id'];


                        $servicios1 = mysqli_query($link, "SELECT 
                    s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', 
                    gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s 
                    left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) 
                    left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) where s.subgrupo_servicios_id=$datosgrupoervicio");

                        foreach ($servicios1 as $servicio) {
                            $nombre = $servicio['nombre_servicio'];
                            $descripcion = $servicio['descripcion'];
                            $duracion = $servicio['duracion'];
                            $archivoSer = $servicio['archivo'];
                            $precio = $servicio['precio'];
                            $id_servicio = $servicio['id'];
                            $subgrupo_servicios_id = $servicio['subgrupo_servicios_id'];


                    ?>
                            <div id="mostrar_id_subgrupo">

                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="col-xs-12 col-md-12 panel_servicio">
                                    <div class="container-fluid cont_caja_servicios">

                                        <div class="flex-container table-responsive-sm" id="accordion2">

                                            <a href="index?pagina=servicio_individual&servicio_id=<?php echo $id_servicio; ?>&grupo_servicio_id=<?php echo $subgrupo_servicios_id; ?>"><img src="<?php echo $ruta_base . $archivoSer; ?>" style="border-radius: 50%; width: 40px; height: 40px;"></a>
                                            <div class="col-sm-12 col-md-12 nombre">

                                                <h4><a href="index?pagina=servicio_individual&servicio_id=<?php echo $id_servicio; ?>&grupo_servicio_id=<?php echo $subgrupo_servicios_id; ?>">
                                                        <font color="#4D0000"><?php echo $nombre; ?></font>
                                                    </a></h4>
                                            </div>

                                            <!-- <div class="col-xs-3 col-sm-3 col-md-5">
                                    <div class="label label-basic" style="cursor: pointer;" ><a href="servicio_ind.php?servicio_id=<?php echo $id_servicio; ?>&grupo_servicio_id=<?php echo $subgrupo_servicios_id; ?>"><font color="#4D0000">
                                                <img class="img_reed" src="img/iconos/ShifraReadMore.png" title="Ver mas detalles" style="width: 40px;"><p class="text_reed">Ver más detalles</p> </font></a></div>

                                </div> -->
                                            <!-- <div class="col-xs-2 col-sm-3 col-md-2">
                                    <div style="cursor: pointer;" href="#" data-toggle="modal" data-target="#Modal_formulario_cita"><img class="img_reed movil" src="img/iconos/agendaGuinda.png" title="Agendar" style="width: 40px;"><button class="btn btn-danger txt_agendar" style="border-radius: 10px;">Agendar</button></div>

                                </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php

                        }
                    }
                    ?>

                </div>


            </div>
        <?php } ?>

        </div>

        </section>
</section>