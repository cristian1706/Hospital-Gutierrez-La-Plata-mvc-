<?php
class DatosDemograficosView extends TwigView 
{
    protected static $instance;
    //get instance singelton
    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function show($datosDemograficos,$paciente,$user,$rol,$idUsuario,$vivienda,$agua,$calefaccion) 
    {
        echo self::getTwig()->render('verDatosDemograficos.html', array('datosDemograficos' => $datosDemograficos, 'paciente' => $paciente, 'user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'vivienda' => $vivienda, 'agua' => $agua, 'calefaccion' => $calefaccion)); 
    }
}
?>