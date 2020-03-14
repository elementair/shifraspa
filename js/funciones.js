/*
* 
**************************************
*
BOTON IZQUIERDO AGENDAR
*
**************************************
*
*/
$(".icono_ajenda").click(function() {
    window.location = "#citas";
});
/*
* 
**************************************
*
Solicitar factura
*
**************************************
*
*/


/*  
* 
**************************************
*
BOTON AGENDAR SECCION SERVICIOS
*
**************************************
*
*/


$(".btnAgendaInd").click(function() {

    console.log('si entre a este evento');
    var resultado = "ninguno";

    // var deacuerdo   = $('.deacuerdo').val();
    var nombre_serv = $('.recibe_nombre').val();
    var duracion = $('.recibe_duracion').val();
    var precio = $('.recibe_precio').val();
    var id_servicio = $('.recibe_id').val();

    console.log(duracion);
    console.log(precio);

    var datos = { "recibe_id": id_servicio, "recibe_nombre": nombre_serv, "recibe_duracion": duracion, "recibe_precio": precio };

    console.log(datos);
    $.ajax({
        url: "ajax/almacenar_datos2.php",
        type: "POST",
        data: datos
    }).done(function(respuesta) {
        // console.log(respuesta);
        if (respuesta.estado === "ok") {
            console.log(JSON.stringify(respuesta.recibe_nombre));
            // var nombre=JSON.stringify(respuesta.recibe_nombre);
            var nombre_serv = respuesta.nombre_serv,
                duracion = respuesta.duracion,
                precio = respuesta.precio,
                deacuerdo = respuesta.deacuerdo;

            $(".id_servicio").html(JSON.stringify(respuesta.id_servicio));
            $(".nombre_servicio").html(JSON.stringify(respuesta.recibe_nombre));
            $(".duracion_servicio").html(JSON.stringify(respuesta.recibe_duracion));
            $(".precio_servicio").html(JSON.stringify(respuesta.recibe_precio));

            var contenido = "";
            var contenido2 = "";

            var nomb = "";
            vardato = "";

            for (var key in respuesta) {

                if (key == 'recibe_nombre') {
                    nomb = "nombre_serv";
                    dato = "nombre servicio";
                    contenido += ' <input style="display:none" type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td>' + respuesta[key] + '</td> <tr>';

                } else if (key == 'recibe_duracion') {
                    nomb = "duracion";
                    dato = "duracion";
                    contenido += ' <input style="display:none" type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td>' + respuesta[key] + ' min </td> <tr>';

                    // capturamos todos los datos necesarios para los pagos
                } else if (key == 'recibe_precio') {
                    nomb = "precio";
                    dato = "precio";
                    var precioTotal = respuesta[key];
                    // var precioTotal= floor(precio);
                    contenido += ' <input style="display:none" type="text" name="' + nomb + '" value="' + precioTotal + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td>$ <span class="valorPrecio" >' + precioTotal + '</span></td> <tr>';
                    contenido2 += ' <tr class="active"> <td> <b>Especificaciones de Pago:  </b></td><td></td><tr>';

                    var impuesto = 0.00;
                    // impuesto 4.00 paypal
                    var calcularImpuesto = precioTotal * impuesto / 100;
                    var subtotal = precioTotal;
                    var valorTotal = (parseInt(calcularImpuesto) + parseInt(subtotal));

                    contenido2 += ' <tr> <td> Subtotal </td> <td>$ <span class="valorSubtotal" valor="0">' + subtotal + '</span></td> <tr>';
                    contenido2 += ' <tr> <td> Impuesto </td> <td>$ <span class="valorTotalImpuesto" valor="0">' + calcularImpuesto + '</span></td>';
                    contenido2 += ' <tr> <td> Total </td> <td>$ <span class="valorTotalPago" valor="0">' + valorTotal + '</span></td><tr>';


                } else if (key == 'recibe_id') {
                    nomb = "deacuerdo";
                    dato = "deacuerdo";
                    contenido += ' <input style="display:none" type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr style="display:none"> <td><span class="valorId" valor="0">' + respuesta[key] + '</span></td> <tr>';

                    document.getElementById('idxhora').value = respuesta[key];

                }

            }

            $(".respuesta").empty();
            $(".respuesta").append(contenido);
            $(".respuestaResumen").empty();
            $(".respuestaResumen").append(contenido2);


            document.getElementById('servicio_search').value = id_servicio;

        }

    });

});
/*
* 
**************************************
*
BOTON AGENDAR SECCION INDIVIDUAL
*
**************************************
*
*/
$(".capturar_valor_ind").click(function() {

    var resultado = "ninguno";
    var nombre_serv = $(this).attr("recibe_nombre");
    var duracion = $(this).attr("recibe_duracion");
    var precio = $(this).attr("recibe_precio");
    var deacuerdo = $(this).attr("recibe_id")

    console.log(nombre_serv);
    console.log(duracion);
    console.log(precio);
    console.log(deacuerdo);

    var datos = {
        "recibe_id": deacuerdo,
        "recibe_nombre": nombre_serv,
        "recibe_duracion": duracion,
        "recibe_precio": precio
    };

    console.log(datos);
    $.ajax({
        url: "ajax/almacenar_datos2.php",
        type: "POST",
        data: datos
    }).done(function(respuesta) {
        // console.log(respuesta);
        if (respuesta.estado === "ok") {
            console.log(JSON.stringify(respuesta.recibe_nombre));
            // var nombre=JSON.stringify(respuesta.recibe_nombre);
            var nombre_serv = respuesta.nombre_serv,
                duracion = respuesta.duracion,
                precio = respuesta.precio,
                deacuerdo = respuesta.deacuerdo;

            // $(".respuesta").html("Servidor:<br><pre>"+JSON.stringify(respuesta, null, 2)+"</pre>");
            $(".nombre_servicio").html(JSON.stringify(respuesta.recibe_nombre));
            $(".duracion_servicio").html(JSON.stringify(respuesta.recibe_duracion));
            $(".precio_servicio").html(JSON.stringify(respuesta.recibe_precio));
            $(".deacuerdo").html(JSON.stringify(respuesta.deacuerdo));

            // for (let resp of respuesta) {

            var contenido = "";
            var contenido2 = "";
            var contenidoPaypal = "";
            var nomb = "";
            var dato = "";

            for (var key in respuesta) {

                if (key == 'recibe_nombre') {
                    nomb = "nombre_serv";
                    dato = "nombre servicio";
                    contenido += ' <input type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td> <span class="valorNombre" valor="0">' + respuesta[key] + '</span></td> <tr>';
                } else if (key == 'recibe_duracion') {
                    nomb = "duracion";
                    dato = "duracion";
                    contenido += ' <input type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td><span class="valorDuracion" valor="0">' + respuesta[key] + ' min </span></td> <tr>';

                } else if (key == 'recibe_precio') {
                    nomb = "precio";
                    dato = "precio";
                    var precioTotal = respuesta[key];
                    // var precioTotal= floor(precio);
                    contenido += ' <input type="text" name="' + nomb + '" value="' + precioTotal + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td>$<span class="valorPrecio" >' + precioTotal + '</span></td> <tr>';
                    contenido2 += ' <tr class="active"> <td> <b>Especificaciones de Pago:  </b></td><td></td><tr>';

                    var impuesto = 0.00;
                    var calcularImpuesto = precioTotal * impuesto / 100;
                    var subtotal = precioTotal;
                    var valorTotal = (parseInt(calcularImpuesto) + parseInt(subtotal));

                    contenido2 += ' <tr> <td> Subtotal </td> <td>$ <span class="valorSubtotal" valor="0">' + subtotal + '</span></td> <tr>';
                    contenido2 += ' <tr> <td> Impuesto </td> <td>$ <span class="valorTotalImpuesto" valor="0">' + calcularImpuesto + '</span></td>';
                    contenido2 += ' <tr> <td> Total </td> <td>$ <span class="valorTotalPago" valor="0">' + valorTotal + '</span></td><tr>';

                } else if (key == 'recibe_id') {
                    nomb = "deacuerdo";
                    dato = "deacuerdo";
                    contenido += ' <input type="text" name="' + nomb + '" value="' + respuesta[key] + '">';

                    contenido2 += ' <tr style="display:none"> <td><span class="valorId" valor="0">' + respuesta[key] + '</span></td> <tr>';

                    document.getElementById('idxhora').value = respuesta[key];

                }

            }
            // $(".respuesta").html(contenido);

            $(".respuesta").empty();
            $(".respuesta").append(contenido);
            $(".respuestaResumen").empty();
            $(".respuestaResumen").append(contenido2);



        }
    });

    var porId = document.getElementsByName("deacuerdo");

    // Recorremos todos los valores del radio button para encontrar el
    // seleccionado

    for (var i = 0; i < porId.length; i++) {

        if (porId[i].checked)

            resultado = porId[i].value;
    }

    document.getElementById("resultado").value = resultado;

    var valor = resultado;

    $(".mostrarIntervalo").empty();
    $(".mostrarIntervalo").append(valor);

    document.getElementById("mostrarValor").value = valor;



});
/*
* 
**************************************
*
 BOTON AGENDAR SECCION UNIVERSAL
*
**************************************
*
*/
$(".capturar_valor").click(function() {
    var resultado = "ninguno";
    var nombre_serv = $(this).attr("recibe_nombre");
    var duracion = $(this).attr("recibe_duracion");
    var precio = $(this).attr("recibe_precio");
    var deacuerdo = $(this).attr("recibe_id");
    console.log(nombre_serv);
    console.log(duracion);
    console.log(precio);
    console.log(deacuerdo);

    var datos = {
        "recibe_id": deacuerdo,
        "recibe_nombre": nombre_serv,
        "recibe_duracion": duracion,
        "recibe_precio": precio
    };

    console.log(datos);

    $.ajax({
        url: "ajax/almacenar_datos.php",
        type: "POST",
        data: datos
    }).done(function(respuesta) {

        if (respuesta.estado === "ok") {
            console.log(JSON.stringify(respuesta.recibe_nombre));

            var nombre_serv = respuesta.nombre_serv,
                duracion = respuesta.duracion,
                precio = respuesta.precio;


            $(".nombre_servicio").html(JSON.stringify(respuesta.recibe_nombre));
            $(".duracion_servicio").html(JSON.stringify(respuesta.recibe_duracion));
            $(".precio_servicio").html(JSON.stringify(respuesta.recibe_precio));
            $(".deacuerdo").html(JSON.stringify(respuesta.deacuerdo));


            var contenido = "";
            var contenido2 = "";
            var nomb = "";
            var dato = "";

            for (var key in respuesta) {

                if (key == 'recibe_nombre') {
                    nomb = "nombre_serv";
                    dato = "nombre servicio";
                    contenido += ' <input type="text" id="' + nomb + '" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td> <span class="valorNombre" valor="0">' + respuesta[key] + '</span></td> <tr>';

                    document.getElementById('description').value = respuesta[key];

                } else if (key == 'recibe_duracion') {
                    nomb = "duracion";
                    dato = "duracion";
                    contenido += ' <input type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td><span class="valorDuracion" valor="0">' + respuesta[key] + '</span> min </td> <tr>';



                } else if (key == 'recibe_precio') {
                    nomb = "precio";
                    dato = "precio";
                    var precioTotal = respuesta[key];
                    // var precioTotal= floor(precio);
                    contenido += ' <input type="text" name="' + nomb + '" value="' + precioTotal + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td>$ <span class="valorPrecio" >' + precioTotal + '</span></td> <tr>';
                    contenido2 += ' <tr class="active"> <td> <b>Especificaciones de Pago:  </b></td><td></td><tr>';

                    var impuesto = 0.00;
                    var num = precioTotal * impuesto / 100;
                    var calcularImpuesto = num.toFixed(2);


                    var subtotal = precioTotal;
                    var Total = (parseInt(calcularImpuesto) + parseInt(subtotal));
                    var valorTotal = Total.toFixed(2);

                    contenido2 += ' <tr> <td> Subtotal </td> <td>$ <span class="valorSubtotal" valor="0">' + subtotal + '</span></td> <tr>';
                    contenido2 += ' <tr> <td> Impuesto </td> <td>$ <span class="valorTotalImpuesto" valor="0">' + calcularImpuesto + '</span></td>';
                    contenido2 += ' <tr> <td> Total    </td> <td>$ <span class="valorTotalPago" valor="0">' + valorTotal + '</span></td><tr>';




                    document.getElementById('total').value = valorTotal;

                } else if (key == 'recibe_id') {
                    nomb = "deacuerdo";
                    dato = "deacuerdo";
                    contenido += ' <input type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido += '<?php $_SESSION["idSeleccionado"]= ' + respuesta.deacuerdo + ' ?>';
                    contenido2 += ' <tr style="display:none;"><td><span class="valorId" valor="0">' + respuesta[key] + '</span></td> <tr>';
                    // document.getElementById('id_ser').value = respuesta[key];
                    document.getElementById('idxhora').value = respuesta[key];
                    // console.log(respuesta[key]);
                    almacenar_localstorage(respuesta[key]);
                    // $("#servicio_search").html(respuesta[key]);
                    document.getElementById("cptura_servicio_id").value = respuesta[key];


                }

            }


            $(".respuesta").empty();
            $(".respuesta").append(contenido);
            $(".respuestaResumen").empty();
            $(".respuestaResumen").append(contenido2);



            nextPrev(1);

        }
    });


    var porId = document.getElementsByName("deacuerdo");

    // Recorremos todos los valores del radio button para encontrar el
    // seleccionado

    for (var i = 0; i < porId.length; i++) {

        if (porId[i].checked)

            resultado = porId[i].value;
    }

    document.getElementById("resultado").value = resultado;

    var valor = resultado;

    $(".mostrarIntervalo").empty();
    $(".mostrarIntervalo").append(valor);

    document.getElementById("mostrarValor").value = valor;

});

