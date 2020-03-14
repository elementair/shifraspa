<section id="inicio">
        
		
		<div id="myCarousel1" class="carousel slide" data-ride="carousel">
		    <!-- Indicators -->
		    <ol class="carousel-indicators">
			<?php 
			  	$status='';	
			  	foreach ($slider_inicio as $inicio){

			  		$id=$inicio['id'];

			  		if ($id == 1){
                	 $status='active';

              

			  	?>
		      <li data-target="#myCarousel1" data-slide-to="<?php echo $id; ?>" class="<?php echo $status; ?>"></li>
		      <?php }else{ ?>
		      <li data-target="#myCarousel1" data-slide-to="<?php echo $id; ?>"></li>
		      <?php } } ?>
		    </ol>

		    <div class="carousel-inner">

		    	<?php 
				  	$Status='';	
				  	$url='';
				  	foreach ($slider_inicio as $slider_ini){

				  		$id=$slider_ini['id'];
				  		$nombre_si=$slider_ini['nombre'];
				  		$descripcion=$slider_ini['descripcion'];
				  		$boton=$slider_ini['boton'];
				  		$url=$slider_ini['url'];
				  		$archivo_slider=$ruta_base.$slider_ini['archivo'];

				  		if ($id == 1){
                    	 	$Status='active';
				?>


		    	<!-- VIDEO O IMAGEN -->
				<div class="item <?php echo $Status; ?>">
                	<div class="movil">
                	<div class="degradado_inicio"></div>
                	<div class="imagen_inicio" style="background-image: url('<?php echo $archivo_slider; ?>');"></div>
                	</div>
					<div class="pc">

					

                	<div class="video_inicio"> 
                	<div class="degradado_inicio"></div>
                	<?php 
					foreach ($video_inicio as $video_ini){

				  		
				  		$archivo=$ruta_base.$video_ini['archivo']; 
				  	?>
				    <video class="video_inicio2 center-block fondocss"  autoplay muted loop>
				        <source src="<?php echo $archivo; ?>" type="video/mp4">
						</video>
						
			

				    	<?php } ?>
				    </div>
					
				    </div>
				      
				    <div class="degradado_inicio"></div>

                	<div class="container">
	                	<div class="carousel-caption">
						    <h1 class="animated fadeInDown"><?php echo $nombre_si; ?></h1></br>
						    <h4 class="animated fadeInUp"><?php echo $descripcion; ?></h4></br>
								<!-- <p class="animated fadeInUp"><a style="display: inline-block;" class="btn-transparent btn-rounded btn-large" <?php echo $url; ?> ><?php echo $boton; ?></a></p> -->
								<!----------------------------------
								-- Youtube video complete --
								------------------------------------>

								<!-- <h6 style="position:absolute; display:inline-block; margin-left:0px; margin-top:71px;" ></h6> -->

								<img class="img_anim_down" src="img/scroll-down.gif" alt=""><br>										<!-- dale un vistaso a nuestro establecimiento -->
								<a class="btn-transparent btn-rounded btn-large js-video-button titulo_universal" data-video-id='nKqNrpBD4E0'><span syle="margin-bottom:10px; position:absulute;" class="glyphicon glyphicon-facetime-video"> </span> Ver Video</a>
							
								<!----------------------------------
								-- fin --
								------------------------------------>
									
						</div>

					</div>

			    </div>

			<?php }else{ ?>

                <div class="item" >
                	<div class="degradado_inicio"></div>
                	<div class="imagen_inicio" style="background-image: url('<?php echo $archivo_slider; ?>');"></div>
                	<div class="container">

	                <div class="carousel-caption">
	                    <h1 class="animated fadeInDown"><?php echo $nombre_si;?></h1></br>
	                     <h4 class="animated fadeInUp"><?php echo $descripcion; ?></h4></br>
							<h4 class="animated fadeInUp"><a style="display: inline-block;" class="btn-transparent btn-rounded btn-large" <?php echo $url; ?> ><?php echo $boton; ?></a></h4>
							
						
						</div>
	            	</div>
                </div>
            <?php } } ?>
                
    		</div>
		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#myCarousel1" data-slide="prev">
		      	<span class="glyphicon glyphicon-chevron-left"></span>
		      	<span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel1" data-slide="next">
		      	<span class="glyphicon glyphicon-chevron-right"></span>
		      	<span class="sr-only">Next</span>
		    </a>
		   	<!--<div class="contenido_inicio">
				<h1>BIENVENIDOS</h1><br>
				<img src="img/logo_blanco.png">
			</div> -->

			<!-- <div class="icono_ajenda" data-toggle="modal" data-target="#Modal_formulario_cita">
				<img src="img/agenda-de-contactos.svg">
				<h4>¡Agenda tu cita!</h4>
			</div> -->
		</div>
		<script type="text/javascript">
			$('#myCarousel1').on('slid.bs.carousel', function (e) {
			   let elemento = $('#myCarousel1 .item.active video').first();
			   if (elemento.prop("tagName") == "VIDEO") {
			     elemento.get(0).play();
			   }
			});

			$('#myCarousel1').bind('slide.bs.carousel', function (e) {  
			   let elemento = $('#myCarousel1 .item.active video').first();
			   if (elemento.prop("tagName") == "VIDEO") {
			     elemento.get(0).pause();
			   }
			});
		</script>
	</section>
