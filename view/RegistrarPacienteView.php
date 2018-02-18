<?php
class RegistrarPacienteView extends TwigView 
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
    public function show($user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos) 
    {
        echo self::getTwig()->render('registrarPaciente.html', array('user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'mensajeError' => $mensajeError, 'viviendas' => $viviendas, 'aguas' => $aguas, 'calefacciones' => $calefacciones, 'obrasSociales' => $obrasSociales, 'documentos' => $documentos)); 
    }
}
?>