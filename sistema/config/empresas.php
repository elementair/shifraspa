<?php
class Empresas{
    public $empresas;
    public function __construct(){
        $empresa= array(
            'nombre_empresa'   =>'SHIFRA SPA',
            'nombre_base_datos'=>'creactiv_shifra',
            'host'             =>'localhost',
            'user'             =>'root',
            'pass'             =>'');
        $this->empresas = array('99'=>$empresa);
    }
}