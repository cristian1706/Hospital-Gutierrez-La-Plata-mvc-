<?php
Class ReactivarUsuarioModel extends ConexionDBModel
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
	public function reactivarUsuario($idUsuario)
	{
		$this->queryList("UPDATE usuario SET activo=? WHERE id=?;",[1,$idUsuario]);
    }
}

?>