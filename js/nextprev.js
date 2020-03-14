	var restaurant = $("#restaurant").val();

	var idItem = $("#idItem").val();

	var iname = $("#iname").val();

	var restname = $("#restname").val();

	var price = $("#price").val();

	var cost = $("#cost").val();


	var agregarAlCarrito = false;

	if(localStorage.getItem("listitems") == null){

		listaItems = [];

	}else{
		var listaItems = JSON.parse(localStorage.getItem("listitems"));

		for(var i = 0; i < listaItems.length; i++){

			if(listaItems[i]["idItem"] == idItem ){

				swal({
					title: "The items are already added to the shopping cart",
					text: "",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "to back!",
					closeOnConfirm: false
				})

				return;

			}

		}

		listaItems.concat(localStorage.getItem("listitems"));
	}

	listaItems.push({"restaurant":restaurant,
		"idItem":idItem,
		"iname":iname,
		"restname":restname,
		"price":price,
		"quantity":1
	});

	localStorage.setItem("listitems", JSON.stringify(listaItems));




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
  listaItems.push({"cita":cita,
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