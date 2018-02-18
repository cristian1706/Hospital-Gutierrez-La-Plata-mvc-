<?php

Class ErrorController 
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
    public function errorPermiso($mensajeError)
    {        
        if (isset($_SESSION['idUsuario']))
        {
            $rol=$_SESSION['roles'];
            $username=$_SESSION['username'];          
        }
        else
        {
            $username="";
            $rol="";
        }        
        ErrorView::getInstance()->show($mensajeError,$rol,$username);
    }
}
?>