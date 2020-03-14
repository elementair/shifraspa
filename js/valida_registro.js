with(document.index){
	onsubmit = function(e){
		e.preventDefault();
		ok = true;
		if(ok && nombre.value==""){
			ok=false;
			// alert("Ingrese su nombre");
			swal("Ingrese su nombre!", "You clicked the button!", "warning");
			nombre.focus();

		}
		if(ok && a_paterno.value==""){
			ok=false;
			alert("Ingrese su apellido paterno");
			a_paterno.focus();
		}
			if(ok && a_materno.value==""){
			ok=false;
			alert("Ingrese su apellido materno");
			a_materno.focus();
		}
			if(ok && telefono.value==""){
			ok=false;
			alert("Ingrese su telefono");
			telefono.focus();
		}
		if(ok && c_electronico.value==""){
			ok=false;
			alert("Ingrese su correo electronico");
			c_electronico.focus();
		}
		if(ok && pregunta_seguridad_id.value==""){
			ok=false;
			alert("sleccione una pregunta de seguridad");
			pregunta_seguridad_id.focus();
		}
		if(ok && p_seguridad.value==""){
			ok=false;
			alert("Responda a la pregunta de seguridad seleccionada");
			p_seguridad.focus();
		}

		if(ok && contrasena.value==""){
			ok=false;
			alert("Ingrese una contraseña");
			contrasena.focus();
		}
		if(ok && confirma_contrasena.value==""){
			ok=false;
			alert("Ingrese la confirmacion de su contraseña");
			confirma_contrasena.focus();
		}

		if(ok && contrasena.value!= confirma_contrasena.value){
			ok=false;
			alert("No coididen las contraseñas");
			confirma_contrasena.focus();
		}


		if(ok){ submit(); 
			

		}
	}
}
