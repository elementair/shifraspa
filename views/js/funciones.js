function elimina_accion_bd(elemento){
    var accion_grupo_id_enviar = elemento.children('.accion_grupo_id').val();
    var grupo_id_enviar = elemento.children('.grupo_id').val();
    var accion_id_enviar = elemento.children('.accion_id').val();

    elemento.removeClass('btn-success elimina_accion_bd');
    elemento.unbind('click');

    elemento.click(function () {
        agrega_accion_bd(elemento);
    });

    $.ajax({
        url: "./index_ajax.php?seccion=grupo&accion=elimina_accion_bd",
        type: "POST", //send it through get method
        data: {
            accion_grupo_id: accion_grupo_id_enviar,
            grupo_id:grupo_id_enviar,
            accion_id:accion_id_enviar},
        success: function(data) {
            alert('Registro Eliminado');
        },
        error: function(xhr, status) {
            //Do Something to handle error
            //alert("no insertado correctamente");
        }
    });
}

function obten_elemento_status(elemento){
    var elemento_status = elemento.parents().parents().children('.panel-body').children('.tag_status').children('.resultado-status');
    return elemento_status;
}

function agrega_accion_bd(elemento){
    var grupo_id_enviar = elemento.children('.grupo_id').val();
    var accion_id_enviar = elemento.children('.accion_id').val();
    elemento.removeClass('agrega_accion_bd');
    elemento.addClass('btn-success ');
    elemento.unbind('click');

    elemento.click(function () {
        elimina_accion_bd(elemento);
    });

    $.ajax({
        url: "./index_ajax.php?seccion=grupo&accion=agrega_accion_bd",
        type: "POST", //send it through get method
        data: {accion_id: accion_id_enviar, grupo_id: grupo_id_enviar},
        success: function() {
            alert('Registro Agregado');
        },
        error: function(xhr, status) {
            //Do Something to handle error
            //alert("no insertado correctamente");
        }
    });
}

function activa_desactiva(elemento, accion){
    var etiqueta_alert = '';
    var accion_url = '';
    var etiqueta_nuevo_status = '';
    var tipo_panel_nuevo = '';
    var tipo_panel_anterior = '';
    var icono = '';
    if(accion == 'desactivar'){
        etiqueta_alert = 'desactivar';
        accion_url = 'desactiva_bd';
        etiqueta_nuevo_status = 'Inactivo';
        tipo_panel_nuevo = 'panel-danger';
        tipo_panel_anterior = 'panel-info';
        icono = 'glyphicon glyphicon-ok';
    }
    else{
        if(accion == 'activar'){
            etiqueta_alert = 'activar';
            accion_url = 'activa_bd';
            etiqueta_nuevo_status = 'Activo';
            tipo_panel_nuevo = 'panel-info';
            tipo_panel_anterior = 'panel-danger';
            icono = 'glyphicon glyphicon-minus';
        }
    }

    var registro_id = elemento.parent().parent().find('.registro_id').html();
    var url = new URL(window.location.href);
    var seccion = url.searchParams.get("seccion");
    var valor_consulta = $('.busca_registros').val();
    var result = confirm("Estás seguro de "+etiqueta_alert+" el registro ?");
    var url_ejecucion = "./index_ajax.php?seccion="+seccion+"&accion="+accion_url+"&registro_id="+registro_id;
    if(result == true){
        $.ajax({
            url: url_ejecucion,
            type: "POST", //send it through get method
            data: {valor: valor_consulta},
            success: function() {
                elemento.parent().parent().removeClass(tipo_panel_anterior);
                elemento.parent().parent().addClass(tipo_panel_nuevo);
                elemento.empty();
                elemento.append("<span class='"+icono+"' aria-hidden='true'></span>");
                var resultado_status = obten_elemento_status(elemento);
                resultado_status.empty();
                resultado_status.append(etiqueta_nuevo_status);
                elemento.unbind('click');
                if(accion == 'activar'){
                    alert('Registro activado con éxito');
                    elemento.click(function () {
                        activa_desactiva(elemento,'desactivar');
                    });
                }
                else{
                    if(accion=='desactivar'){
                        alert('Registro desactivado con éxito');
                        elemento.click(function () {
                            activa_desactiva(elemento,'activar');
                        });
                    }
                }
            },
            error: function() {
                alert('Error: '+ url_ejecucion);
            }
        });
    }

}

