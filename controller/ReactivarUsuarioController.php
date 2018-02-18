<?php
Class ReactivarUsuarioController 
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
    public function reactivarUsuario($idUsuario,$pag)
    {
            if (isset($_SESSION['roles']))
            {
                ReactivarUsuarioModel::getInstance()->reactivarUsuario($idUsuario);
                ListarUsuarioController::getInstance()->listarUsuario($pag);
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }
    }
}
?>