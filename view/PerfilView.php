<?php
class PerfilView extends TwigView 
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
    public function show($usuario, $user,$rol,$idUsuario)
    {    
        echo self::getTwig()->render('perfil.html', array('user' => $user, 'rol' => $rol,'usuario' => $usuario,'idUsuario' => $idUsuario));   
    }
    
}
?>