<?php
Class BorrarPacienteModel extends ConexionDBModel
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
		$this->queryList("UPDATE paciente SET activo=? WHERE id=?;",[0, $id]);
    }
    
   
    
}

?>