<?php
class PerfilController 
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
    public function perfil()
    {

            if (isset($_SESSION['idUsuario']))
            {
                $rol=$_SESSION['roles'];
                $user=$_SESSION['username'];
                $idUsuario=$_SESSION['idUsuario'];
                $id=$_SESSION['idUsuario'];
                $usuario= PerfilModel::getInstance()->usuario($id);
                PerfilView::getInstance()->show($usuario[0],$user,$rol,$idUsuario);
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }
    }
}
?>