<?php
 
class VerPacienteModel extends ConexionDBModel
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

    public function verPaciente($id) 
    {
        $answer = $this->queryList("SELECT * FROM paciente WHERE id=?;", [$id]);
        return $answer;
    }
    public function datosDemograficos($id) 
    {
        $answer = $this->queryList("SELECT * FROM datos_demograficos WHERE id_paciente=?;", [$id]);
        return $answer;
    }
}
?>