<?php
Class ModificarPacienteModel extends ConexionDBModel
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
	public function modificar($nombre,$apellido,$fechaDeNacimiento,$genero,$tipoDocumento,$documento,$domicilio,$telefono,$obraSocial,$idPaciente)
	{
		$this->queryList("UPDATE paciente SET nombre=?, apellido=?, fechaDeNacimiento=?, genero=?, id_documento=?, numeroDocumento=?, domicilio=?, telefono=?, id_obraSocial=? WHERE id=?;",[$nombre,$apellido,$fechaDeNacimiento,$genero,$tipoDocumento,$documento,$domicilio,$telefono,$obraSocial,$idPaciente]);
    }//conexion hereda de objeto
    
    public function datosPaciente($id)
    {
        $result=$this->queryList("SELECT * FROM paciente  WHERE id=?;",[$id]);
        return $result;
    }

    public function check_documento($documento,$idPaciente){
        $result=$this->queryList("SELECT COUNT(numeroDocumento) AS cant FROM paciente WHERE numeroDocumento=? AND id<>?;",[$documento,$idPaciente]);
        return $result;
    }

    public function datosPacienteByDni($dni){
        $result=$this->queryList("SELECT * FROM paciente  WHERE numeroDocumento=?;",[$dni]);
        return $result;
    }
    
}

?>