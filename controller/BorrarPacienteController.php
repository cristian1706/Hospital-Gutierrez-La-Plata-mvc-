<?php

Class BorrarPacienteController 
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
    public function borrarPaciente($id,$pag)
    {
            if (isset($_SESSION['idUsuario']))
            {
                BorrarPacienteModel::getInstance()->borrar($id);
                ListarPacienteController::getInstance()->listarPaciente($pag);
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }
    }
}
?>