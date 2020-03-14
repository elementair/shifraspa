<?php
class consultas_base{
    public $link;


    public $pattern_rfc = "([A-Za-z]{3}|[A-Za-z]{4})[0-9][0-9](0[1-9]|1[0-2])((0[1-9])|([1-2][0-9])|3[0-1])[A-Za-z0-9]{3}";
    public $pattern_cp = "[0-9]{5}";

// ELEMENTOS BASE
    public $accion_columnas = array('seccion_menu'=>'accion', 'menu'=>'seccion_menu','accion'=>false);
    public $grupo_columnas = array('grupo'=>false);
    public $seccion_menu_columnas = array('seccion_menu'=>false, 'menu'=>'seccion_menu');
    public $estado_columnas = array('estado'=>false, 'pais'=>'estado');
    public $menu_columnas = array('menu'=>false);
    public $usuario_columnas = array('usuario'=>false,'grupo'=>'usuario');
    public $accion_grupo_columnas = array('accion_grupo'=>false,'accion'=>'accion_grupo','grupo'=>'accion_grupo','seccion_menu'=>'accion','menu'=>'seccion_menu');
    public $elemento_lista_columnas = array('elemento_lista'=>false,'seccion_menu'=>'elemento_lista','menu'=>'seccion_menu');
 // FIN ELEMENTOS BASE   

    public $clientes_columnas = array('clientes'=>false);
    public $empleados_columnas = array('empleados'=>false);
    public $grupo_servicios_columnas = array('grupo_servicios'=>false );
    public $subgrupo_servicios_columnas = array('subgrupo_servicios'=>false );
    public $promociones_tipo_columnas = array('promociones_tipo'=>false );
    public $promociones_columnas = array('promociones'=>false);
    public $servicios_columnas = array('servicios'=>false);
    public $imagen_servicio_columnas = array('imagen_servicio'=>false);
    public $servicios_empleados_columnas = array('servicios_empleados'=>false);
    public $servicios_cabinas_columnas = array('servicios_cabinas'=>false);
    public $servicios_promociones_columnas = array('servicios_promociones'=>false);
    public $control_citas_columnas = array('control_citas'=>false);
    public $cabina_columnas = array('cabina'=>false);
    public $empleados_rol_columnas = array('empleados_rol'=>false);

    //    Tipo de promociones
    public $tipo_individual_columnas = array('tipo_individual'=>false );
    public $tipo_grupal_columnas = array('tipo_grupal'=>false );
    public $tipo_subgrupal_columnas = array('tipo_subgrupal'=>false );

    //  Prepagos
    public $prepagos_columnas = array('prepagos'=>false );
    public $prepagos_cantidad_columnas = array('prepagos_cantidad'=>false );
    public $prepagos_servicios_columnas = array('prepagos_servicios'=>false );
    public $tipo_prepago_columnas = array('tipo_prepago'=>false );
    public $categoria_prepago_columnas = array('categoria_prepago'=>false );

    //    Seccion Index
    public $slider_inicio_columnas = array('slider_inicio'=>false );
    public $video_inicio_columnas = array('video_inicio'=>false );
    public $nosotros_columnas = array('nosotros'=>false );
    public $slider_nosotros_columnas = array('slider_nosotros'=>false );
    public $instalaciones_columnas = array('instalaciones'=>false );

    public $ajustes_columnas = array('ajustes'=>false );


    // Control citas
    
    public $control_cita_columnas = array('control_citas'=>false );
    public $estructura_bd;

