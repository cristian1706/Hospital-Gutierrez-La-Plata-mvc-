<?php
Class BorrarUsuarioModel extends ConexionDBModel
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
	public function borrar($id)
	{
		$this->queryList("UPDATE usuario SET activo=? WHERE id=?;",[0,$id]);
    }//conexion hereda de objeto
}

?>