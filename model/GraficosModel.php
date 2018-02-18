<?php  


class GraficosModel extends ConexionDBModel
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

    public function datosPeso($idPaciente, $fechaInicial, $fechaFinal)
    {
        return $this->queryList("SELECT fecha, peso FROM historia_clinica WHERE id_paciente=? AND activo=? AND fecha BETWEEN ? AND ? ORDER BY fecha;",[$idPaciente,1, $fechaInicial, $fechaFinal]);
    }

    public function datosTalla($idPaciente, $fechaInicial, $fechaFinal)
    {
        return $this->queryList("SELECT fecha, talla FROM historia_clinica WHERE id_paciente=? AND activo=? AND fecha BETWEEN ? AND ? ORDER BY fecha;",[$idPaciente,1, $fechaInicial, $fechaFinal]);
    }

    public function datosPercentil($idPaciente, $fechaInicial, $fechaFinal)
    {
        return $this->queryList("SELECT fecha, pc FROM historia_clinica WHERE id_paciente=? AND activo=? AND fecha BETWEEN ? AND ? ORDER BY fecha;",[$idPaciente,1, $fechaInicial, $fechaFinal]);
    }

    public function heladera($idHeladera)
    {
        return $this->queryList("SELECT COUNT(*) AS total FROM datos_demograficos dm INNER JOIN paciente p on p.id=dm.id_paciente WHERE dm.heladera=? AND p.activo=?;",[$idHeladera,1]);
    }

    public function electricidad($idElectricidad)
    {
        return $this->queryList("SELECT COUNT(*) AS total FROM datos_demograficos dm INNER JOIN paciente p on p.id=dm.id_paciente WHERE dm.electricidad=? AND p.activo=?;",[$idElectricidad,1]);
    }

    public function mascota($idMascota)
    {
        return $this->queryList("SELECT COUNT(*) AS total FROM datos_demograficos dm INNER JOIN paciente p on p.id=dm.id_paciente WHERE dm.mascota=? AND p.activo=?;",[$idMascota,1]);
    }

    public function agua($idAgua)
    {
        return $this->queryList("SELECT COUNT(*) AS total FROM datos_demograficos dm INNER JOIN paciente p on p.id=dm.id_paciente WHERE dm.id_agua=? AND p.activo=?;",[$idAgua,1]);   
    }

    public function vivienda($idVivienda)
    {
        return $this->queryList("SELECT COUNT(*) AS total FROM datos_demograficos dm INNER JOIN paciente p on p.id=dm.id_paciente WHERE dm.id_vivienda=? AND p.activo=?;",[$idVivienda,1]);   
    }

    public function calefaccion($idCalefaccion)
    {
        return $this->queryList("SELECT COUNT(*) AS total FROM datos_demograficos dm INNER JOIN paciente p on p.id=dm.id_paciente WHERE dm.id_calefaccion=? AND p.activo=?;",[$idCalefaccion,1]);   
    }
}

?>