with(document.index){
	onsubmit = function(e){
		e.preventDefault();
		ok = true;
		if(ok && correo.value==""){
			ok=false;
			alert("Ingrese su correo");
			correo.focus();
		}
		if(ok && contrasena.value==""){
			ok=false;
			alert("Ingrese su contraseña");
			contrasena.focus();
		}
		if(ok){ submit(); }
	}
}
