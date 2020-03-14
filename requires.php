<?php
require_once('./sistema/config/conexion.php');
require_once('./sistema/config/empresas.php');

require_once('./sistema/consultas_base.php');


require_once('./sistema/modelos.php');
require_once('./sistema/modelo_sobrecargado.php');

$directorio = opendir("./sistema/modelos");
while ($archivo = readdir($directorio)){
    if (!is_dir($archivo)) {
        require_once('./sistema/modelos/'.$archivo);
    }
}