$(window).resize(function() {
    if ($(window).width() <= 800) {
        $(".call").click(function() {
            $(".telefono_menu_movil").show('fast');
        });
        $("#btn_close_contacto").click(function() {
            $(".telefono_menu_movil").hide('fast');
        });
    }
});
var containerHeight = $(".container2").height();
var $text = $(".container2 p");

while ($text.outerHeight() > containerHeight) {
    $text.text(function(index, text) {
        return text.replace(/\W*\s(\S)*$/, '...');
    });
}

function elemento_lista(elemento) {
    var nombre = elemento.children('.texto_servicio').html();

    $(".n_servicio").empty();
    $(".n_servicio").append(nombre);

}

function captura_cliente_session(elemento) {
    var valor = elemento.children('.nombre').html();
    $(".nombre_user").empty();
    $(".nombre_user").append(valor);

}

function ul_link(elemento) {
    var nombre = elemento.children('.texto_servicio').html();
    var subgrupo = elemento.children('.texto_subgrupo').html();
    $(".n_subgrupo").empty();
    $(".n_subgrupo").append(subgrupo);
    $(".n_servicio").empty();
    $(".n_servicio").append(nombre);

}
$(".elemento_lista").click(function() {

    elemento_lista($(this));
    document.cookie = ".elemento_lista";

});
$(".ul_link").click(function() {
    ul_link($(this));
    $(".n_subgrupo").append(subgrupo);
    $(".n_servicio").append(nombre);


});

