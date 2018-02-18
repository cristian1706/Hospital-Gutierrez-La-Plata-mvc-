<?php
class VerPacienteController 
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
    public function verPaciente($idPaciente)
    {
        if (isset($_SESSION['idUsuario']))
        {
            $rol=$_SESSION['roles'];
            $user=$_SESSION['username'];
            $idUsuario=$_SESSION['idUsuario'];
            $paciente= VerPacienteModel::getInstance()->verPaciente($idPaciente);
            $obraSocial=DatosDemograficosModel::getInstance()->tipoObraSocial($paciente[0]['id_obraSocial']);
            $documento=DatosDemograficosModel::getInstance()->tipoDocumento($paciente[0]['id_documento']);
            VerPacienteView::getInstance()->show($paciente[0],$user,$rol,$idUsuario,$obraSocial,$documento);
        }
        else
        {
            $mensajeError = "";
            LoginView::getInstance()->show($mensajeError);
        }
    }
}
?>