<?php

class ValidarDatosController
{
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function validarDatos($datos) {
    	$datos = trim($datos);
    	$datos = strip_tags($datos);
    	$datos = htmlentities($datos);
    	$datos = htmlspecialchars($datos);
    	return $datos;
    }


}
?>