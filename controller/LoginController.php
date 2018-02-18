<?php

class LoginController 
{
    protected static $instance;
    //get instance singleton
    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function index()
    {  

        $infoIndex = ConfiguracionAdminModel::getInstance()->getConfiguracionInicial();
        $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
        $infoGeneral = $infoGral[0];
        if ($infoGeneral['sitio_habilitado'] == 1)
        {

            if(isset($_SESSION['loggedin']))
            {
                if ($_SESSION['loggedin'] == true)
                {
                    $roles=$_SESSION['roles'];                 
                    $user=$_SESSION['username'];
                    $idUsuario=$_SESSION['idUsuario'];
                    UserView::getInstance()->show($user,$roles,$infoIndex,$idUsuario);
                }
            }
            else
            {
                IndexView::getInstance()->show($infoIndex);
            }
        }
        else
        {
            if(isset($_SESSION['loggedin']))
            {
                if ($_SESSION['loggedin'] == true)
                {
                    $roles=$_SESSION['roles'];                    
                    $user=$_SESSION['username'];
                    $idUsuario=$_SESSION['idUsuario'];
                    MantenimientoView::getInstance()->showUsuario($user,$roles,$infoIndex,$idUsuario);
                }
            }
            else
            {
                MantenimientoView::getInstance()->show();
            }            
        }
    }
    
    public function login()
    {
        $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
        $infoGeneral = $infoGral[0];

        if (!isset($_SESSION))
        {
            session_start();        
        }        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            if (strlen(str_replace(' ','',$_POST['email']))!=0 and
                strlen(str_replace(' ','',$_POST['clave']))!=0)
            {      
                    $email = htmlentities($_POST['email']);//seguridad injection
                    $clave =  htmlentities ($_POST['clave']);
                    $row = LoginModel::getInstance()->login($email,$clave);
                    if(isset($row[0]))// permiso
                    {     
                        $user=$row[0];
                        if ($user['activo'] == 1)
                        {
                            $roles=LoginModel::getInstance()->roles($user['id']);
                            $_SESSION['loggedin'] = true;
                            $_SESSION['idUsuario'] =$user['id'];
                            $_SESSION['roles'] = $roles;

                            $_SESSION['username'] = $user['username'];
                            $user=$_SESSION['username'];
                            $idUsuario = $_SESSION['idUsuario'];
                            $infoIndex = ConfiguracionAdminModel::getInstance()->getConfiguracionInicial();
                            if ($infoGeneral['sitio_habilitado'] == 1)
                            {
                                UserView::getInstance()->show($user,$roles,$infoIndex,$idUsuario);
                            }
                            else
                            {
                                MantenimientoView::getInstance()->showUsuario($user,$roles,$infoIndex,$idUsuario);
                            }
                        }                       
                        else
                        {
                            $mensajeError = "El usuario está inactivo";
                            LoginView::getInstance()->show($mensajeError);
                        }
                    }
                    else
                    {
                        LoginController::getInstance()->errorLogin();
                    }
                }
                else
                {
                    $mensajeError = "No se puede acceder si deja campos vacíos";
                    LoginView::getInstance()->show($mensajeError);
                }
            }
            else
            {
                if (isset($_SESSION['loggedin']))
                {
                    $roles=$_SESSION['roles'];
                    $user=$_SESSION['username'];
                    $idUsuario = $_SESSION['idUsuario'];
                    $infoIndex = ConfiguracionAdminModel::getInstance()->getConfiguracionInicial();
                    if ($infoGeneral['sitio_habilitado'] == 1)
                    {
                        UserView::getInstance()->show($user,$roles,$infoIndex,$idUsuario);
                    }
                    else
                    {
                        MantenimientoView::getInstance()->showUsuario($user,$roles,$infoIndex,$idUsuario);
                    }
                }
                else
                {
                    $mensajeError = "";
                    LoginView::getInstance()->show($mensajeError);
                }
            }
        }

        public function errorLogin()
        {
            $mensajeError = "El usuario y/o contraseña es incorrecto";
            LoginView::getInstance()->show($mensajeError);
        }


        public function cerrarSesion()
        {
            $_SESSION=array();
            session_destroy();
            LoginController::getInstance()->index();
        }
}
?>