<!-- SECCION NOSOTROS -->
	<div id="indicador_menu_nosotros"></div>
	<section id="nosotros">

        <section class="descripcion_nosotros">
        	<?php foreach ($nosotros as $info_nosotros){
				$descripcion=$info_nosotros['descripcion'];
			
		 	?>
            <img src="img/logo_blanco.png">
            <p class="txt_tam_gen_home"><?php echo $descripcion; ?></p>
            <?php } ?>
        </section>
        <section class="nosotros_seccion1">
			<div class="contenido_nosotros">
				

					<div id="myCarousel12" class="carousel slide" data-ride="carousel">
					  <!-- Indicators -->
					  <ol class="carousel-indicators">
					  	
					  	<?php 
					  	$Status='';	
					  	foreach ($slider_nosotros as $slider){

					  		$id=$slider['id'];

					  		if ($id == 1){
                        	 $Status='active';

					  	?>
					   
					    <li data-target="#myCarousel12" data-slide-to="<?php echo $id; ?>" class="<?php echo $Status; ?>"></li>
					  
					<?php }else{
						?>
						 <li data-target="#myCarousel12" data-slide-to="<?php echo $id; ?>"></li>
						<?php
					} }?>
					  </ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner">
					  	<?php 
					  	 $itemStatus='';	
					  	foreach ($slider_nosotros as $slider){

					  		$nombre=$slider['nombre'];
					  		$descripcion=$slider['descripcion'];
					  		$prefijo=$slider['prefijo'];
					  		$id=$slider['id'];

					  		if ($id==1){
                        	 $itemStatus='active';

					  	?>
					  						  	
					    <div class="item <?php echo $itemStatus; ?>">
					    <h1><?php echo $nombre; ?></h1>
							<p class="txt_tam_gen_home"><?php echo $descripcion; ?>
							</p>
							<h3><?php echo $nombre.' '.$prefijo.' '; ?><img src="img/logo-texto-shifra.png"></h3>
					    </div>
						<?php }else{
							?>
							<div class="item ">
					    <h1><?php echo $nombre; ?></h1>
							<p class="txt_tam_gen_home"><?php echo $descripcion; ?>
							</p>
							<h3><?php echo $nombre.' '.$prefijo.' '; ?><img src="img/logo-texto-shifra.png"></h3>
					    </div>
							<?php
						} } ?>
					  </div>
					</div>
				</div>
		</section>
	</section>
