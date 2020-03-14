<?php
session_start();
require_once ('./servicio/consulta.php');
require_once "./config/ruta.php";
$datos = new consulta();
$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;
$mensaje = False;
$m_error="";
$ruta_base_menu='';

$usuario_session='usuario_session';
$usuario='usuario';
$res_nombre='';
$res_email='';
$res_phone='';
$MJEerror='';
$etiqueta="INICIAR";
$SesionModal="#Modal_formulario_login";
$img_inicio_ruta="img/svg/icono_ingresar.svg";
$ruta_base=$ruta_universal.'sistema/';
/*
* 
**************************************
*
Control session
*
**************************************
*
*/
require_once ('./servicio/controlSession.php');

$grupo_servicios=mysqli_query($link,"SELECT id, nombre, descripcion, archivo FROM grupo_servicios WHERE status=1;");
$promociones = mysqli_query($link, "SELECT id,nombre,descripcion,archivo, descuento,promociones_tipo_id,status FROM promociones WHERE status=1;");

$slider_inicio=mysqli_query($link,"SELECT id, nombre, descripcion, boton, url, archivo FROM slider_inicio WHERE status=1;");
$video_inicio=mysqli_query($link,"SELECT archivo FROM video_inicio;");

$nosotros=mysqli_query($link,"SELECT id, descripcion FROM nosotros WHERE id=1;");
$slider_nosotros=mysqli_query($link,"SELECT id, nombre, descripcion, prefijo FROM slider_nosotros WHERE status=1;");
$instalaciones=mysqli_query($link,"SELECT id, nombre, archivo FROM instalaciones WHERE status=1;");
$ajustes=mysqli_query($link,"SELECT id, telefono_1, telefono_2, whatsapp, email_contacto FROM ajustes;");

?>
<!DOCTYPE html>
<html lang="es-Mx">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="Free Web tutorials">
  	<meta name="keywords" content="shifra,shifraspa,shifraspaandares,spa,spa andares,medical center,masajes,tratamientos,spa guadalajara,spa andares">
  	<meta name="author" content="creactiv media">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">   
	<title>Shifra Spa</title>
	<!--
	* 
	**************************************
	*
	Esilos CSS
	*
	**************************************
	*
	-->
	<link rel="shortcut icon" type="image/ico" href="img/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">

	<link href="css/style.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="css/politicas.css">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">

	<!-- control carrusel -->
	<link rel="stylesheet" type="text/css" href="css/MyCarrusel.css">
	<link href="css/modulo_citas.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="css/animate.css">
  	<link rel="stylesheet" type="text/css" href="css/step_form_style.css">


	<!-- Simple Slider -->
	<link href="css/simple-sidebar.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/> -->

	<!--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
	<link rel="stylesheet" type="text/css" href="bootstrap/datepicker/css/datepicker.css">

	<!----------------------------------
	-- video-autoplay --
	------------------------------------>
		
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

	<script src="js/empleadoslista.js"></script>

</head>

