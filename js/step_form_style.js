var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    /* js comment
    |
    |====================================================
    |
    |   PASO 1
    |
    |====================================================
    | 
    */
    if (n == (x.length - 6)) {

        console.log('PASO 1----------------------------------------------------------------');


    } else {
        document.getElementById("nextBtn").innerHTML = "continuar";
    }
    /* js comment
    |
    |====================================================
    |
    |   PASO 2
    |
    |====================================================
    |   Obteniendo Horas disponibles
    */
    if (n == (x.length - 5)) {

        console.log('PASO 2----------------------------------------------------------------');
        console.log('Obtener la lista de horas disponibles en el dia seleccionado');

        var resultado = "ninguno";

        // var deacuerdo   = $('.deacuerdo').val();
        var dia = $('.dia').val();
        var id = $('.id').val();
        var options = '';
        var empleadoid = '';

        console.log(dia);

        var datos = { "dia": dia, "id": id };

        console.log(datos);
        $.ajax({
            url: "ajax/hora.ajax.php",
            type: "POST",
            data: datos
        }).done(function(respuesta) {
            console.log(respuesta);

            if (respuesta.estado === "ok") {
                console.log(respuesta.dia);
                console.log(respuesta.select);
                console.log(respuesta.contenido);
                console.log('empleado' + respuesta.empleado);

                options = respuesta.contenido;
                // empleadoid=respuesta.empleado;

                $(".respuestaEmp").empty();
                $(".respuestaEmp").append(options);
                $(".respuestaEmp").html(respuesta.select);
                $(".hora").html(JSON.stringify(options));

                document.getElementById('dia_cita').value = respuesta.dia;

                // $(".respuestalistaEmp").html(respuesta.empleado);
                // obtener_localstorage();
            }

        });

    } else {
        document.getElementById("nextBtn").innerHTML = "continuar";
    }
    /* js comment
    |
    |====================================================
    |
    |   PASO 3
    |
    |====================================================
    |   Obteniendo lista de epmleados
    */
    if (n == (x.length - 4)) {

        console.log('PASO 3 ----------------------------------------------------------------');
        console.log('obtener lista de empleados disponibles');
        var resultado = "ninguno";
        var hora_now = $('.hora').val();
        var dia_now = $('.dia').val();
        var id_now = $('.id').val();

        // var id_servicio = document.getElementById('cptura_servicio_id');

        document.getElementById('hora_cita').value = hora_now;

        console.log('-step empleado' + hora_now);
        console.log('-step empleado' + dia_now);
        console.log('-step empleado' + id_now);

        var datos = {
            "hora": hora_now,
            "dia": dia_now,
            "id": id_now,

        };

        console.log(datos);

        $.ajax({
            url: "ajax/almacenarmostrar.ajax.php",
            type: "POST",
            data: datos
        }).done(function(respuesta) {
            console.log(respuesta);

            if (respuesta.estado === "ok") {

                console.log(respuesta.id);
                console.log(respuesta.dia);
                console.log(respuesta.hora);

                $(".recibe_id_again").empty();
                $(".recibe_id_again").append(respuesta.id);

                $(".recibe_dia_again").empty();
                $(".recibe_dia_again").append(respuesta.dia);

                $(".recibe_hora_again").empty();
                $(".recibe_hora_again").append(respuesta.hora);

                console.log('me quedare aqui');
            }

        });




    } else {

        document.getElementById("nextBtn").innerHTML = "continuar";

    }
    if (n == (x.length - 3)) {

        console.log('----------------------------------------------------------------');
        console.log('paso 4 completado');

    } else {
        document.getElementById("nextBtn").innerHTML = "continuar";
    }



    // if (n == (x.length - 2)) {

    //   console.log('----------------------------------------------------------------');
    //   console.log('paso 5 completado');
    //   var resultado="ninguno";
    //   // var payment= $('.metodo').val();

    //   // var payment = '';

    //   // $("input[name='opcion_pago']").on('change', function() {
    //   //     payment = $(this).val();
    //   //     console.log(payment);
    //   // });

    //   var payment=''; 
    //       for (payment=0;i<document.formcitas.opcion_pago.length; payment++){ 
    //           if (document.formcitas.opcion_pago[payment].checked) 
    //             break; 
    //       } 
    //       payment = document.formcitas.opcion_pago[payment].value 




    //   // document.getElementById('hora_cita').value = hora;

    //   // console.log('Obtenido por la clase metodo', payment);


    //       var datos = {"metodo":payment};
    //        document.getElementById('payment_metod').value = payment;

    //       console.log(datos); 
    //       $.ajax({
    //       url:"ajax/metodo.ajax.php",
    //       type:"POST",
    //       data: datos
    //        }).done(function(respuesta){
    //           console.log(respuesta);

    //            if (respuesta.estado === "ok") {

    //             console.log(respuesta.metodopago);


    //             document.getElementById('payment_metod').value = respuesta.metodopago;


    //           }

    //   });

    // }else {
    //   document.getElementById("nextBtn").innerHTML = "continuar";
    // }


    /* js comment
    |
    |====================================================
    |
    |   PASO 5
    |
    |====================================================
    |
    */
    if (n == (x.length - 1)) {

        var payment = '';
        var rfc = $('.rfc').val();
        var razonSocial = $('.razonSocial').val();
        var cfdi = $('.cfdi').val();

        for (payment = 0; payment < document.formcitas.opcion_pago.length; payment++) {
            if (document.formcitas.opcion_pago[payment].checked)
                break;
        }
        payment = document.formcitas.opcion_pago[payment].value


        // document.getElementById('hora_cita').value = hora;

        // console.log('Obtenido por la clase metodo', payment);

        document.getElementById('payment_metod').value = payment;

        console.log(payment);
        console.log(rfc);
        console.log(razonSocial);
        console.log(cfdi);

        console.log('----------------------------------------------------------------');
        console.log('Con este evento voy ha proceder con el pago seleccionado');
        console.log('paso 6 completado');
        // console.log('Debo obtener el metodo de pago');

        document.getElementById("nextBtn").innerHTML = "Pagar";
        document.getElementsByName("siguiente").attr('name', 'pagar');

        var total = $(".valorTotalPago").html();
        var impuesto = $(".valorTotalImpuesto").html();
        var subtotal = $(".valorSubtotal").html();
        var n_servicio = $(".valorNombre").html();
        var precio = $(".valorPrecio").html();
        var duracion = $(".valorDuracion").html();
        var id_servicio = $(".valorId").html();

        // var dia  =$(".valorDia").html();
        // var hora =$(".valorHora").html();

        var datos = new FormData();

        datos.append("total", total);
        datos.append("impuesto", impuesto);
        datos.append("subtotal", subtotal);
        datos.append("n_servicio", n_servicio);
        datos.append("precio", precio);
        datos.append("duracion", duracion);
        datos.append("id_servicio", id_servicio);
        /*
        * 
        **************************************
        *
        facturación
        *
        **************************************
        *
        */
        datos.append("rfc", rfc);
        datos.append("razonSocial", razonSocial);
        datos.append("cfdi", cfdi);

        $.ajax({
            url: "ajax/citas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                // window.location = respuesta;

                console.log("respuesta", respuesta);

            }
        })
    } else {
        document.getElementById("nextBtn").innerHTML = "continuar";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {

    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) {;

        // swal({
        //   title:'Hola mundo!',
        //   text:"No has seleccionado  o completado un campo requerido",
        //   type:'success'
        //   })

        swal("Algo salio mal", "No has seleccionado o completado un campo requerido!", "warning");
        return false;

    }
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :

    if (currentTab >= x.length) {

        var obtube_payment = $('.obtube_payment').val();

        //...the form gets submitted:
        // document.getElementById("regForm").submit();
        // swal("Cita Agendada", "Revisa tu correo, te hemos mandando una notificación!", "success");
        // document.getElementById("regForm").  submit();
        // 
        if (obtube_payment == "paypal") {

            console.log("METODO:", obtube_payment);

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
            // var opcionPago= obtube_payment;
            var terminos = document.getElementsByName("terminos")[0].value;

            var rfc = $('.rfc').val();
            var razonSocial = $('.razonSocial').val();
            var cfdi = $('.cfdi').val();

            var datos = new FormData();

            datos.append("total", total);
            datos.append("impuesto", impuesto);
            datos.append("subtotal", subtotal);
            datos.append("n_servicio", n_servicio);
            datos.append("precio", precio);
            datos.append("duracion", duracion);
            datos.append("id_servicio", id_servicio);
            datos.append("rfc", rfc);
            datos.append("razonSocial", razonSocial);
            datos.append("cfdi", cfdi);

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
            datos.append("opcionPago", obtube_payment);
            datos.append("terminos", terminos);
            // console.log("METODO:",opcionPago);

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

            return false;
        } else if (obtube_payment == "tarjeta") {

            var total = $(".valorTotalPago").html();
            var impuesto = $(".valorTotalImpuesto").html();
            var subtotal = $(".valorSubtotal").html();
            var n_servicio = $(".valorNombre").html();
            var precio = $(".valorPrecio").html();
            var duracion = $(".valorDuracion").html();
            var id_servicio = $(".valorId").html();

            //==============================================================
            //    Obtenemos mas datos para el procedimiento de citas.
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
            // var opcionPago= obtube_payment;
            var terminos = document.getElementsByName("terminos")[0].value;

            var rfc = $('.rfc').val();
            var razonSocial = $('.razonSocial').val();
            var cfdi = $('.cfdi').val();



            // CONTINUAMOS AQUI


            console.log("METODO:", obtube_payment);

            // Conekta.setPublicKey("tuapikeypublica");
            Conekta.setPublicKey("key_FeoHBaTV8fzsqm39WP7vdbA");

            var conektaSuccessResponseHandler = function(token) {

                $("#conektaTokenId").val(token.id);

                jsPay();
            };

            var conektaErrorResponseHandler = function(response) {
                var $form = $("#regForm");

                alert(response.message_to_purchaser);
            }



            // $(document).ready(function(){

            //     $("#card-form").submit(function(e){
            //         e.preventDefault();

            //     })

            // })

            function jsPay() {
                let params = $("#regForm").serialize();
                let url = "./conekta/pay.php";

                $.post(url, params, function(data) {
                    if (data == "1") {
                        var datos = new FormData();

                        datos.append("total", total);
                        datos.append("impuesto", impuesto);
                        datos.append("subtotal", subtotal);
                        datos.append("n_servicio", n_servicio);
                        datos.append("precio", precio);
                        datos.append("duracion", duracion);
                        datos.append("id_servicio", id_servicio);

                        //==============================================================
                        //    datos para el envio de email.
                        //==============================================================

                        datos.append("nomServicio", nomServicio);
                        datos.append("diaCita", diaCita);
                        datos.append("horaCita", horaCita);
                        datos.append("usuarioTipo", usuarioTipo);
                        datos.append("idCliente", idCliente);
                        datos.append("nomCliente", nomCliente);
                        datos.append("telefono", telefono);
                        datos.append("email", email);
                        datos.append("opcionPago", obtube_payment);
                        datos.append("terminos", terminos);
                        // console.log("METODO:",opcionPago);
                        datos.append("rfc", rfc);
                        datos.append("razonSocial", razonSocial);
                        datos.append("cfdi", cfdi);

                        $.ajax({
                            url: "ajax/citas.ajaxConekta.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(respuesta) {
                                // console.log("respuesta",respuesta);
                                // console.log("Se guardo la cita :D");
                                // window.location = "index.php#citas";

                            }

                        })

                        console.log("estoy en data 1");
                        // swal("Wow!", "Tu cita se hiso exitosamente. revisa tu correo, te hemos mandado un correo.", "success");
                        window.location.href = 'index.php?mensaje=cita_ajendada';
                        jsClean();

                    } else {
                        alert(data);
                        console.log("NO entre al data 1")
                        console.log(data);
                    }

                })

            }
            var $form = $("#regForm");

            Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

            function jsClean() {
                $(".form-control").prop("value", "");
                $("#conektaTokenId").prop("value", "");
            }
        }
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;

        }

        if (y[i].value == "paypal" && !($('input[name="opcion_pago"]').is(':checked'))) {
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
        }

        if (y[i].value == "tarjeta" && !($('input[name="opcion_pago"]').is(':checked'))) {
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;

        }

        if (y[i].value == "deacuerdo" && !($('input[name="terminos"]').is(':checked'))) {
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace("active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
}

// function obtener_localstorage(){

//   let Id_obten=localStorage.getItem("servicioId");
//   console.log(Id_obten);
// }
/*
**************************************
*
http://jsfiddle.net/Amit12x/K9LpL/699/
*
**************************************
*
*/