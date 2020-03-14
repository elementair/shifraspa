<section id="seccion_promociones">

<div class="col-sm-12 col-md-12">

    <div class="col-md-12 col-lg-10 col-lg-offset-1">

       <?php
           foreach ($promociones as $promo) {

               $id_promo = $promo['id'];
               $nombre = $promo['nombre'];
               $descripcion_promo = $promo['descripcion'];
               $descuento = $promo['descuento'];
               $archivo = $promo['archivo'];
               $promociones_tipo_id = $promo['promociones_tipo_id'];
               ?>

               <div class="titulo_promo col-md-12">
                   <h1><?php echo $nombre; ?></h1>
                   <hr style="opacity: .5">
               </div>
               <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
                   <img src="<?php echo $ruta_base.$archivo;?>"  style="width: 100%">
               </div>

               <!--====================================
                               SERVICIOS INCLUIDOS
               =====================================-->
               <div class="col-xs-12 col-sm-4 col-md-6 col-lg-8">
                   <?php
                   if ($promociones_tipo_id==1){
                       foreach ($tipo_individual as $individual){
                           $id=$individual['id'];
                           $promocion_id=$individual['promociones_id'];
                           $servicios_id=$individual['servicios_id'];

                           foreach ($servicios as $servicio) {
                               $id_servicio = $servicio['id'];
                               $nombre = $servicio['nombre_servicio'];
                               $archivo = $servicio['archivo'];

                               $descripcion = $servicio['descripcion'];
                               $caracteristicas = $servicio['caracteristicas'];
                               $duracion = $servicio['duracion'];
                               $precio = $servicio['precio'];

                               $nombre_subgrupo = $servicio['nombre_subgrupo'];
                               $subgrupo_servicios_id=$servicio['subgrupo_servicios_id'];
                               $nombre_grupo = $servicio['nombre_grupo'];
                               $grupo_servicio_id=$servicio['grupo_servicio_id'];

                               // mostrar dependiendo el tipo de promocion

                               if($id_promo==$promocion_id AND $servicios_id==$id_servicio){

                                   ?>

                                   <div class="col-sm-4 col-md-4 col-lg-2">
                                       <img src="img/promos.png"  style="width: 50%; position: absolute; right: 5px;top: 0px;">
                                       <div style="height: 150px; text-align: center; background-size:cover; background-repeat:no-repeat; background-position:center; background-image: url('<?php echo $ruta_base.$archivo; ?>'); color: #4D0000; margin-top: 8px; margin-bottom: 10px"></div>
                                       <p style="text-align:center; padding-top: 5px;"><?php echo $nombre?></p>
                                       <center>

                                           <div class="btn-default btn-md" style="cursor: pointer; border-radius: 10px; color: #000;" ><a href="index?pagina=servicio_individual&servicio_id=<?php echo $id_servicio; ?>&grupo_servicio_id=<?php echo $subgrupo_servicios_id; ?>"><font color="#4D0000">
                                               <p style="padding-bottom: 25px;">VER DETALLES</p> </font></a></div>
                                       </center>
                                   </div>
                                   <?php
                               }
                           }
                       }
                       //consulta
                   }else if ($promociones_tipo_id==2){

                       foreach ($tipo_grupal as $grupal){
                           $id=$grupal['id'];
                           $promocion_id=$grupal['promociones_id'];
                           $grupo_servicios_id=$grupal['grupo_servicios_id'];

                           foreach ($servicios as $servicio) {
                           $id_servicio = $servicio['id'];
                           $nombre = $servicio['nombre_servicio'];
                           $archivo = $servicio['archivo'];

                           $descripcion = $servicio['descripcion'];
                           $caracteristicas = $servicio['caracteristicas'];
                           $duracion = $servicio['duracion'];
                           $precio = $servicio['precio'];

                           $nombre_subgrupo = $servicio['nombre_subgrupo'];
                           $subgrupo_servicios_id=$servicio['subgrupo_servicios_id'];
                           $nombre_grupo = $servicio['nombre_grupo'];
                           $grupo_servicio_id=$servicio['grupo_servicio_id'];

                           // mostrar dependiendo el tipo de promocion

                           if($id_promo==$promocion_id AND $grupo_servicios_id==$grupo_servicio_id){

                           ?>

                           <div class="col-sm-12 col-md-4 col-lg-3">
                               <img src="img/promos.png"  style="width: 50%; position: absolute; right: 5px;top: 0px;">
                                <div style="height: 150px; text-align: center; background-size:cover; background-repeat:no-repeat; background-position:center; background-image: url('<?php echo $ruta_base.$archivo; ?>'); color: #4D0000; margin-top: 8px; margin-bottom: 10px"></div>
                                       <p style="text-align:center; padding-top: 5px;"><?php echo $nombre?></p>
                               <center>

                                   <div class="btn-default btn-md" style="cursor: pointer; border-radius: 10px; color: #000;" ><a href="index?pagina=servicio_individual&servicio_id=<?php echo $id_servicio; ?>&grupo_servicio_id=<?php echo $subgrupo_servicios_id; ?>"><font color="#4D0000">
                                              <p style="margin-bottom: 25px;" >VER DETALLES</p> </font></a></div>
                               </center>
                           </div>
                           <?php
                           }
                           }
                       }

                   }
                   ?>

               </div>
                <div class="col-md-12 informacion_promocion">
                <hr style="opacity: .5">
                <div class="container">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <h4><?php echo $descripcion; ?></h4>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-6" align="center">
                      <label class="container" >
                        <input type="radio" class="capturar_valor_promocion" name="deacuerdo"   value="null" recibe_id="null" recibe_precio="null" recibe_nombre="null" recibe_duracion="null">

                        <div class="respuesta">

                        </div>

                        <span data-toggle="modal" data-target="null" class="checkmark2" title="Agendar el paquete completo">AGENDAR PAQUETE</span>
                      </label>
                  </div>

                </div>

               </div>

               <?php
           }
       ?>
    </div>
</div>

</section>