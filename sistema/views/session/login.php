
<div class="container">
	
  	<div class="card card-container">
   		<img id="profile-img" class="profile-img-card" src="<?php echo $ruta_universal.'sistema/views/img/logoshifra.jpg'?>" />
     	<p id="profile-name" class="profile-name-card"></p>
      	<form class="form-signin" method="post"  action="./index.php?seccion=session&accion=loguea">
			   <span id="reauth-email" class="reauth-email"></span>
			   
            <select name="numero_empresa" class="form-control" required style="display: none;">
                <option value="99">SHIFRA SPA</option>
<!--                --><?php
//                foreach ($controlador->empresas as $key=>$empresa){ ?>
<!--                    <option value="--><?php //echo $key; ?><!--">--><?php //echo $empresa['nombre_empresa']; ?><!--</option>-->
<!--                --><?php //} ?>
            </select>
            <br>
         	<input type="text" id="user" class="form-control" placeholder="Usuario" name="user" value="" required autofocus>
         	<input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
        	<button class="btn btn-success" type="submit">Entrar</button>
     	</form><!-- /form -->
   	</div><!-- /card-container -->
</div><!--