<!-- SECCION SERVICIOS -->
	<div id="indicador_menu_servicios"></div>
	<section id="servicios">
		<div class="seccion_1_servicios">
			<div class="txt_servicios">SERVICIOS</div>
			<ul class="nav" id="flexiselDemo2">
				<?php 
					foreach ($grupo_servicios as $grupo) {
						$id = $grupo['id'];
						$nombre = explode(" ",$grupo['nombre']);
						$descripcion = ['descripcion'];
						$archivo =$ruta_base.$grupo['archivo'];
						$dir_img='background-image: url('.$archivo.');';
				 ?>
			    <!-- <li data-target="#myCarousel" data-slide-to=" <?php echo $id; ?> " class="active"> -->
			    	<li class="">
			    	<div class="contenedor_ser" style="<?php echo $dir_img; ?>">
                        <a href="index?pagina=servicios&grupo_servicios_id=<?php echo $id;?> ">
				    	<h2><font color="white"><?php echo $nombre[0]; ?></font></h2>
				    	<img src="img/vectores/vector<?php echo $id; ?>.svg">
                        </a>
					</div>
			    </li>
			    <?php } ?>
			    
			</ul>
		</div>

		<div class="seccion_2_servicios">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $itemStatus='';
                    foreach ($grupo_servicios as $grupo) {
                    $id = $grupo['id'];
                    $nombre = explode(" ",$grupo['nombre']);
                    $descripcion = $grupo['descripcion'];
                    $archivo =$ruta_base.$grupo['archivo'];
                    $dir_img='background-image: url('.$archivo.');';

                    if ($id==1){
                        $itemStatus='active';
                    ?>
                    <div class="item <?php echo $itemStatus; ?> info_servicio" style="<?php echo $dir_img; ?>">
		    		<div class="fondo_oscuro_info_servicio"></div>
		    		<div class="container-fluid">
						<div class="row col-md-12 col-sm-12 col-xs-12">
					    <div class="col-md-6 col-sm-12 col-xs-12 info_servicio_seccion">
					    	<!-- <h1>MASAJE</h1> -->
		   			 	</div>
		   			 	<div class="col-md-6 col-sm-12 col-xs-12 info_servicio_seccion" >
						<div class="container2" >
							<strong> <?php echo $nombre[0]; ?> </strong>
					    	<p class="txt_tam_gen_home"><?php echo $descripcion; ?></p>
					    </div>
					    	<a class="btn_serv" href="index?pagina=servicios&grupo_servicios_id=<?php echo $id;?> "><img src="img/iconos/WhiteReadMore.png"><span><font color="#fff">Leer más</font></span></a>
							<a class="btn_serv" href="#" data-toggle="modal" data-target="<?php echo $modal_cita; ?>"><img src="img/iconos/agendar.png"><span><font color="#fff">Agendar</font></span></a>
		   			 	</div>
			   			</div>
			   		</div>
		    	</div>
                    <?php } else{


                     ?>
                        <div class="item info_servicio" style="<?php echo $dir_img; ?>">
                            <div class="fondo_oscuro_info_servicio"></div>
                            <div class="container-fluid">
                                <div class="row col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-6 col-sm-12 col-xs-12 info_servicio_seccion">
                                        <!-- <h1>MASAJE</h1> -->
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 info_servicio_seccion" >
                                        <div class="container2" >
                                            <strong> <?php echo $nombre[0]; ?> </strong>
                                            <p class="txt_tam_gen_home"><?php echo $descripcion; ?></p>
                                        </div>
                                        <a class="btn_serv" href="index?pagina=servicios&grupo_servicios_id=<?php echo $id;?> "><img src="img/iconos/WhiteReadMore.png"><span><font color="#fff">Leer más</font></span></a>
                                        <a class="btn_serv" href="#" data-toggle="modal" data-target="<?php echo $modal_cita; ?> "><img src="img/iconos/agendar.png"><span><font color="#fff">Agendar</font></span></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }}?>

		  	</div>
		  	<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			    <span class="sr-only">Previous</span>
			</a>
		  	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		    	<span class="glyphicon glyphicon-chevron-right"></span>
		    	<span class="sr-only">Next</span>
		 	 </a>
		</div>
		</div>
		
	</section>


<!-- SECCION CITAS -->
<div id="indicador_menu_citas"></div>
	<section id="citas">
		<div class="citas_fondo"></div>
		<div class="container-fluid descripcion_inicio">
			<div class="row">
		    <div class="col-sm-12 col-md-6 citas_logo"></div>
		    <div class="col-sm-12 col-md-6 citas_formulario">
		    	<h1><strong>PROGRAMA</strong> TU CITA</h1>
		    	<center><img src="img/logo_negro.svg"></center>
		    	<div class="col-xs-12 col-sm-6 col-md-12 col-lg-6">
		    		<center>
		    		<p  class=" txt_tam_gen_home_citas">Evita el tiempo de espera para tu turno, Ahora es más sencillo agendar una cita desde nuestra página.</p>
		    		<span> ¡Tu experiencia inicia aquí!</span></br></br>
		    		<p class="espacio_boton"><a class=" btn-transparent btn-rounded btn-large" href="#" data-toggle="modal" data-target="<?php echo $modal_cita; ?>">Iniciar</a></p>

					</center>
		    	</div>
		    	<div class="col-xs-12 col-sm-6 col-md-12 col-lg-6">
		    		<center>
		    		<p  class="txt_tam_gen_home_citas">Si aún no eres cliente, regístrate ahora mismo y recibe nuestras promociones especiales y vive la mejor experiencia en nuestros servicios.</p>
		    		<span> ¿Quién te quiere? <strong>Shifra Spa</strong></span></br></br>
					<p class="espacio_boton"><a class=" btn-transparent btn-rounded btn-large" href="#" data-toggle="modal" data-target="<?php echo $SesionModal; ?>">Ingresar</a></p>
					</center>
		    	</div>
			</div>
			</div>
		</div>
	</section>
