<?php
class UserView extends TwigView 
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
    public function show($user,$rol,$infoIndex, $idUsuario) 
    {
            echo self::getTwig()->render('rol.html', array('user' => $user, 'rol' => $rol,'infoIndex'=> $infoIndex, 'idUsuario' => $idUsuario,)); 
    }
}
?>