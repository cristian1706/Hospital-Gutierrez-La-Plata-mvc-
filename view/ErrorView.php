<?php
class ErrorView extends TwigView 
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
    public function show($mensajeError,$rol,$username) 
    {       
        echo self::getTwig()->render('errorPermisos.html', array('mensajeError' => $mensajeError, 'rol' => $rol, 'user' => $username)); 
    }   
}
?>