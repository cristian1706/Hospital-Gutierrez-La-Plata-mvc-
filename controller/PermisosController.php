<?php  
class PermisosController
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

        public function chequearPermisos($action)
        {
        	if (isset($_SESSION['idUsuario']))
            {
	        	$idUsuario= $_SESSION['idUsuario'];
	        	return PermisosModel::getInstance()->permisosDisponibles($action,$idUsuario);
	        }
	        else
            {
	        	return false;        	
            }

        }

        public function existeAccion($action)
        {
        	return PermisosModel::getInstance()->existePermiso($action);            
        }
    }
?>