<?php echo $directiva->encabezado_form_alta($seccion, 'alta_bd'); ?>
<?php echo $controlador->breadcrumbs; ?>
<div class="col-md-10 col-md-offset-1 alta">
 
    <?php
    echo $directiva->input_archivo('',6,'archivo');
   
    echo $directiva->btn_enviar(12,'Guardar');
    ?>
</div>
</form>