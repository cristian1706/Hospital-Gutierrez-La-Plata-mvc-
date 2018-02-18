<?php
class MantenimientoView extends TwigView 
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

    public function show() 
    {    
        echo self::getTwig()->render('mantenimiento.html',array());  
    }
    public function showUsuario($user,$rol,$infoIndex, $idUsuario) 
    {
        echo self::getTwig()->render('mantenimientoUsuario.html', array('user' => $user, 'rol' => $rol,'infoIndex'=> $infoIndex, 'idUsuario' => $idUsuario,)); 
    }
}
?>