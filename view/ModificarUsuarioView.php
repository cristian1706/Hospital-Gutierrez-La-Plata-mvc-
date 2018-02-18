<?php

Class ModificarUsuarioView extends TwigView 
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
	public function show($usuario,$user,$rol,$idUsuario,$mensajeError,$roles) 
	{       
		echo self::getTwig()->render('modificarUsuario.html',array('usuario' => $usuario, 'user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'mensajeError' => $mensajeError, 'roles' => $roles)); 
	} 
}