function genera_parametro_select(elemento,seccion_select){
    var tabla_id = elemento.val();
    var campo_filtro = 'pais_id';
    var url_ejecucion = "./index_ajax.php?seccion="+seccion_select+"&accion=datos_select&campo_filtro="+campo_filtro+"&valor_filtro="+tabla_id;
    return url_ejecucion;
}


$(document).ready(function () {



    $('.agrega_accion_bd').on("click", function () {
        agrega_accion_bd($(this));
    });

    $('.busca_elemento').keyup(function (){
        var valor_consulta = $(this).val().toUpperCase();
        $(".elemento_accion").each(function (index) {
            var contenido = $(this).html().toUpperCase();
            var existe = contenido.indexOf(valor_consulta);
            if(existe > -1){
                $(this).show('slow');
            }
            else{
                $(this).hide('slow');
            }
        });
        $(".panel").each(function (index)
        {
            var contenido = $(this).html().toUpperCase();

            var existe = contenido.indexOf(valor_consulta);

            if(existe > -1){
                $(this).show('slow');
            }
            else{
                $(this).hide('slow');
            }
        });

    });

    $('.elimina_accion_bd').on("click", function () {
        elimina_accion_bd($(this));
    });


    $('.ve_tipo_cambio').click(function (){
        var moneda_id_enviar = $(this).children('.moneda_id').val();

        $(".modal-title").empty();
        $(".modal-title").append('Moneda Id: '+moneda_id_enviar);

        $.ajax({
            url: "./index_ajax.php?seccion=moneda&accion=obten_tipo_cambio",
            type: "POST", //send it through get method
            data: {moneda_id: moneda_id_enviar},
            success: function(data) {
                $('.modal-body').empty();
                $('.modal-body').append(data);
            },
            error: function(xhr, status) {
                //Do Something to handle error
                //alert("no insertado correctamente");
            }
        });
    });





    $('.navbar a.dropdown-toggle').unbind('click');

    $('.navbar a.dropdown-toggle').on('click', function(e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        if(!$parent.parent().hasClass('nav')) {
            $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
        }
        $('.nav li.open').not($(this).parents("li")).removeClass("open");
        return false;
    });


    $('.elimina').click(function (){
        var registro_id = $(this).parent().parent().find('.registro_id').html();
        var container = $(this).parent().parent().parent();
        var url = new URL(window.location.href);
        var seccion = url.searchParams.get("seccion");
        var valor_consulta = $(this).val();
        var result = confirm("Estás seguro de eliminar el registro ?");
        var url_ejecucion = "./index_ajax.php?seccion="+seccion+"&accion=elimina_bd&registro_id="+registro_id;
        if(result == true){
            $.ajax({ 
                url: url_ejecucion,
                type: "POST", //send it through get method
                data: {valor: valor_consulta},
                success: function() {
                    container.remove();
                    alert('Registro eliminado con éxito');
                },
                error: function() {
                    alert('Error: '+url_ejecucion);
                }
            });
        }
    });

    $('.desactiva').click(function (){
        activa_desactiva($(this), 'desactivar');
    });

    $('.activa').click(function (){
        activa_desactiva($(this), 'activar');
    });

    if ($("#select_pais").length) {

        if ($("#contenedor_select_estado").length) {
            $('#select_estado').empty();
            $('#select_municipio').empty();

            $('#select_pais').change(function (){
                var url_ejecucion = genera_parametro_select($(this),'estado');
                $("#contenedor_select_estado").empty();
                $( "#contenedor_select_estado" ).load( url_ejecucion, function() {
                    $('#select_estado').unbind('change');
                    $('#select_estado').change(function (){
                        var tabla_id = $(this).val();
                        var seccion_select = 'municipio';
                        var campo_filtro = 'estado_id';
                        var url_ejecucion = "./index_ajax.php?seccion="+seccion_select+"&accion=datos_select&campo_filtro="+campo_filtro+"&valor_filtro="+tabla_id;
                        $("#contenedor_select_municipio").empty();
                        $( "#contenedor_select_municipio" ).load( url_ejecucion, function() {});
                    });
                });
            });
        }
    }
});
