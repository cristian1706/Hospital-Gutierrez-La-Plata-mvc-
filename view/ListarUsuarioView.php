<?php
class ListarUsuarioView extends TwigView 
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
    public function show($lista,$mover, $user, $rol, $idUsuario, $roles)
    {  
        echo self::getTwig()->render('listarUsuarios.html', array('user' => $user,'usuarios' => $lista, 'rol' => $rol, 'idUsuario' => $idUsuario, 'mover' => $mover, 'roles' => $roles));   
    }

    public function showExito($lista,$mover, $user, $rol, $idUsuario, $roles,$mensajeExito)
    {  
        echo self::getTwig()->render('listarUsuarios.html', array('user' => $user,'usuarios' => $lista, 'rol' => $rol, 'idUsuario' => $idUsuario, 'mover' => $mover, 'roles' => $roles, 'mensajeExito' => $mensajeExito));   
    }

    public function showBusqueda($lista,$mover, $user, $rol, $idUsuario, $roles)
    {    
        echo self::getTwig()->render('listarUsuarioBusqueda.html', array('user' => $user,'usuarios' => $lista, 'rol' => $rol, 'idUsuario' => $idUsuario, 'mover' => $mover,'roles' => $roles));   
    }
}