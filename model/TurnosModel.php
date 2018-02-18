<?php
require_once('model/ConexionDBModel.php');
class TurnosModel extends ConexionDBModel 
{
    protected static $instance;
    
        public static function getInstance()
        {
            if (!isset(self::$instance)) 
            {
                self::$instance = new self();
            }
    
            return self::$instance;
        }
	// Obtiene un usuario por un id en particular
    public function turnosDisponibles($dato) 
    {
        $result =$this->queryList("SELECT  TIME_FORMAT(fecha, '%H:%i') AS horaTurno FROM turno WHERE DATE(fecha) = ?;", [$dato] );
        return $result;
	}

    public function exists($fecha) 
    {
        $result =$this->queryList("SELECT * FROM turno WHERE fecha = ?;", [$fecha] );
        return $result;
	}

    public function existPaciente($doc) 
    {
        $result =$this->queryList("SELECT * FROM paciente WHERE numeroDocumento = ?;", [$doc] );
        return $result;
	}

    public function insertTurno($dni, $fecha) 
    {
        $result =$this->queryList("INSERT INTO turno (fecha, dni) VALUES (?, ?);", [$fecha,$dni] );
        return $result;
	}
}
?>