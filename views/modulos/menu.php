    <style>

@font-face{
	font-family: Montserrat-Regular;
	src: url(./fonts/Montserrat-Regular.otf);
}
a:link {
    text-decoration: none;
}
.ft_mapa a{
    color:rgb(255, 255, 255) !important;
    font-weight: 700;
}
.ft_menu a{
    color:rgb(255, 255, 255) !important;
    font-weight: 700;
}
.ft_mapa a:hover{
    color: rgb(255, 211, 148) !important;
    font-weight: 900;
}
.ft_menu a:hover{
    color: rgb(255, 211, 148) !important;
    font-weight: 900;
}
.dropbtn {
    /*background-color: #4CAF50;*/
    /*color: white;*/
    padding: 15px;
    font-size: 15px;
    font-family: Montserrat-Regular;
    /*border: none;*/
}

.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown li:hover > a{
    color:#4D0000;

}
.dropdown li a,i{
    color: #ffffff;
}
.dropdown li i{
    width: 40px;
    transform: rotate(90deg);

}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #A2835695;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: #ffffff;
    text-shadow: 1px 1px 1px #00000090;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    text-transform: capitalize;
}
.dropdown-content a:hover {
    color:#4D0000;
}
.desactive:hover{
	background: #ccccc0;

}
.desactive a:hover{
	
	color:#4D0000; 
}
.call_menu{
    display: inline-block;
    margin-top: -27px;
    position: absolute;
    font-size:13px;
    color: #A28356;
}
.pc{
    display: block;
}
.movil{
    display: none;
}


.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}
@media only screen and (max-width: 800px) {

    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: none;
    }
    .dropdown i{
       display: none;
    }
    .call_menu{
        display: none;
    }
    .pc{
        display: none;
    }
    .movil{
        display: initial;
    }

}
/*.dropdown:hover .dropbtn {background-color: #3e8e41;}*/
</style>
<header id="menu" >
	<section id="logo">
    <?php foreach ($ajustes as $ajuste) {
        
        $tel1=$ajuste['telefono_1'];
        $tel2=$ajuste['telefono_2'];
        $what=$ajuste['whatsapp'];
        $mail=$ajuste['email_contacto'];
    ?>
		<a href="index.php"><img src="img/logo-shifra.svg"></a>
		<div class="telefono_menu" style="display: none;">
			TEL. 01 (33) <?php echo $tel1; ?> <br> 01 (33) <?php echo $tel2; ?>
		</div> 
		<div class="iconos_redes_sociales">
            
            <a href="https://api.whatsapp.com/send?phone=<?php echo $what; ?>&text=Hola,%20me%20gustaria%20agendar%20una%20cita." class="social-icon whatsapp watsWeb" target="_blank"><img src="img/svg/icono_wats2.svg"></a>

            <!-- https://api.whatsapp.com/send?phone=56987654321&text=Me%20gustaría%20saber%20el%20precio%20del%20sitio%20web -->

			<a href="https://api.whatsapp.com/send?phone=<?php echo $what; ?>&text=Hola,%20me%20gustaria%20agendar%20una%20cita." class="social-icon whatsapp watsMov" target="_blank"><img src="img/svg/icono_wats2.svg"></a>

			<a href="https://www.facebook.com/ShifraSpaOficial"  target="_blank"><img src="img/svg/icono_facebook.svg"></a>
<!--			<img src="img/svg/icono_twitter.svg">-->
			<a href="https://www.instagram.com/shifra.spaoficial"  target="_blank"><img src="img/svg/icono_instagram.svg"></a>
<!--			<a href="mailto:shifraspa132@gmail.com" target="_blank"><img src="img/svg/icono_gmail.svg"></a>-->
			
			<a href="" title="<?php echo $etiqueta; ?>" data-toggle="modal" data-target="<?php echo $SesionModal; ?>"><img src="<?php echo $img_inicio_ruta; ?>" style="border-radius: 50%;"></a>
            
            <a><img class="call" src="img/svg/icono_call.svg"></a>
            <div class="call_menu">01 (33) <?php echo $tel1.'<br>01 (33) '.$tel2; ?></div>
        </div>

    <?php }?>
	</section>
	<nav id="menu_opciones" class="navbar navbar-default role="navigation">
		<div class="container">
			<div class="navmy navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu_navegacion">
					<span class="sr-only">Desplegar / Ocultar Menu</span>
					<span class="icon-bar"></span>	
					<span class="icon-bar"></span>						
					<span class="icon-bar"></span>
				</button>
				<!-- Menu -->
				<?php 
				    $ruta_base_menu	= "index";
                ?>
				<div class="collapse navbar-collapse" id="menu_navegacion">
<!--                    MOSTRAR MOVIL-->
					<ul class="nav navbar-nav movil">

						<li class="desactive" data-toggle="collapse" data-target="#menu_navegacion"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_nosotros">NOSOTROS</a></li>
                        <li class="desactive" data-toggle="collapse" data-target="#menu_navegacion"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_servicios">SERVICIOS</a></li>					
						<li class="desactive" data-toggle="collapse" data-target="#menu_navegacion"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_promociones">PROMOCIONES</a></li>
						<li class="desactive" data-toggle="collapse" data-target="#menu_navegacion"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_citas">CITAS</a></li>
						<li class="desactive" data-toggle="collapse" data-target="#menu_navegacion"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_ubicacion">UBICACIÓN</a></li>
<!--						<div class="telefono_menu_movil">-->
<!--							TEL. 01 (33) 3611-3310 <br> 01 (33) 3611-3313-->
<!--						</div>-->
					</ul>
<!--                    MOSTRAR PC-->
                    <ul class="nav navbar-nav pc">
                        <li class="desactive"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_nosotros">NOSOTROS</a></li>
                        <div class="dropdown">
                            <li class="desactive dropbtn" ><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_servicios">SERVICIOS</a><span><i class="glyphicon glyphicon-play"></i></span></li>
                            <div id="menu2" class="dropdown-content">
                                <?php
                                foreach ($grupo_servicios as $grupo_servicio) {
                                    $nombre =explode(" ",$grupo_servicio['nombre']);
                                    $id = $grupo_servicio['id'];
                                    ?>
                                    <a href="index?pagina=servicios&grupo_servicios_id=<?php echo $id; ?>"><?php echo $nombre[0]; ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                            
                        </div>
                        <li class="desactive"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_promociones">PROMOCIONES</a></li>
                        <li class="desactive"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_citas">CITAS</a></li>
                        <li class="desactive"><a href="<?php echo $ruta_base_menu; ?>#indicador_menu_ubicacion">UBICACIÓN</a></li>

                    </ul>
				</div>
			</div>
            <div class="telefono_menu_movil">

                <span class="glyphicon glyphicon-remove" id="btn_close_contacto"></span>

                 <strong>CONTÁCTANOS</strong> <br />TEL. <a href="tel:36113310">01 (33) 3611-3310</a>
            </div>
		</div>
	</nav>
	<div class="icono_ajenda" data-toggle="modal" data-target="<?php echo $modal_cita; ?>">
		<img src="img/agenda-de-contactos.svg">
		<h4>¡Agenda tu cita!</h4>
	</div> 
</header>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             