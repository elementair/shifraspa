<!--MODAL SALIR -->
<div class="modal fade" id="Modal_salir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div style="left: 10px;" class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      	<div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <p class="modal-title" id="exampleModalLabel">
	        	<img src="img/logo_blanco.png">	
	        </p>					    
      	</div>
      	<div class="modal-body">
      		<div class="row">
      		


      		 <ul class="nav nav-tabs">
			    <li class="active"><a data-toggle="tab" href="#perfil">Perfil</a></li>
			    <li><a data-toggle="tab" href="#listacitas">Citas</a></li>
				<!-- <li><a data-toggle="tab" href="#prepagos">Prepagos</a></li> -->
			    <li><a data-toggle="tab" href="#editarperfil"><span class="glyphicon glyphicon-cog"></span></a></li>
			  </ul>

		    <div class="tab-content">

			  <!--================================
			  =            TAB PERFIL            =
			  =================================-->			  

			    <div id="perfil" class="tab-pane fade in active">
			      
	      			<?php 
						foreach ($clientes as $cliente) {
							$imagen='';
							$id_cliente = $cliente["id"];
							$nombre_cliente = $cliente["nombre"];
							$c_electronico_cliente = $cliente["c_electronico"];
							$telefono_cliente = $cliente["telefono"];
							$archivo_cliente = $cliente["archivo"];
							$modo_cliente = $cliente["modo"];
							
							if ($modo_cliente=='directo') {
								$imagen=$ruta_base.$archivo_cliente;
							}else{
								$imagen=$archivo_cliente;

							}		
					?>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 fup">
						

						<div class="col-md-8 col-lg-offset-2 foto_usuario_perfil" align="center">
							<img src="<?php echo $imagen; ?>" >
						</div>
						
						
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nup">

						<div class="nombre_usuario_perfil">
							<p ><span style="text-transform: capitalize;"><?php echo $nombre_cliente; ?> </span><br>
						
						<?php echo $c_electronico_cliente; ?></p>
							
						</div>		
						
					</div>

					<div class="datos_session">
						<div class="nombre" style="display: none;"></div>
						<div class="correo" style="display: none;"></div>
						<div class="telefon" style="display: none;"></div>			
					</div>

					<?php 
						} 
					?>

			    </div>

			    <!--================================
			 	=            TAB LISTA             =
			  	=================================-->	

			    <div id="listacitas" class="tab-pane fade">

			    	<div class="table-responsive">

						<table class="table lista_citas">
							 
							<thead class="thead-dark">
								<tr>
									<th><span class="glyphicon glyphicon-time"></span> Reguitro</th>
									<th><span class="glyphicon glyphicon-flag"></span> Servicio</th>
									<th><span class="glyphicon glyphicon-calendar"></span> Día</th>
									<th><span class="glyphicon glyphicon-time"></span> inicio</th>
									<th><span class="glyphicon glyphicon-time"></span> fin</th>
									<th><span class="glyphicon glyphicon-time"></span> Duración</th>
									<th><span class="glyphicon glyphicon-bell"></span> Estado</th>
								</tr>
							</thead>
							
							<tbody>
								

							 	<?php							 
							 	$contador=1;
				      			$citas=mysqli_query($link,'SELECT cliente_id, nombre_servicio, fecha, fecha_operacion,hora_inicio, hora_fin, duracion, total, email, status FROM control_citas WHERE cliente_id="'.$id_cliente.'" ORDER BY fecha_operacion desc');

						      	foreach ($citas as $cita) {

									$nombre   = $cita["nombre_servicio"];
									$fecha_operacion   = $cita["fecha_operacion"];
									$fecha    = $cita["fecha"];
									$horai     = explode(" ",$cita["hora_inicio"]);
									$horaf     = explode(" ",$cita["hora_fin"]);
									$duracion = $cita["duracion"];
									$total    = $cita["total"];
									$estado   = $cita["status"];

									$date = date_create($fecha_operacion );
									$final_fecha = date_format($date, 'H:i - d/m/Y');

									$estilo_estado='';
									$contenido_estado='';
									/*==============================================================
											Obtenemos la fecha actual
									==============================================================*/
									$fecha_actual = new DateTime();
									$fecha_actual->modify('-6 hours');
									$fecha_actual->modify('0 minute');
									$fecha_actual->modify('0 second');
									
									$fecha_entrada = $cita["hora_fin"];


									/*==============================================================
											mostramos las citas pendientes y caducadas 
									==============================================================*/
									// 01/04/2019 18:30 29/03/2019 15:18
									if($fecha_actual->format('d/m/Y H:i') > $fecha_entrada)
									{
										$estilo_estado='agendado';
										$contenido_estado='pendiente';
										
									}
									else{
										
										$estilo_estado='caducado';
										$contenido_estado='caducado';
										
									}
									// var_dump($fecha_actual->format('d/m/Y H:i'));
									/*==============================================================
											mostramos las citas que se esten atendiendo.
									==============================================================*/
									if($fecha_actual->format('d/m/Y H:i') > $cita["hora_inicio"] AND $fecha_actual->format('d/m/Y H:i') < $fecha_entrada){

										$estilo_estado='atendiendo';
										$contenido_estado='en proceso';

									}

								?>
								<tr class="filas">
									<td><span style="font-size:.8em; color:orange;"><?php echo $final_fecha; ?><span></td>
									<td><?php echo $nombre; ?></td>
									<td><?php echo $fecha; ?></td>
									<td><?php echo date("g:i a",strtotime($horai[1])); ?></td>
									<td><?php echo date("g:i a",strtotime($horaf[1])); ?></td>
									<td><?php echo $duracion.'min'; ?></td>
									<td><span class="<?php echo $estilo_estado; ?>" title="<?php echo $fecha_actual->format('d/m/Y H:i').$fecha_entrada;  ?>"><?php echo $contenido_estado; ?></span></td>
								</tr>
								
								<?php  $contador += 1; } ?>
								
							</tbody>
							
						
						
						</table>
						<p class="view-style">Estas son tus ultimas 5 citas, 
						<span class="view-more-cita"> ver mas...</span>

						</p>
					
						<!-- <a class="well" id="idlistacitas"><span class="glyphicon glyphicon-triangle-bottom"></span>ver historial completo</a> -->
							

					</div>
				
			    </div>

			     <!--================================
			 	=            TAB EDITAR PERFIL      =
			  	=================================-->	

			    <div id="editarperfil" class="tab-pane fade">

			    	<div class="form">
					    <form data-toggle="validator" role="form" name="index" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
				            <input type='hidden' name='accion' value='registra'>

				            <div class="col-md-10 col-md-offset-1 contenedor_editar_perfil">
				            	
					            <div class="col-lg-5">
					             	<div class="col-md-12 imagen_perfil">
					             		
										<img id="blah" src="<?php echo $imagen; ?>" alt="your image" title="Solicite cambiar su foto de perfil a un administrador" />

										<!-- <input type='file' name="archivo_mod" onchange="readURL(this);"/><br /> -->

									</div>

					            </div>

					            <div class="col-lg-7">
					            	<div class="col-md-12" style="display: none;">
					                	<div class="form-group">
					                    <input class="form-control" name="id_mod" id="idMod" placeholder="Nombre y apellidos*" type="text" data-error="complete el campo"  value="<?php echo $id_cliente; ?>" required>
					                	</div>
					                </div>

					                <?php 

					                	$estado_edicion = '';

					                	if ($modo_cliente == 'facebook') {
					                		
					                		$estado_edicion = 'disabled';
					                	}

					                 ?>

					            	<div class="col-md-12">
					                	<div class="form-group">
					                    <input class="form-control" name="nombre_mod" id="nombreMod" placeholder="Nombre y apellidos*" type="text" data-error="complete el campo"  value="<?php echo $nombre_cliente; ?>" <?php echo $estado_edicion; ?> >
					                	</div>
					                </div>
					               
					                <div class="col-md-12">
					                	<div class="form-group">
					                    <input class="form-control" name="telefono_mod" id="telefonoMod" placeholder="Teléfono*" type="tel" data-error="complete el campo" value="<?php echo $telefono_cliente; ?>" >
					                	</div>
					                </div>
					                <div class="col-md-12" >
					                    <div class="form-group">
					                    <input class="form-control" name="c_electronico_mod" id="c_electronicoMod" placeholder="Correo electrónico*" type="email" data-error="complete el campo" value="<?php echo $c_electronico_cliente; ?>" <?php echo $estado_edicion; ?> >
					                    </div>
					                </div>

					                <div class="col-md-12">
						                <div class="form-group">						             
						                    <button type="submit" id="modifica" name="btnModifica" class="btn col-md-12 ">Guardar</button><br>
						                </div>
							        </div> 	
					            </div>

					        </div> 

				        </form>

				    </div>
				
			    </div>

				<div id="prepagos" class="tab-pane fade">


				<table class="table lista_citas">
							 
							<thead class="thead-dark">
								<tr>
									<th><span class="glyphicon glyphicon-time"></span> Reguitro</th>
									<th><span class="glyphicon glyphicon-flag"></span> Servicio</th>
									<th><span class="glyphicon glyphicon-calendar"></span> Día</th>
									<th><span class="glyphicon glyphicon-time"></span> inicio</th>
									<th><span class="glyphicon glyphicon-time"></span> fin</th>
									<th><span class="glyphicon glyphicon-time"></span> Duración</th>
									<th><span class="glyphicon glyphicon-bell"></span> Estado</th>
								</tr>
							</thead>
							
							<tbody>
								

							 	<?php							 
							 	$contador=1;
				      			$citas=mysqli_query($link,'SELECT cliente_id, nombre_servicio, fecha, fecha_operacion,hora_inicio, hora_fin, duracion, total, email, status FROM control_citas WHERE cliente_id="'.$id_cliente.'" ORDER BY fecha_operacion desc');

						      	foreach ($citas as $cita) {

									$nombre   = $cita["nombre_servicio"];
									$fecha_operacion   = $cita["fecha_operacion"];
									$fecha    = $cita["fecha"];
									$horai     = explode(" ",$cita["hora_inicio"]);
									$horaf     = explode(" ",$cita["hora_fin"]);
									$duracion = $cita["duracion"];
									$total    = $cita["total"];
									$estado   = $cita["status"];

									$date = date_create($fecha_operacion );
									$final_fecha = date_format($date, 'H:i - d/m/Y');

									$estilo_estado='';
									$contenido_estado='';
									/*==============================================================
											Obtenemos la fecha actual
									==============================================================*/
									$fecha_actual = new DateTime();
									$fecha_actual->modify('-6 hours');
									$fecha_actual->modify('0 minute');
									$fecha_actual->modify('0 second');
									
									$fecha_entrada = $cita["hora_fin"];


									/*==============================================================
											mostramos las citas pendientes y caducadas 
									==============================================================*/
									// 01/04/2019 18:30 29/03/2019 15:18
									if($fecha_actual->format('d/m/Y H:i') < $fecha_entrada)
									{
										$estilo_estado='agendado';
										$contenido_estado='pendiente';
										
									}
									else{
										
										$estilo_estado='caducado';
										$contenido_estado='caducado';
										
									}
									// var_dump($fecha_actual->format('d/m/Y H:i'));
									/*==============================================================
											mostramos las citas que se esten atendiendo.
									==============================================================*/
									if($fecha_actual->format('d/m/Y H:i') > $cita["hora_inicio"] AND $fecha_actual->format('d/m/Y H:i') < $fecha_entrada){

										$estilo_estado='atendiendo';
										$contenido_estado='en proceso';

									}

								?>
								<tr class="filas">
									<td><span style="font-size:.8em; color:orange;"><?php echo $final_fecha; ?><span></td>
									<td><?php echo $nombre; ?></td>
									<td><?php echo $fecha; ?></td>
									<td><?php echo date("g:i a",strtotime($horai[1])); ?></td>
									<td><?php echo date("g:i a",strtotime($horaf[1])); ?></td>
									<td><?php echo $duracion.'min'; ?></td>
									<td><span class="<?php echo $estilo_estado; ?>" title="<?php echo $fecha_actual->format('d/m/Y H:i').$fecha_entrada;  ?>"><?php echo $contenido_estado; ?></span></td>
								</tr>
								
								<?php  $contador += 1; } ?>
								
							</tbody>
							
						
						
						</table>
						<p class="view-style">Estas son tus ultimas 5 citas, 
						<span class="view-more-cita"> ver mas...</span>

						</p>

						

				</div>

			 </div>
	    	<div class="col-sm-12 modal-footer">
	    	<div class="form">
		        <form name="index" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
	    		<div class="form-group">
	    		<a href="#editarperfil" title=""></a>
	   			
	    		<a data-toggle="modal" data-target="#Modal_formulario_cita" class="nueva_cita">Nueva Cita</a>
	    		
	<!--	                		<button name="btnHitorial"class="btn col-md-12 ">Mis Citas</button>-->
	    		<button name="btnSalir" class="btn ">Cerrar Sesión</button>
	    		<button type="button" class="btn" data-dismiss="modal">Salir</button>
	    		
	    		</div>
	    		</form>
	    	</div>

	    	<!-- <button type="button" class="btn" id="prevBtn" onclick="nextPrev(-1)">Regresar</button>
		    <button type="button" name="siguiente" class="btn" id="nextBtn" onclick="nextPrev(1)">Continuar</button> -->
	    	<!-- <button type="button" class="btn">Continuar</button> -->
	        
	        
	    </div>
	  	
            	

        	</div>
      	</div>
      	

    </div>
	</div>
