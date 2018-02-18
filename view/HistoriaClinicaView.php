<?php
class HistoriaClinicaView extends TwigView 
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


    public function showRegistrarHistoriaClinica($user,$rol,$idUsuario,$idPaciente,$paciente,$mensajeError) 
    {
        echo self::getTwig()->render('registrarHistoriaClinica.html', array('user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'idPaciente' => $idPaciente, 'paciente' => $paciente, 'mensajeError' => $mensajeError)); 
    }


    public function showHistoriaClinica($historia_clinica,$user,$rol,$idUsuario,$paciente,$edad) {
        echo self::getTwig()->render('verHistoriaClinica.html', array('historia_clinica' => $historia_clinica, 'user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'paciente' => $paciente, 'edad' => $edad));
    }


    public function showModificarHistoriaClinica($historia_clinica,$user,$rol,$idUsuario,$paciente,$mensajeError) {
        echo self::getTwig()->render('modificarHistoriaClinica.html', array('historia_clinica' => $historia_clinica, 'user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'paciente' => $paciente, 'mensajeError' => $mensajeError));
    }


    public function showListadoHistoriasClinicas($lista,$mover,$user,$rol,$idUsuario,$idPaciente,$paciente) {
        echo self::getTwig()->render('listarHistoriasClinicas.html', array('lista'=>$lista,'mover' => $mover, 'user' => $user, 'rol' => $rol, 'idUsuario' => $idUsuario, 'idPaciente' => $idPaciente, 'paciente' => $paciente));
    }
}
?>