<!-- SECCION INSTALACIONES -->
	<section id="instalaciones">
		<div class="txt_servicios">INSTALACIONES</div>
		<ul id="flexiselDemo3">

			<?php

				foreach ($instalaciones as $instalacion) {
					$id = $instalacion['id'];
                    $nombre = $instalacion['nombre'];
                    $archivo =$ruta_base.$instalacion['archivo'];
                    $dir_img='background-image: url('.$archivo.');';
	
		 	?>

			<li data-target="#myCarrusel2" data-slide-to="<?php echo $id; ?>">
				<div data-toggle="modal" data-target="#exampleModal" class="contenedor_inst" style="<?php echo $dir_img; ?>"><div class="sombreado_galeria_instalaciones"><img src="img/lupa-con-un-ojo-blanco.svg"></div></div>
			</li>
		    <?php } ?>
		</ul>

		<!-- Imagen Modal -->
		<div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		  	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		    <div class="contedos_galeria_modal ">

		    <div class="modal-body">
		    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        		<span aria-hidden="true">&times;</span>
	        	</button>
		      	<div id="myCarrusel2" class="carousel slide" data-ride="carousel" >
			    <div class="carousel-inner">

			    	 <?php
                    $itemStatus='';
                    foreach ($instalaciones as $datos) {
                    $id = $datos['id'];
                    $nombre =$datos['nombre'];
                    $archivo =$ruta_base.$datos['archivo'];
                    $dir_img='background-image: url('.$archivo.');';



                    if ($id==1){
                        $itemStatus='active';
                    ?>
                    <div class="item <?php echo $itemStatus; ?>">
                    	<img src="<?php echo $archivo; ?>">
                    </div>
                	<?php }else
                		$id-=1;
                	{ ?>
                    <div class="item">
                    	<img src="<?php echo $archivo; ?>">
                    </div>
                	<?php } } ?>
        		</div>
			  	</div>
	      	</div>
		    </div>
		  	</div>


		  	<!-- <a href="#myCarrusel2"  data-slide="prev"> muevete a la izquierda</a> -->
		    <a class="carousel-control" href="#myCarrusel2" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			    <span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarrusel2" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			    <span class="sr-only">Next</span>
			</a>
		</div>
	</section>

<!-- SECCION PROMOCIONES -->
	<div id="indicador_menu_promociones"></div>
	<section id="promociones">
		<div class="txt_servicios">PROMOCIONES</div>
		<ul id="flexiselDemo4">
            <?php
            foreach ($promociones as $promo) {
            $id = $promo['id'];
            $nombre = $promo['nombre'];
            $descripcion = $promo['descripcion'];
            $descuento = $promo['descuento'];
            $archivo=$ruta_base.$promo['archivo'];
            $promociones_tipo_id = $promo['promociones_tipo_id'];
            ?>
		    <li><a href="index?pagina=promociones&promocion_id=<?php echo $id;?>" title=""><div class="contenedor_promo" style="background-image: url( <?php echo $archivo;?>);"></div></a></li>
		    <?php }?>
		 </ul>
	</section>
<!-- SECCION UBICACION -->
	<div id="indicador_menu_ubicacion"></div>
	<section id="ubicacion">
		<div class="txt_servicios">UBICACIÓN</div>
		<div class="ubicacion_mapa">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d466.4959561678693!2d-103.41198747623476!3d20.711538246202448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428af03b8d9c2b5%3A0xba20d3c808e05657!2sShifra+Spa!5e0!3m2!1ses!2smx!4v1525540080187" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</section>