function manejadorCallback(evento) {

    // cada vez que clickas un boton. Automaticamente se invoca con un parametro
    // que es el Evento. el cual tiene una propiedad (entre otras) llamada target
    // que es el elemento que dispara el evento. Luego buscas el id en target.
    // alert(evento.target.id);
    var numero = evento.target.id;
    console.log(numero);

    alert(numero);

}
// aquí el javascript no obstructivo.
// obtenemos todos los botones, por su clase
var buttons = document.querySelectorAll('.miboton')

// a cada uno le asignamos el manejador del evento.
for (var i = 0; i < buttons.length; i++) {

    // aqui generas el equivalente a onclick
    buttons[i].addEventListener('click', manejadorCallback);
}

function mostrarIntervalo() {
    var servicio = document.getElementById("servicio"),
        intervalo = document.getElementById("intervalo");
    servicio.value = intervalo.value;
}

function capturar() {
    var nombre_serv = $(this).attr("nombre_serv");
    var duracion = $(this).attr("duracion");
    var precio = $(this).attr("precio");
    console.log(nombre_serv);

    var resultado = "ninguno";

    var porId = document.getElementsByName("deacuerdo");

    // Recorremos todos los valores del radio button para encontrar el
    // seleccionado

    for (var i = 0; i < porId.length; i++) {

        if (porId[i].checked)

            resultado = porId[i].value;
    }

    document.getElementById("resultado").value = resultado;

    var valor = resultado;

    $(".mostrarIntervalo").empty();
    $(".mostrarIntervalo").append(valor);

    document.getElementById("mostrarValor").value = valor;

}

