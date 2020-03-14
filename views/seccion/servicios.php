<section class="contenedor_servicios">
 	<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
         <button type="button" id="sidebarCollapse" class="btn btn-info" >
            <i class="glyphicon glyphicon-chevron-left"></i>
        </button>

    	<!-- <input type="hidden" id="cacharId"> -->
        <ul class="list-unstyled components contenedor_ser " id="myBtnContainer">
        	<li class="active menuServicios" >
            	<strong><a href="index?pagina=servicios">
                <font color="#000">SERVICIOS</font></a>
                </strong>
            </li>
            <?php

                foreach ($grupo_servicios as $grupo_servicio) {
                    $nombre =explode(" ",$grupo_servicio['nombre']);
                    $imagen = $grupo_servicio['archivo'];
                    $id = $grupo_servicio['id'];
            ?>

			<li class="menuServicios">

                <a href="index?pagina=servicios&grupo_servicios_id=<?php echo $id; ?>">
                <font color="#000"><?php echo '&nbsp;&nbsp;'.$nombre[0]; ?></font>
                </a>

            </li>

    		<?php
    			}
    		?>

    	</ul>
        </nav>
        <div id="Seccion_servicios">
        	<div class="menuServicios">
                <!-- <a href="#menu-toggle" id="sidebarCollapse"><span class="glyphicon glyphicon-chevron-right"></span></a> -->
                <button type="button" id="sidebarCollapse2" class="btn btn-info">
                    <i class="glyphicon glyphicon-chevron-right"></i>
                </button>
            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2 container-fluid">


                <?php

                if(isset($_GET['grupo_servicios_id'])){
                    $datosgrupo=$_GET['grupo_servicios_id'];
                    $grupo_servicios=mysqli_query($link,"SELECT id, nombre, descripcion, archivo FROM grupo_servicios WHERE id=$datosgrupo");
                foreach ($grupo_servicios as $grupo) {

                    $nombre=explode(" ",$grupo['nombre']);
                    $descripcion=$grupo['descripcion'];
                    $imagen=$grupo['archivo'];

                 echo '<div class="n_servicio"><div class="imagen" style="background-image: url(' .$ruta_base.$imagen.' )" alt=""><h2>'.$nombre[0].'
                </h2></div><br /><p>'.$descripcion.'</p></div> ';
                }
                }else{
                    echo '<div class="n_servicio"><div class="imagen" style="background-image: url(img/shutterstock_421394743.jpg )" alt=""><h2>SERVICIOS</h2>
                </div></div> ';

                }
                ?>

              
            </div>

            <div class="cont_p_serv col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                <?php
                    foreach ($subgrupo_servicios as $subgrupo){

                    $nombre_subgrupo_ind = $subgrupo['nombre'];
                    $id_subgrupo_id = $subgrupo['id'];
                ?>
                <div class="subgrupos" style="color: #a28356; "><h3><?php echo $nombre_subgrupo_ind; ?></h3>
                    <hr>
                </div>

			    <?php

				    foreach ($servicios as $servicio) {
				    $id_servicio          = $servicio['id'];
				    $nombre               = $servicio['nombre_servicio'];
					$archivo              = $servicio['archivo'];
					$descripcion          = $servicio['descripcion'];
					$descripcion_res      = str_replace(".", ".<br>", $descripcion);
                    $caracteristicas      = $servicio['caracteristicas'];
					$duracion             = $servicio['duracion'];
					$precio               = $servicio['precio'];
					$nombre_subgrupo      = $servicio['nombre_subgrupo'];
                    $subgrupo_servicios_id=$servicio['subgrupo_servicios_id'];
                    $nombre_grupo         = $servicio['nombre_grupo'];

			    ?>

                <div class=" col-md-12 panel_servicio">
                    <div class="container-fluid cont_caja_servicios">

                        <div class="flex-container table-responsive-sm" id="accordion2">

                            <a href="index?pagina=servicio_individual&servicio_id=<?php echo $id_servicio; ?>&grupo_servicio_id=<?php echo $subgrupo_servicios_id; ?>"><img src="<?php echo $ruta_base.$archivo; ?>" style="border-radius: 50%; width: 40px; height: 40px;"></a>
                            <div class="col-xs-6 col-sm-6 col-md-6 nombre">

                                <h4><?php echo $nombre; ?></h4>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="label label-basic" style="cursor: pointer;" ><a href="index?pagina=servicio_individual&servicio_id=<?php echo $id_servicio; ?>&grupo_servicio_id=<?php echo $subgrupo_servicios_id; ?>"><font color="#4D0000">
                                <img class="img_reed" src="img/iconos/ShifraReadMore.png" title="Ver mas detalles" style="width: 40px;"><p class="text_reed">Ver más detalles</p> </font></a></div>

                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 btn_agenda_individual">
                                <label class="container">
                                    <input type="radio" class="capturar_valor_ind" name="deacuerdo"   value="<?php echo $id_servicio;?>" recibe_id="<?php echo $id_servicio;?>" recibe_precio="<?php echo $precio;?>" recibe_nombre="<?php echo $nombre;?>" recibe_duracion="<?php echo $duracion;?>">

                                    <div class="respuesta">

                                    </div>

                                    <span data-toggle="modal" data-target="<?php echo $modal_cita_individual; ?>"  title="selecciona el servicio"><img class="img_reed" src="img/iconos/agendaGuinda.png" title="Agendar" style="width: 40px;"><p class="checkmark2 text_reed" >AGENDAR</p></span>

                                </label>

                              <!--   <button class="btnAgendaInd" type="btn btn-danger" style="border-radius: 10px; color: #000; margin-top: -10px;" data-toggle="modal" data-target="#Modal_formulario_cita_individual">AGENDAR</button> -->

                            </div>
                        </div>
                    </div>
                </div>
                <div id="demo<?php echo $id_servicio; ?>" class="col-md-12 caracteristicas" style="padding-top: 25px; display: inline-flex;">

                    <img src="img/l.png" style="height: 60px; margin-top: -37px; padding-left: 10px;    ">
                    <p><?php echo $descripcion_res; ?> </p>
			    </div>


			    <?php
                    }

                    
                }
                ?>

        </div>
	 </section>