<?php
class ListarPacienteView extends TwigView 
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
    public function show($pacientes,$mover,$user,$rol,$idUsuario)
    {    
        echo self::getTwig()->render('listarPacientes.html', array('user' => $user, 'rol' => $rol,'pacientes' => $pacientes, 'idUsuario' => $idUsuario,'mover'=>$mover));   
    }
    
}
?>