</div>
	<!-- SECCION FORMULARIO LOGIN -->
		<div class="modal fade" id="Modal_formulario_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content ">
		      	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<h6 class="modal-title" id="exampleModalLabel"><strong> <img src="img/logo_blanco.png"></strong></h6>
				</div>
		      	<div class="modal-body">
		      	<div class="row">
	      		<div class="panel-group" id="accordion">

	      		<!-- FORMULARIO lOGIN -->
					<div class="panel">
					    <div id="collapse1" class="panel-collapse collapse in">
					    <div class="panel-body formulario_style">
					      	<div class="col-md-8 col-md-offset-2">
						      	<h4 class="panel-title">
						        	<center><h3><font color="#4D0000">¡Iniciar Sesión! </font></h3></center>
						      	</h4>
						    </div>
					      	<div class="form">
					            <form data-toggle="validator" role="form" name="index" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
					            	<div class="col-md-8 col-md-offset-2 mensajes_de_error"></div>
					                <div class="col-md-8 col-md-offset-2 logo"></div>

					                 <div class="col-xs-12 col-sm-8  facebook" align="center">
										<p>
										  <i class="fab fa-facebook"></i>
											Continuar con Facebook
										</p>
									</div>
					                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2" >
					                    <div class="form-group">
					                    <input class="form-control Tedit" name="c_electronico" id="correo" placeholder="Correo electrónico" type="email" data-error="complete el campo" required>
					                    </div>
					                </div>
					                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					                	<div class="form-group">
					                    <input class="form-control Tedit" name="contrasena" id="contrasena" placeholder="Contraseña" type="password" data-error="necesario" required >
					                	</div>
					                </div>
					                <!--  <div class="col-md-8 col-md-offset-2">
						                <div class="fb-login-button" data-width="300" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
						            </div> -->
						            						                
					                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					                	<div class="form-group">
					                	<br><center><button type="submit" name="btnEntrar" class="btn col-md-12">Entrar</button></center>
					                	</div>

					                </div>
					               
					                <div class=" col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 mensajes_de_error">
						        		<?php echo($m_error); ?>
						        	</div>
					                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
								      	<h4 class="panel-title">
								      	<br><center><a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><font color="#4D0000">¿Olvidaste tu contraseña?</font></a></center>
								      	</h4>
								    </div>
								    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
									    <h4 class="panel-title">
									    <br><center><a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><font color="#4D0000">Crear una cuenta</font></a></center>
									    </h4>
								    </div>
					            </form>
				      		</div>
					    </div>
					    <div class="col-sm-12 modal-footer">
					        <button type="button" class="btn" data-dismiss="modal">Salir</button> 
					    </div>
					    </div>
					</div>

				<!-- FORMULARIO RECUPERAR CONTRACEÑA -->
					<div class="panel">						    
					    <div id="collapse2" class="panel-collapse collapse">
					    <div class="panel-body formulario_style">
					      	<div class="col-md-8 col-md-offset-2">
						      	<h4 class="panel-title">
						        	<center><h3><font color="#4D0000">¿Olvidaste tu contraseña?</font></h3></center>
						      	</h4>
						    </div>
						    <div class="form">
					      	<form data-toggle="validator" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
				                <div class="col-md-8 col-md-offset-2">
			                    <div class="form-group">
			                        <input class="form-control Tedit" name="c_electronico" id="correo" placeholder="Ingresa tu correo electrónico" type="email" data-error="verifica tu correo electrónico" required >
			                    </div>
				                </div> 
							    <div class="col-md-8 col-md-offset-2">
				                	<center><br>
				                    <button type="submit" name="btnRecuperar" class="btn col-md-12 ">Enviar</button>
				                    <br><a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><font color="#4D0000">Regresar</font></a>
				                    </center>
					            </div>                      
				            </form>
					        </div>
					    </div>
					    </div>
					</div>

				<!-- FORMULARIO REGUISTRA -->
					<div class="panel">
					    <div id="collapse3" class="panel-collapse collapse">
					    <div class="panel-body formulario_style">
					      	<div class="col-md-8 col-md-offset-2">
						      <h4 class="panel-title">
						        <center><h3><font color="#4D0000">¡Crear una cuenta!</font></h3></center>
						      </h4>
						    </div>
						    <div class="form">
					      	<form data-toggle="validator" role="form" name="index" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
				            <input type='hidden' name='accion' value='registra'>
				                <div class="col-md-8 col-md-offset-2">
				                	<div class="form-group">
				                    <input class="form-control" name="nombre" id="nombre" placeholder="Nombre y apellidos*" type="text" data-error="complete el campo" required>
				                	</div>
				                </div>
				               
				                <div class="col-md-8 col-md-offset-2">
				                	<div class="form-group">
				                    <input class="form-control" name="telefono" id="telefono" placeholder="Teléfono*" type="tel" data-error="complete el campo" required>
				                	</div>
				                </div>
				                <div class="col-md-8 col-md-offset-2" >
				                    <div class="form-group">
				                    <input class="form-control" name="c_electronico" id="c_electronico" placeholder="Correo electrónico*" type="email" data-error="complete el campo" required>
				                    </div>
				                </div>
				                <div class="col-md-8 col-md-offset-2">
				                	<div class="form-group">
				                    <input class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña*" type="password" data-minlength="6" data-error="complete el campo" required>
				                	</div>
				                </div>
				                <div class="col-md-8 col-md-offset-2">
				                	<div class="form-group">
				                    <input class="form-control" name="confirma_contrasena" id="confirma_contrasena" placeholder="Confirmar contraseña*" type="password" data-error="complete el campo" required>
				                	</div>
				                </div> 	
				                <div class="col-md-8 col-md-offset-2">
				                	<div class="form-group">	
				                	<center><br>
				                    <button type="submit" id="reguistra" name="btnReguistra" class="btn col-md-12 ">Registrarse</button><br>
				                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><font color="#4D0000">Regresar</font></a>
				                    </center>
				                    </div>
					            </div>
				            </form>
				          	</div>
					    </div>
					    </div>
					</div>
					
				</div>
		     	</div>
		  	  	</div>
			</div>
			</div>
		</div>
		