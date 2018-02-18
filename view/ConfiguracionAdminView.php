<?php
class ConfiguracionAdminView extends TwigView 
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
    public function show($configuracion_inicial,$configuracion_general,$user,$rol,$idUsuario,$mensajeError) 
    {    
        echo self::getTwig()->render('configuracionAdmin.html',array('configuracion_inicial' => $configuracion_inicial, 'configuracion_general' => $configuracion_general, 'user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'mensajeError' => $mensajeError));  
    }
}
?>