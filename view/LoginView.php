<?php
class LoginView extends TwigView 
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
    public function show($mensajeError) 
    {  
        echo self::getTwig()->render('login.html', array('mensajeError' => $mensajeError)); 
    }
}
?>