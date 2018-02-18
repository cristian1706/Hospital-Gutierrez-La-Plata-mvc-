<?php
class RegistrarUsuarioView extends TwigView 
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
    public function show($user,$rol,$roles,$idUsuario,$mensajeError) 
    {
        
        echo self::getTwig()->render('registrarUsuario.html', array('user'=>$user,'rol'=>$rol,'roles' => $roles, 'idUsuario' => $idUsuario, 'mensajeError' => $mensajeError)); 
    }
}
?>