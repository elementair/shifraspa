function guardarlocalstorage(){
 // prueba con local storage
  var citas          = document.getElementsByName("citas").val();
  var idServicio     = document.getElementsByName("deacuerdo").val();
  var duracion       = document.getElementsByName("duracion").val();
  var nombreServicio = document.getElementsByName("nombre_servicio").val();
  var precio         = document.getElementsByName("precio").val();
  var dia            = document.getElementsByName("booking_arrival_date").val();
  var hora           = document.getElementsByName("booking_treatment").val();
  var usuario        = document.getElementsByName("usuario").val();
  var nombreUsuario  = document.getElementsByName("nombre").val();
  var numerotelefono = document.getElementsByName("telefono").val();
  var email          = document.getElementsByName("email").val();
  var formaPago      = document.getElementsByName("opcion_pago").val();
  var terminos       = document.getElementsByName("terminos").val();

  if(localStorage.getItem("listitems") == null){

    listaItems = [];

  }else{
    var listaItems = JSON.parse(localStorage.getItem("listitems"));

    for(var i = 0; i < listaItems.length; i++){

      if(listaItems[i]["idItem"] == idItem ){

        console.log(i);
      }

    }

    listaItems.concat(localStorage.getItem("listitems"));
  }
  listaItems.push({"citas":citas,
    "deacuerdo":idServicio,
    "duracion":duracion,
    "nombre_servicio":nombreServicio,
    "precio":precio,
    "booking_arrival_date":dia,
    "booking_treatment":hora,
    "usuario":usuario,
    "nombre":nombreUsuario,
    "telefono":numerotelefono,
    "email":email,
    "opcion_pago":formaPago,
    "terminos":terminos,
    "quantity":1
  });

  localStorage.setItem("listitems", JSON.stringify(listaItems));

}
  