<?php
require_once ('clases/fpdf/html2pdf.php');
require_once('config/seguridad.php');
require_once('requires.php');

$conexion = new Conexion();
$conexion->selecciona_base_datos();
$link = $conexion->link;
$seguridad = new Seguridad();
$seccion = $seguridad->seccion;
$accion = $seguridad->accion;
define('SECCION',$seccion);
define('ACCION',$accion);

if($link) {
    $modelo_accion = new accion($link);
    if (isset($_SESSION['grupo_id'])) {
        $permiso = $modelo_accion->valida_permiso(SECCION, ACCION);
        if (!$permiso) {
            $seccion = 'session';
            $accion = 'denegado';
            $_GET['tipo_mensaje'] = 'error';
            $_GET['mensaje'] = 'Permiso denegado';
        }
        $n_acciones = $modelo_accion->cuenta_acciones();
        if ($n_acciones == 0) {
            session_destroy();
        }
    }
}

$directiva = new Directivas();
if($link) {
    $template = new templates($link);
}
$name_ctl = 'controlador_'.$seccion;
$controlador = new $name_ctl($link);

$controlador->$accion();
$directivas = new Directivas();

$empresa = new Empresas();

$user_usuario='';
$foto_usuario='';
$descripcion_usuario='';
$user_id='';

if(isset($_SESSION['id'])){
    $usuario = new Usuario($link);
    $resultado_usuario = $usuario->obten_registros_session('usuario','id',$_SESSION['id']);
    $reguistros_usuario = $resultado_usuario['registros'];
    $user_id = $reguistros_usuario[0]['usuario_id'];
    $user_usuario = $reguistros_usuario[0]['usuario_user'];
    $foto_usuario = $reguistros_usuario[0]['usuario_archivo'];
    $descripcion_usuario = $reguistros_usuario[0]['usuario_descripcion'];
    
}

?>
<!DOCTYPE html>
<html>
	<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador | ShifraSpa</title>
  <link rel="shortcut icon" type="image/ico" href="views/img/admin_log.ico"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <!-- <link rel="stylesheet" href="views/dist/css/skins/skin-red.min.css"> -->
  <link rel="stylesheet" href="views/dist/css/skins/skin-guinda.min.css">
  <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="views/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="views/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="views/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="views/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="views/bower_components/select2/dist/css/select2.min.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="views/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        
        <!-- propios -->
    
  <meta charset="utf-8" name="viewport"content="
                width=device-width, height=device-height,
                initial-scale=1.0, maximum-scale=1.0, target-densityDpi=device-dpi" />
  <title>Sistema Shifra</title>
  
  <!-- <link rel="stylesheet" href="./views/css/bootstrap.min.css"> -->
  <link href="./views/css/bootstrap-select.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./views/css/layout.css">
  <!-- <link rel="stylesheet" href="./views/css/layout.css" media="print"> -->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

  <!-- editor -->

  
