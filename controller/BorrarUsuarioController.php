<?php
Class BorrarUsuarioController 
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
    public function borrarUsuario($id,$pag)
    {
            if (isset($_SESSION['idUsuario']))
            {
                BorrarUsuarioModel::getInstance()->borrar($id);
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