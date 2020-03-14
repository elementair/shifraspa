$(document).ready(function () {
    $('.busca_registros').keyup(function (){
        var url = new URL(window.location.href);
        var seccion = url.searchParams.get("seccion");
        var valor_consulta = $(this).val();

        $.ajax({
            url: "./index_ajax.php?seccion="+seccion+"&accion=lista_ajax",
            type: "POST", //send it through get method
            data: {valor: valor_consulta},
            success: function(data) {
                $('#contenido_lista').empty();
                $('#contenido_lista').append(data);
            },
            error: function(xhr, status) {
                //Do Something to handle error
                //alert("no insertado correctamente");
            }
        });
    });
});