<!--   
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="views/bower_components/text_editor/editor.css" type="text/css" rel="stylesheet"/> -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
	<body class="hold-transition skin-red sidebar-mini img_inicio_fondo">

        <!-- <div class="wrapper"> -->
            
                
                <?php if($seguridad->menu){

                ?>
                  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>SS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>ShifraSpa</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo $foto_usuario; ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->

              <span class="hidden-xs"><?php   echo $user_usuario; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo $foto_usuario; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php
                  echo $descripcion_usuario;

                  ?>
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="text-center">
                    <a href="index.php?seccion=ajustes&accion=modifica&registro_id=1">Ajustes de contacto</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
                        
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-left">
                  <a href="index.php?seccion=session&accion=inicio" class="btn btn-default btn-flat">inicio</a>
                </div>
                <div class="pull-right">
                  <a href="index.php?seccion=session&accion=logout" class="btn btn-default btn-flat">salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>

        </ul>

      </div>
    </nav>
  </header>
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $foto_usuario; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">

          <p><?php echo $user_usuario; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree" role="navigation">
         

        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        
      
           <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
  
           <?php  echo $directiva->menu_sidebar($link); ?>
           <li class=""><a href="index.php?agenda"><i class="glyphicon glyphicon-calendar"></i> <span>AGENDA</span></a></li>
        
    
     
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
 <div class="content-wrapper">
<?php } ?>
          
		<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header container contenido">       

           <!--  <hr> -->
           <?php 
                require_once "../config/ruta.php";
            ?>
              <h3><a href="<?php echo $ruta_universal.'index.php';?>" >
                <span class="glyphicon glyphicon-credit-card" style="color: rgb(162,131,86,1); top: 5px;" title="Página Web"></span>
              </a>SHIFRA SPA</h3>
           <!--  <hr> -->
            <?php
            $class_mensaje = "";
            if(isset($_GET['tipo_mensaje'])){
                $tipo_mensaje = $_GET['tipo_mensaje'];
                if($tipo_mensaje == 'error'){
                    $class_mensaje = 'alert alert-danger';
                }
                else{
                    if($tipo_mensaje == 'exito'){

                        $class_mensaje = 'alert alert-success';
                    }
                }
            }
            if(isset($controlador->error)){
                if($controlador->error == 1){
                    $class_mensaje = 'alert alert-danger';
                    $mensaje = $controlador->mensaje;
                    ?>
                    <div class="<?php echo $class_mensaje; ?> mensaje" ><?php echo $mensaje; ?></div>
                <?php
                }
            }
            if(isset($_GET['mensaje'])){
                $mensaje = $_GET['mensaje'];
            }
            else{
                $mensaje = "";
            } ?>
            <div class="<?php echo $class_mensaje; ?> mensaje" ><?php echo $mensaje; ?></div>
            <?php
            $include = './views/'.$seccion.'/'.$accion.'.php';
            if(file_exists($include)){
                include($include);
            }
            if(ACCION == 'lista') {
                include('./views/vista_base/lista.php');
            }
            if (ACCION=='modifica'){
                include('./views/vista_base/modifica.php');
            }
            if (ACCION=='alta'){
                include('./views/vista_base/alta.php');
            } 

            if (isset($_GET['agenda'])){

               include('./calendario/index.php');
            }
            ?>
        </section>
		</div>
        <?php if($seguridad->menu){ ?>
         <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Todos los derechos reservados
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Shifra Spa</a> | </strong>

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
     
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane active" id="control-sidebar-settings-tab">
        <h3 class="control-sidebar-heading">Configuración General</h3>
         <ul class="sidebar sidebar-menu" data-widget="tree" role="navigation">
        <!-- Optionally, you can add icons to the links -->
        
        <?php if($seguridad->menu){ ?>
           <?php  echo $directiva->menu_derecha($link); ?>
        <?php } ?>
     
      </ul>
        
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
 <?php } ?>

    


<script src="views/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="views/dist/js/adminlte.min.js"></script>


<script src="views/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="views/plugins/input-mask/jquery.inputmask.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="views/bower_components/moment/min/moment.min.js"></script>
<script src="views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="views/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="views/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="views/plugins/timepicker/bootstrap-timepicker.min.js"></script>


<script type='text/javascript'>
    $('#timepicker1').timepicker();
</script>
<!-- SlimScroll -->
<script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="views/plugins/iCheck/icheck.min.js"></script>

<!-- FastClick -->
<script src="views/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<!-- <script src="views/dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="views/dist/js/demo.js"></script> -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->


<!-- <script src="./views/js/jquery.min.js"></script>   -->
<!-- <script src="./views/js/bootstrap.min.js"></script> -->


<script src="./views/js/bootstrap-select.js"></script>
<script type="text/javascript" charset="utf8" src="./views/js/dataTables.js"></script>
<script type="text/javascript" src="./views/js/funciones_base.js"></script>
<script type="text/javascript" src="./views/js/funciones.js"></script>
<script type="text/javascript" src="./views/js/bootstrap-filestyle.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="views/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- CK Editor -->
<script src="views/bower_components/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.edittextarea').wysihtml5()
  })
</script>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

 
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })

     //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    })

</script>	
	</body>
</html>