<!-- <body id="top" oncontextmenu="return false" onkeydown="return false"> -->
<body id="top">
<!--
* 
**************************************
*
MOSTRAR MENSAJES DE CONFIRMACION DE ACCIONES
*
**************************************
*
-->

	<script>
	
	<?php
		if($mensaje){
			if($_GET["mensaje"]=="registro_noaceptado" OR $_GET["mensaje"]=="usuario_invalido" OR $_GET["mensaje"]=="registro_nomodificado" ){

				?>
					swal({
						title: "Oops!",
						text: "<?php echo $mensaje; ?>",
						type: "warning"
					}).then(function() {
						window.location = "<?php echo $ruta_universal;?>";
					});
				<?php	

			}else{
		?>
		swal({
			title: "Wow!",
			text: "<?php echo $mensaje; ?>",
			type: "success"
		}).then(function() {
			window.location = "<?php echo $ruta_universal;?>";
		});
		<?php
			}
		}
	?>
	</script>

	<?php
	/*
	* 
	**************************************
	*
	INCLUIMOS EL MENU POR DEFECTO
	*
	**************************************
	*
	*/
	include_once "views/modulos/menu.php";
	/*
	* 
	**************************************
	*
	COMENZAMOS CON LAS URL AMIGABLES
	*
	**************************************
	*
	*/
	$base="views/seccion/";
	global $rutas;

	$rutas = array();

	if(isset($_GET["pagina"])){
		$rutas = explode("/", $_GET["pagina"]);

		// Mi perfil
		if ($rutas[0] == "servicios") {

			/*==============================================================
				CONSULTAS PARA SERVICIOS
			==============================================================*/
			$grupo_servicios=mysqli_query($link,"SELECT id, nombre, descripcion, archivo FROM grupo_servicios WHERE status=1;");
			$ajustes=mysqli_query($link,"SELECT id, telefono_1, telefono_2, whatsapp, email_contacto FROM ajustes;");
			if (isset($_GET['grupo_servicios_id'])) {
				$datosgrupo=$_GET['grupo_servicios_id'];
				if ($datosgrupo==0){

					$servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) WHERE status=1;");

					$subgrupo_servicios = mysqli_query($link, "SELECT id, nombre, descripcion, grupo_servicios_id FROM subgrupo_servicios WHERE status=1;");

				}else{

					$servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status, s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) WHERE gs.id=$datosgrupo AND s.status=1;");

					$subgrupo_servicios = mysqli_query($link, "SELECT id, nombre, descripcion, grupo_servicios_id FROM subgrupo_servicios WHERE grupo_servicios_id=$datosgrupo AND status=1;");
					}
			}else{
				$servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) WHERE s.status=1;");

				$subgrupo_servicios = mysqli_query($link, "SELECT id, nombre, descripcion, grupo_servicios_id FROM subgrupo_servicios WHERE status=1;");
			}

			include_once $base."servicios.php";
			include "views/modulos/modulo_cita_individual.php";

		}

		// Accesorios
		elseif ($rutas[0] == "servicio_individual") {
			/*==============================================================
			CONSULTAS SERVICIOS INDIVIDUALES
			==============================================================*/
			$imagen_servicios=mysqli_query($link, "SELECT id, nombre, archivo, servicios_id FROM imagen_servicio;");

			if (isset($_GET['servicio_id'])) {

				$datoservicio=$_GET['servicio_id'];
				if ($datoservicio==0){

					$servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) WHERE s.status=1");

				}else{
					$servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) WHERE s.status=1 AND s.id=$datoservicio");

				}

			}else{
				$servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo,s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) WHERE s.status=1 AND s.id=1");
			}

			include_once $base."servicios_individuales.php";
			include "views/modulos/modulo_cita_individual.php";

		}

		// Alta usuarios
		elseif ($rutas[0] == "promociones") {
			/*==============================================================
				CONSULTAS PROMOCIONES
			==============================================================*/
			$grupo_servicios=mysqli_query($link,"SELECT id, nombre, descripcion, archivo FROM grupo_servicios WHERE status=1;");
			$tipo_individual=mysqli_query($link,"SELECT id, promociones_id, servicios_id FROM tipo_individual WHERE status=1;");
			$tipo_grupal=mysqli_query($link,"SELECT id, promociones_id, grupo_servicios_id FROM tipo_grupal WHERE status=1;");

			if (isset($_GET['promocion_id'])) {
				$datospromo = $_GET['promocion_id'];
				$promociones = mysqli_query($link, "SELECT id,nombre,descripcion,archivo, descuento,promociones_tipo_id,status  FROM promociones WHERE status=1 AND id=$datospromo");

			}
			$servicios = mysqli_query($link, "SELECT s.id ,s.nombre AS 'nombre_servicio',s.descripcion,s.caracteristicas,s.archivo, s.duracion,s.precio,s.status,s.subgrupo_servicios_id, ss.nombre AS 'nombre_subgrupo', gs.nombre AS 'nombre_grupo', gs.id AS 'grupo_servicio_id' from((servicios as s   left outer join subgrupo_servicios as ss on subgrupo_servicios_id=ss.id) left outer join grupo_servicios as gs on ss.grupo_servicios_id=gs.id) WHERE s.status=1 ");

			include_once $base."promociones.php";

		}

		// Admin usuarios
		elseif ($rutas[0] == "terminos") {
			include_once 	$base."terminos.php";

		}

		// Clientes
		elseif ($rutas[0] == "politicas") {
			include_once 	$base."politicas.php";

		}

		// Estado de Accesorios
		elseif ($rutas[0] == "demo") {
			include_once 	$base."cita.php";
			include "views/modulos/modulo_citas.php";

		} 
		elseif ($rutas[0] == "finalizar_pago") {
			include_once 	$base."finalizar.php";

		}
		elseif ($rutas[0] == "error") {
			include_once $base."error.php";

		}

		// Cita Demo
		else {
			include_once $base."error.php";
		}

		// Inicio
		}else{

		include_once $base."inicio.php";
		include "views/modulos/modulo_citas.php";



		}

	
	include "views/modulos/modulo_login.php";
	include "views/modulos/modulo_citas_lanzamiento.php";

	/*==============================================================
							INCLUIMOS EL FOOTER POR DEFECTO
	==============================================================*/
	include "views/modulos/footer.php";
	?>
	<!-- <script src="js/valida_login.js"></script>
	<script src="js/valida_registro.js"></script> -->
	<a href="#top" class="to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
	<style type="text/css">
		.panel {
		    -webkit-box-shadow: 0 0px 0px rgba(0,0,0,.05);
		    box-shadow: 0 0px 0px rgba(0,0,0,.05);
		    /* margin: 10px 0px; */
		    padding: 5px;
		}
		.to-top{
			position: fixed;
			bottom: 20px;
			right: 20px;
			background: #4c0500;
			color:#fff;
			padding: 9px 12px;
			border-radius: 30px;

		}
		.to-top:hover{
			background: #a28356;
			color:#4c0500;
		}
	</style>
	<script src="js/jquery.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	  <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<!-- datetimepicker -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="bootstrap/datepicker/js/bootstrap-datepicker.js" ></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/bootstrap-datetimepicker.es.js"></script>
	<!-- fin datetimepicker -->


	<script type="text/javascript">
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
		var nowTemp = new Date();
        	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        	$('#ya').datepicker({
          		onRender: function(date) {
           	 	return date.valueOf() < now.valueOf() ? 'disabled' : '';

          	},
          	format: "dd/mm/yyyy",
          	changeYear: false
        	});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			var offset = 250;
			var duration = 500;

			$(window).scroll(function(){
				if($(this).scrollTop()> offset){
					$('.to-top').fadeIn(duration);
				}else{
					$('.to-top').fadeOut(duration);
				}
			});
			$('.to-top').click(function(){
				$('body').animate({scrqollTop:0},duration);
			})
		});

	</script>
	<script src="js/jquery-modal-video.min.js"></script>
	<script>
		$(".js-video-button").modalVideo({
			youtube:{
				autoplay: 1,
				// controls:0,
				wmode: 'transparent',
				controls: 1,
	    	theme: 'dark',
				nocookie: true

			}
		});
	</script>
	<!----------------------------------
	-- fin video-autoplay --
	------------------------------------>
	<script>

	$(function () {

    	$('.view-more').click(function () {
        	$('.intervalo .panel-default:hidden').slice(0, 10).show();
        	if ($('.intervalo .panel-default').length == $('.intervalo .panel-default:visible').length) {
            	$('.intervalo .view-more').hide('fast');
        	}
		});

		$('.view-more-cita').click(function () {
        	$('.table-responsive .filas:hidden').slice(0, 5).show();
        	if ($('.table-responsive .filas').length == $('.table-responsive .filas:visible').length) {
            	$('.table-responsive .view-more-citas').hide('fast');
        	}
		});

	});

	</script>

	<script type="text/javascript" src="js/funciones.js"></script>
	<script src="js/verifica_folio.js"></script>

	<script type="text/javascript" src="views/js/registroFacebook.js"></script>
	<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	<script type="text/javascript" src="js/flexisel.js"></script>
	<script type="text/javascript" src="js/step_form_style.js"></script>
	<!-- <script rel="stylesheet" type="text/css" href="dist/sweetalert2.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '2269333056618746',
	      cookie     : true,
	      xfbml      : true,
	      version    : 'v3.2'
	    });
	    FB.AppEvents.logPageView();
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "https://connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
</script>

 <script type="text/javascript">
	  $(document).ready(function () {
	      $('#sidebarCollapse').on('click', function () {
	          $('#sidebar').toggleClass('active');
	          $('#sidebarCollapse2').css('display','block');

	      });
	      $('#sidebarCollapse2').on('click', function () {
	          $('#sidebar').toggleClass('active');
	          $('#sidebarCollapse2').css('display','none');

	      });

	  });
	</script>

	<script>
		// $('#myTabPay li').click(function (e) {
		 // e.preventDefault();
		    // $(this).find('a').tab('show');
		 // $(this).tab('show');
		     // $(this).closest('ul').find('input[type="checkbox"]').prop('checked','');
		     // $(this).closest('li').find('input[type="checkbox"]').prop('checked','checked');
		   
		// });
		/*
		* 
		**************************************
		*
		solicitar factura
		*
		**************************************
		*
		*/
		function showMe (box) {
        
        var chboxs = document.getElementsByName("c1");
        var vis = "none";
        var value="0";
       
	        for(var i=0;i<chboxs.length;i++) { 
	            if(chboxs[i].checked){
	             vis = "block";
	             value="";
	                break;
	            }
	        }
	        document.getElementById(box).style.display = vis;
	        document.getElementById("rfc").value=value;
	        document.getElementById("razonSocial").value=value;
         	
	    
	    
	    }

	</script>

</body>
</html>