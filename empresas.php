<?php
class Empresas{
    public $empresas;
    public $regimenes_fiscales;
    public function __construct(){
        $this->regimenes_fiscales=array('601'=>'LEY GENERAL DE PERSONAS MORALES');
        $empresa99 = array(
            'nombre_empresa'=>'SHIFRA SPA',
            'nombre_base_datos'=>'shifrasp_shifraspabd',
            'user'=>'shifrasp_shifras',
            'pass'=>'shifra2020*',
            'host'=>'localhost');

        $this->empresas = array('99'=>$empresa99);
    }
}