    public function __construct(){

        // accion
        $this->estructura_bd['accion']['columnas_select'] = $this->accion_columnas;
        $this->estructura_bd['accion']['where_filtro_or'] = true;
        $this->estructura_bd['accion']['genera_or_nombre'] = array('seccion_menu','menu');
        $this->estructura_bd['accion']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'seccion_menu_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'seccion_menu','vista'=>array('alta','modifica')),
            'icono'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')),
            'visible'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'vista'=>array('alta','modifica')));

        // elemento_lista 
        $this->estructura_bd['elemento_lista']['columnas_select'] = $this->elemento_lista_columnas;
        $this->estructura_bd['elemento_lista']['where_filtro_or'] = true;
        $this->estructura_bd['elemento_lista']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'seccion_menu_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'seccion_menu','vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'vista'=>array('alta','modifica')));

        // seccion menu
        $this->estructura_bd['seccion_menu']['columnas_select'] = $this->seccion_menu_columnas;
        $this->estructura_bd['seccion_menu']['where_filtro_or'] = true;
        $this->estructura_bd['seccion_menu']['genera_or_nombre'] = array('menu');
        $this->estructura_bd['seccion_menu']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'menu_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'menu','vista'=>array('alta','modifica')),
            'icono'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'vista'=>array('alta','modifica')));

        // menu
        $this->estructura_bd['menu']['columnas_select'] = $this->menu_columnas;
        $this->estructura_bd['menu']['where_filtro_or'] = true;
        $this->estructura_bd['menu']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'icono'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'vista'=>array('alta','modifica')));

        // grupo
        $this->estructura_bd['grupo']['columnas_select'] = $this->grupo_columnas;
        $this->estructura_bd['grupo']['where_filtro_or'] = true;
        $this->estructura_bd['grupo']['campos'] = array(
            'nombre'=>array(
                'tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,
                'vista'=>array('alta','modifica')));

        // usuario
        $this->estructura_bd['usuario']['columnas_select'] = $this->usuario_columnas;
        $this->estructura_bd['usuario']['genera_or_nombre'] = array('grupo');
        $this->estructura_bd['usuario']['genera_where_base'] = 'user';
        $this->estructura_bd['usuario']['genera_or_like'] = array('email');
        $this->estructura_bd['usuario']['campos'] = array(
            'user'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'password'=>array('tipo'=>'password','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'email'=>array('tipo'=>'email','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'grupo_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'grupo','vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12, 'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>12,
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // grupo servicios
        $this->estructura_bd['grupo_servicios']['columnas_select'] = $this->grupo_servicios_columnas;
        $this->estructura_bd['grupo_servicios']['where_filtro_or'] = true;
        $this->estructura_bd['accion']['genera_or_nombre'] = array('grupo_servicios','servicios');
        $this->estructura_bd['grupo_servicios']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12, 'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12, 'requerido'=>'required',
                'vista'=>array('alta','modifica')),
             'archivo'=>array('tipo'=>'archivo','cols'=>12,
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));
        // subgrupo servicios
        $this->estructura_bd['subgrupo_servicios']['columnas_select'] = $this->subgrupo_servicios_columnas;
        $this->estructura_bd['subgrupo_servicios']['where_filtro_or'] = true;
        $this->estructura_bd['accion']['genera_or_nombre'] = array('subgrupo_servicios','grupo_servicios');
        $this->estructura_bd['subgrupo_servicios']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12, 'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12, 'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'grupo_servicios_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'grupo_servicios','vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // servicios
        $this->estructura_bd['servicios']['columnas_select'] = $this->servicios_columnas;
        $this->estructura_bd['servicios']['where_filtro_or'] = true;
        $this->estructura_bd['servicios']['genera_or_nombre'] = array('servicios');
        $this->estructura_bd['servicios']['campos'] = array(
            'nombre'=>array('tipo'=>'text', 'cols'=>12, 'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'caracteristicas'=>array('tipo'=>'textarea', 'cols'=>12, 'vista'=>array('alta','modifica')),
            'subgrupo_servicios_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'subgrupo_servicios','vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'duracion'=>array('tipo'=>'text','cols'=>6,'vista'=>array('alta','modifica')),
            'precio'=>array('tipo'=>'text','cols'=>6,'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica'))
            );

         // imagen_portafolio_servicio
        $this->estructura_bd['imagen_servicio']['columnas_select'] = $this->imagen_servicio_columnas;
        $this->estructura_bd['imagen_servicio']['where_filtro_or'] = true;
        $this->estructura_bd['imagen_servicio']['campos'] = array(
            'servicios_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'servicios','vista'=>array('alta','modifica')),
            'nombre_servicio'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // promociones
        $this->estructura_bd['promociones']['columnas_select'] = $this->promociones_columnas;
        $this->estructura_bd['promociones']['where_filtro_or'] = true;
        $this->estructura_bd['promociones']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'promociones_tipo_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'promociones_tipo','vista'=>array('alta','modifica')),
            'descuento'=>array('tipo'=>'text','cols'=>6,'vista'=>array('alta','modifica')),
            'precio'=>array('tipo'=>'text','cols'=>6,'vista'=>array('alta','modifica')),
            'fecha_inicio'=>array('tipo'=>'fecha','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'fecha_fin'=>array('tipo'=>'fecha','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // control citas
        $this->estructura_bd['control_citas']['columnas_select'] = $this->control_citas_columnas;
        $this->estructura_bd['control_citas']['where_filtro_or'] = true;
        $this->estructura_bd['control_citas']['campos'] = array(
            'servicio_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'servicios','vista'=>array('alta','modifica')),
            'nombre_servicio'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'precio'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'duracion'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'fecha'=>array('tipo'=>'fecha','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'hora_inicio'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'hora_fin'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'nombre_usuario'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'email'=>array('tipo'=>'email','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'telefono'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'opcion_pago'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'total'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));
        //promociones_tipo
        $this->estructura_bd['promociones_tipo']['columnas_select'] = $this->promociones_tipo_columnas;
        $this->estructura_bd['promociones_tipo']['where_filtro_or'] = true;
        $this->estructura_bd['promociones_tipo']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //promociones_tipo_individual
        $this->estructura_bd['tipo_individual']['columnas_select'] = $this->tipo_individual_columnas;
        $this->estructura_bd['tipo_individual']['where_filtro_or'] = true;
        $this->estructura_bd['tipo_individual']['campos'] = array(
            'servicios_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'servicios','vista'=>array('alta','modifica')),
            'promociones_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'promociones','vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //promociones_tipo_grupal
        $this->estructura_bd['tipo_grupal']['columnas_select'] = $this->tipo_grupal_columnas;
        $this->estructura_bd['tipo_grupal']['where_filtro_or'] = true;
        $this->estructura_bd['tipo_grupal']['campos'] = array(
            'grupo_servicios_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'grupo_servicios','vista'=>array('alta','modifica')),
            'promociones_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'promociones','vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //servicios promociones 
        $this->estructura_bd['servicios_promociones']['columnas_select'] = $this->servicios_promociones_columnas;
        $this->estructura_bd['servicios_promociones']['where_filtro_or'] = true;
        $this->estructura_bd['servicios_promociones']['campos'] = array(
            'servicios_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'servicios','vista'=>array('alta','modifica')),
            'promociones_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'promociones','vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // empleados
        $this->estructura_bd['empleados']['columnas_select'] = $this->empleados_columnas;
        $this->estructura_bd['empleados']['where_filtro_or'] = true;
        $this->estructura_bd['empleados']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'apellidos'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //servicios empleados 
        $this->estructura_bd['servicios_empleados']['columnas_select'] = $this->servicios_empleados_columnas;
        $this->estructura_bd['servicios_empleados']['where_filtro_or'] = true;
        $this->estructura_bd['servicios_empleados']['campos'] = array(
            'servicios_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'servicios','vista'=>array('alta','modifica')),
            'empleados_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'empleados','vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //servicios empleados 
        $this->estructura_bd['servicios_cabinas']['columnas_select'] = $this->servicios_cabinas_columnas;
        $this->estructura_bd['servicios_cabinas']['where_filtro_or'] = true;
        $this->estructura_bd['servicios_cabinas']['campos'] = array(
            'servicios_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'servicios','vista'=>array('alta','modifica')),
            'cabina_id'=>array(
                'tipo'=>'select','cols'=>6,'requerido'=>'required',
                'tabla_foranea'=>'cabina','vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //clientes
        $this->estructura_bd['clientes']['columnas_select'] = $this->clientes_columnas;
        $this->estructura_bd['clientes']['where_filtro_or'] = true;
        $this->estructura_bd['clientes']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'telefono'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'c_electronico'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'contrasena'=>array('tipo'=>'password','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //cabina
        $this->estructura_bd['cabina']['columnas_select'] = $this->cabina_columnas;
        $this->estructura_bd['cabina']['where_filtro_or'] = true;
        $this->estructura_bd['cabina']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //empleados rol 
        $this->estructura_bd['empleados_rol']['columnas_select'] = $this->empleados_rol_columnas;
        $this->estructura_bd['empleados_rol']['where_filtro_or'] = true;
        $this->estructura_bd['empleados_rol']['campos'] = array(
            'empleados_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'empleados','vista'=>array('alta','modifica')),
            'entrada'=>array('tipo'=>'hora','cols'=>3,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'salida'=>array('tipo'=>'hora','cols'=>3,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descanso'=>array('tipo'=>'hora','cols'=>3,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'duracion'=>array('tipo'=>'text','cols'=>3,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'lunes'=>array('tipo'=>'checkboxDia','cols'=>3,'vista'=>array('alta','modifica')),
            'martes'=>array('tipo'=>'checkboxDia','cols'=>3,'vista'=>array('alta','modifica')),
            'miercoles'=>array('tipo'=>'checkboxDia','cols'=>3,'vista'=>array('alta','modifica')),
            'jueves'=>array('tipo'=>'checkboxDia','cols'=>3,'vista'=>array('alta','modifica')),
            'viernes'=>array('tipo'=>'checkboxDia','cols'=>3,'vista'=>array('alta','modifica')),
            'sabado'=>array('tipo'=>'checkboxDia','cols'=>3,'vista'=>array('alta','modifica')),
            'domingo'=>array('tipo'=>'checkboxDia','cols'=>3,'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>3,'vista'=>array('alta','modifica')));

        // slider inicio
        $this->estructura_bd['slider_inicio']['columnas_select'] = $this->slider_inicio_columnas;
        $this->estructura_bd['slider_inicio']['where_filtro_or'] = true;
        $this->estructura_bd['slider_inicio']['campos'] = array(
            'nombre'=>array(
                'tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'boton'=>array('tipo'=>'text','cols'=>6,
                'vista'=>array('alta','modifica')),
            'url'=>array('tipo'=>'text','cols'=>6,
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // video inicio
        $this->estructura_bd['video_inicio']['columnas_select'] = $this->video_inicio_columnas;
        $this->estructura_bd['video_inicio']['where_filtro_or'] = true;
        $this->estructura_bd['video_inicio']['campos'] = array(
           
            'archivo'=>array('tipo'=>'archivo','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // nosotros
        $this->estructura_bd['nosotros']['columnas_select'] = $this->nosotros_columnas;
        $this->estructura_bd['nosotros']['where_filtro_or'] = true;
        $this->estructura_bd['nosotros']['campos'] = array(
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // slider nosotros
        $this->estructura_bd['slider_nosotros']['columnas_select'] = $this->slider_nosotros_columnas;
        $this->estructura_bd['slider_nosotros']['where_filtro_or'] = true;
        $this->estructura_bd['slider_nosotros']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'textarea','cols'=>12,
                'vista'=>array('alta','modifica')),
            'prefijo'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //INSTALACIONES
        $this->estructura_bd['instalaciones']['columnas_select'] = $this->instalaciones_columnas;
        $this->estructura_bd['instalaciones']['where_filtro_or'] = true;
        $this->estructura_bd['instalaciones']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'archivo'=>array('tipo'=>'archivo','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

            
        // Ajustes
        $this->estructura_bd['ajustes']['columnas_select'] = $this->ajustes_columnas;
        $this->estructura_bd['ajustes']['where_filtro_or'] = true;
        $this->estructura_bd['ajustes']['campos'] = array(
            'telefono_1'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'telefono_2'=>array('tipo'=>'text','cols'=>6,
                'vista'=>array('alta','modifica')),
            'whatsapp'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'email_contacto'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        /*
        * 
        **************************************
        *
        Prepagos
        *
        **************************************
        *
        */
       // Tipo Prepago
        $this->estructura_bd['tipo_prepago']['columnas_select'] = $this->tipo_prepago_columnas;
        $this->estructura_bd['tipo_prepago']['where_filtro_or'] = true;
        $this->estructura_bd['tipo_prepago']['campos'] = array(
             'nombre'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        // Categorias Prepago
        $this->estructura_bd['categoria_prepago']['columnas_select'] = $this->categoria_prepago_columnas;
        $this->estructura_bd['categoria_prepago']['where_filtro_or'] = true;
        $this->estructura_bd['categoria_prepago']['campos'] = array(
            'nombre'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'descripcion'=>array('tipo'=>'text','cols'=>6,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));
       
        //prepagos
        $this->estructura_bd['prepagos']['columnas_select'] = $this->prepagos_columnas;
        $this->estructura_bd['prepagos']['where_filtro_or'] = true;
        $this->estructura_bd['prepagos']['campos'] = array(
           
            'categoria_prepago_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'categoria_prepago','vista'=>array('alta','modifica')),
            'tipo_prepago_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'tipo_prepago','vista'=>array('alta','modifica')),
            'clientes_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'clientes','vista'=>array('alta','modifica')),
            'folio'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'fecha_alta'=>array('tipo'=>'fecha','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //prepagos_servicios
        $this->estructura_bd['prepagos_servicios']['columnas_select'] = $this->prepagos_servicios_columnas;
        $this->estructura_bd['prepagos_servicios']['where_filtro_or'] = true;
        $this->estructura_bd['prepagos_servicios']['campos'] = array(
            'prepagos_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'prepagos','vista'=>array('alta','modifica')),
            'servicios_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'servicios','vista'=>array('alta','modifica')),
             'folio'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
             'cupon'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
             'fecha_vencimiento'=>array('tipo'=>'fecha','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
             'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        //prepagos_cantidad
        $this->estructura_bd['prepagos_cantidad']['columnas_select'] = $this->prepagos_cantidad_columnas;
        $this->estructura_bd['prepagos_cantidad']['where_filtro_or'] = true;
        $this->estructura_bd['prepagos_cantidad']['campos'] = array(
            
            'prepagos_id'=>array(
                'tipo'=>'select','cols'=>12,'requerido'=>'required',
                'tabla_foranea'=>'prepagos','vista'=>array('alta','modifica')),
            'cantidad'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'folio'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'cupon'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
             'fecha_vencimiento'=>array('tipo'=>'fecha','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
             'nombre'=>array('tipo'=>'text','cols'=>12,'requerido'=>'required',
                'vista'=>array('alta','modifica')),
            'status'=>array('tipo'=>'checkbox','cols'=>6,'vista'=>array('alta','modifica')));

        $this->estructura_bd['accion_grupo']['columnas_select'] = $this->accion_grupo_columnas;

    }

    public function subconsultas($tabla){
        $consulta = False;

        if($tabla == 'moneda'){
            $hoy = date('Y-m-d');
            $consulta = "
                          (SELECT 
                            tipo_cambio.monto 
                          FROM 
                            tipo_cambio 
                          WHERE 
                            tipo_cambio.moneda_id = moneda.id 
                          AND tipo_cambio.fecha = '$hoy' ) AS tipo_cambio_hoy";
        }
        return $consulta;

    }


    private function genera_join($tabla, $tabla_enlace, $renombrada,$obligatorio){
        if($obligatorio){
            $join = 'INNER';
        }
        else{
            $join = 'LEFT';
        }
        if($renombrada){
            $sql = ' '.$join.' JOIN '.$tabla.' AS '.$renombrada.' ON '.$renombrada.'.id = '.$tabla_enlace.'.'.$renombrada.'_id';
        }
        else {
            $sql = ' '.$join.' JOIN ' . $tabla . ' AS ' . $tabla . ' ON ' . $tabla . '.id = ' . $tabla_enlace . '.' . $tabla . '_id';
        }
        return $sql;
    }
    public function obten_tablas_completas($tabla){

        $tablas = $tabla.' AS '.$tabla;
        $tablas_join = $this->estructura_bd[$tabla]['columnas_select'];

        foreach ($tablas_join as $key=>$tabla_join){
            if(is_array($tabla_join)){
                $tabla_base = $tabla_join['tabla_base'];
                $tabla_enlace = $tabla_join['tabla_enlace'];
                $tabla_renombre = $tabla_join['tabla_renombrada'];
                $obligatorio = $tabla_join['obligatorio'];
                $tablas = $tablas . $this->genera_join($tabla_base, $tabla_enlace,$tabla_renombre,$obligatorio);
            }
            else {
                if ($tabla_join) {
                    $tablas = $tablas . $this->genera_join($key, $tabla_join,false,true);
                }
            }
        }
        return $tablas;
    }
    private function genera_or_like($tabla, $campo, $valor){
        $sql = " OR $tabla.$campo LIKE '%$valor%'  ";
        return $sql;
    }
    private function  genera_where_base($tabla, $campo, $valor){

        $sql = " WHERE $tabla.$campo LIKE '%$valor%'  ";
        return $sql;
    }
    private function where_filtro_or($tabla,$valor){
        $sql = $this->genera_where_base($tabla,'nombre',$valor);
        $sql = $sql.$this->genera_or_like($tabla, 'descripcion', $valor);
        return $sql;
    }
    private function genera_or_nombre($tablas, $valor){
        $sql = '';
        foreach ($tablas as $tabla){
            $sql = $sql.$this->genera_or_like($tabla, 'nombre', $valor);
        }
        return $sql;
    }

    public function genera_filtro_base($tabla, $valor){
        $valor = strtoupper($valor);
        $where = '';

        if(isset($this->estructura_bd[$tabla]['genera_where_base'])){
            $campo_base = $this->estructura_bd[$tabla]['genera_where_base'];
            $where = $where.$this->genera_where_base($tabla,$campo_base,$valor);
        }

        if(isset($this->estructura_bd[$tabla]['where_filtro_or'])) {
            if ($this->estructura_bd[$tabla]['where_filtro_or']) {
                $where = $where . $this->where_filtro_or($tabla, $valor);
            }
        }

        if(isset($this->estructura_bd[$tabla]['genera_or_nombre'])) {
            if (is_array($this->estructura_bd[$tabla]['genera_or_nombre'])) {
                $tablas_nombre = $this->estructura_bd[$tabla]['genera_or_nombre'];
                $where = $where . $this->genera_or_nombre($tablas_nombre, $valor);
            }
        }

        if(isset($this->estructura_bd[$tabla]['genera_or_like'])) {
            if (is_array($this->estructura_bd[$tabla]['genera_or_like'])) {
                $campos_like = $this->estructura_bd[$tabla]['genera_or_like'];
                foreach ($campos_like as $campo) {
                    $where = $where . $this->genera_or_like($tabla, $campo, $valor);
                }
            }
        }

        if(isset($this->estructura_bd[$tabla]['genera_filtro_especial'])) {
            if (is_array($this->estructura_bd[$tabla]['genera_filtro_especial'])) {
                $campos_like = $this->estructura_bd[$tabla]['genera_filtro_especial'];
                foreach ($campos_like as $tabla=>$campos) {
                    foreach ($campos as $campo) {
                        $where = $where . $this->genera_or_like($tabla, $campo, $valor);
                    }
                }
            }
        }
        return $where;
    }
}