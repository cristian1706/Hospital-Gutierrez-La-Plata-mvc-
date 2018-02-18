<?php
class VerPacienteView extends TwigView 
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
    public function show($paciente,$user,$rol,$idUsuario,$obraSocial,$documento)
    {    
        echo self::getTwig()->render('verPaciente.html', array('user' => $user, 'rol' => $rol,'paciente' => $paciente,'idUsuario' => $idUsuario, 'obraSocial' => $obraSocial, 'documento' => $documento));   
    }
    
}
?>