function captura_cliente_session(elemento) {
    var valor = elemento.children('.nombre').html();
    $(".nombre_user").empty();
    $(".nombre_user").append(valor);
}

function variables_ocultas(elemento) {
    var valorNombre = elemento.children().children('.nombre').val();
    var valorPrecio = elemento.children('.precio').val();
    var valorDuracion = elemento.children('.duracion').val();

    $('#nombre_oculto').val(valorNombre);
    $('#precio_oculto').val(valorPrecio);
    $('#precio_oculto').val(valorDuracion);
}

$(".btnPagar").click(function() {

    var total = $(".valorTotalPago").html();
    var impuesto = $(".valorTotalImpuesto").html();
    var subtotal = $(".valorSubtotal").html();
    var n_servicio = $(".valorNombre").html();
    var precio = $(".valorPrecio").html();
    var duracion = $(".valorDuracion").html();
    var id_servicio = $(".valorId").html();

    //==============================================================
    //		Obtenemos mas datos para el procedimiento de citas.
    //==============================================================

    var duracion = document.getElementsByName("duracion")[0].value;
    var nomServicio = document.getElementsByName("nombre_serv")[0].value;
    var diaCita = document.getElementsByName("booking_arrival_date")[0].value;
    var horaCita = document.getElementsByName("booking_treatment")[0].value;
    var usuarioTipo = document.getElementsByName("usuario")[0].value;
    var idCliente = document.getElementsByName("id_cliente")[0].value;
    var nomCliente = document.getElementsByName("nombre")[0].value;
    var telefono = document.getElementsByName("telefono")[0].value;
    var email = document.getElementsByName("email")[0].value;
    var opcionPago = document.getElementsByName("opcion_pago")[0].value;
    var terminos = document.getElementsByName("terminos")[0].value;

    var datos = new FormData();

    datos.append("total", total);
    datos.append("impuesto", impuesto);
    datos.append("subtotal", subtotal);
    datos.append("n_servicio", n_servicio);
    datos.append("precio", precio);
    datos.append("duracion", duracion);
    datos.append("id_servicio", id_servicio);

    //==============================================================
    //		datos para el envio de email.
    //==============================================================

    datos.append("nomServicio", nomServicio);
    datos.append("diaCita", diaCita);
    datos.append("horaCita", horaCita);
    datos.append("usuarioTipo", usuarioTipo);
    datos.append("idCliente", idCliente);
    datos.append("nomCliente", nomCliente);
    datos.append("telefono", telefono);
    datos.append("email", email);
    datos.append("opcionPago", opcionPago);
    datos.append("terminos", terminos);

    $.ajax({
        url: "ajax/citas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {

            // console.log("respuesta",respuesta);
            window.location = respuesta;

        }

    })

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function almacenar_localstorage(dato) {

    let id = dato;

    localStorage.setItem("servicioId", id);

}



/* js comment
|
|====================================================
|
|   capturarvalor() - Unicamente para los prepagos por servicio
|
|====================================================
|
*/

function capturarvalor() {

    var recibe_id = document.getElementById("p_id").value;
    var recibe_nombre = document.getElementById("p_nombre").value;
    var recibe_duracion = document.getElementById("p_duracion").value;
    var recibe_precio = document.getElementById("p_precio").value;
    var contenido_modificado = "";

    var resultado = "ninguno";
    var nombre_serv = recibe_nombre;
    var duracion = recibe_duracion;
    var precio = recibe_precio;
    var deacuerdo = recibe_id;

    console.log(nombre_serv);
    console.log(duracion);
    console.log(precio);
    console.log(deacuerdo);

    var datos = {
        "recibe_id": deacuerdo,
        "recibe_nombre": nombre_serv,
        "recibe_duracion": duracion,
        "recibe_precio": precio
    };

    console.log(datos);

    $.ajax({
        url: "ajax/almacenar_datos.php",
        type: "POST",
        data: datos
    }).done(function(respuesta) {

        if (respuesta.estado === "ok") {
            console.log(JSON.stringify(respuesta.recibe_nombre));

            var nombre_serv = respuesta.nombre_serv,
                duracion = respuesta.duracion,
                precio = respuesta.precio;


            $(".nombre_servicio").html(JSON.stringify(respuesta.recibe_nombre));
            $(".duracion_servicio").html(JSON.stringify(respuesta.recibe_duracion));
            $(".precio_servicio").html(JSON.stringify(respuesta.recibe_precio));
            $(".deacuerdo").html(JSON.stringify(respuesta.deacuerdo));


            var contenido = "";
            var contenido2 = "";
            var nomb = "";
            var dato = "";

            for (var key in respuesta) {

                if (key == 'recibe_nombre') {
                    nomb = "nombre_serv";
                    dato = "nombre servicio";
                    contenido += ' <input type="text" id="' + nomb + '" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td> <span class="valorNombre" valor="0">' + respuesta[key] + '</span></td> <tr>';

                    document.getElementById('description').value = respuesta[key];

                } else if (key == 'recibe_duracion') {
                    nomb = "duracion";
                    dato = "duracion";
                    contenido += ' <input type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td><span class="valorDuracion" valor="0">' + respuesta[key] + '</span> min </td> <tr>';



                } else if (key == 'recibe_precio') {
                    nomb = "precio";
                    dato = "precio";
                    var precioTotal = respuesta[key];
                    // var precioTotal= floor(precio);
                    contenido += ' <input type="text" name="' + nomb + '" value="' + precioTotal + '">';
                    contenido2 += ' <tr> <td>' + dato + '</td> <td>$ <span class="valorPrecio" >' + precioTotal + '</span></td> <tr>';
                    contenido2 += ' <tr class="active"> <td> <b>Especificaciones de Pago:  </b></td><td></td><tr>';

                    var impuesto = 0.00;
                    var num = precioTotal * impuesto / 100;
                    var calcularImpuesto = num.toFixed(2);


                    var subtotal = precioTotal;
                    var Total = (parseInt(calcularImpuesto) + parseInt(subtotal));
                    var valorTotal = Total.toFixed(2);

                    contenido2 += ' <tr> <td> Subtotal </td> <td>$ <span class="valorSubtotal" valor="0">' + subtotal + '</span></td> <tr>';
                    contenido2 += ' <tr> <td> Impuesto </td> <td>$ <span class="valorTotalImpuesto" valor="0">' + calcularImpuesto + '</span></td>';
                    contenido2 += ' <tr> <td> Total  </td> <td>$ <span class="valorTotalPago" valor="0"><strike>' + valorTotal + '<strike></span><small class="bg-succes text-success"> PAGADO </small></td><tr>';



                    document.getElementById('total').value = valorTotal;

                } else if (key == 'recibe_id') {

                    nomb = "deacuerdo";
                    dato = "deacuerdo";
                    contenido += ' <input type="text" name="' + nomb + '" value="' + respuesta[key] + '">';
                    contenido += '<?php $_SESSION["idSeleccionado"]= ' + respuesta.deacuerdo + ' ?>';
                    contenido2 += ' <tr style="display:none;"><td><span class="valorId" valor="0">' + respuesta[key] + '</span></td> <tr>';
                    // document.getElementById('id_ser').value = respuesta[key];
                    document.getElementById('idxhora').value = respuesta[key];
                    // console.log(respuesta[key]);
                    almacenar_localstorage(respuesta[key]);
                    // $("#servicio_search").html(respuesta[key]);
                    document.getElementById("cptura_servicio_id").value = respuesta[key];


                }


            }


            $(".respuesta").empty();
            $(".respuesta").append(contenido);
            $(".respuestaResumen").empty();
            $(".respuestaResumen").append(contenido2);
            contenido_modificado = "<br><fieldset><legend class='txt-success' > PAGADO </legend><br><br><p class='txt-success'> Tu servicio ya esta pagado, puedes continuar.</p><br><br>"

            $(".status_forma_pago").empty();
            $(".status_forma_pago").append(contenido_modificado);





            nextPrev(1);

        }
    });


    var porId = document.getElementsByName("deacuerdo");

    // Recorremos todos los valores del radio button para encontrar el
    // seleccionado

    for (var i = 0; i < porId.length; i++) {

        if (porId[i].checked)

            resultado = porId[i].value;
    }

    document.getElementById("resultado").value = resultado;

    var valor = resultado;

    $(".mostrarIntervalo").empty();
    $(".mostrarIntervalo").append(valor);

    document.getElementById("mostrarValor").value = valor;



}

function aplicarcupon() {

    var recibe_cantidad = document.getElementById("envia_cantidad").value;
    console.log(recibe_cantidad);

    var status_cupon = 1;

    var total_recibe = 8000;
    var total_final = 0;
    var monto_faltante = 0;
    var etiqueta_remover_cupon = '';


    // mostrar opcion remover cupon

    if (status_cupon == 1) {

        etiqueta_remover_cupon = "<a onclick='remover()'>Remover Prepago</a>"

        // APLICAR CUPON 

        if (recibe_cantidad <= total_recibe) {
            console.log(recibe_cantidad + 'es menor que el total:' + total_recibe);

            monto_faltante = total_recibe - recibe_cantidad;

            console.log('¿quieres proceder a pagar el resto: ' + monto_faltante + ' ?');


        } else {

            console.log(recibe_cantidad + ' es mayor que el total:' + total_recibe);

            total_final = recibe_cantidad - total_recibe;

            console.log('Tu monedero quedara en: ' + total_final);


        }

        $(".etiqueta_remover_cupon").empty();
        $(".etiqueta_remover_cupon").append(etiqueta_remover_cupon);

    }


}

function remover() {

    var status_tarjeta = 0;
    var clase = '';

    alert('confirma tu solicitud');

    if (status_tarjeta === 0) {
        clase = '';

        $(".tajeta_prepago").addClass(clase);

    } else {
        clase = 'active';

        $(".tajeta_prepago").addClass(clase);

    }

}