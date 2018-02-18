<?php
Class HistoriaClinicaModel extends ConexionDBModel
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

	public function registrarHistoriaClinica($fechaConsulta,$peso,$vacunas_completas,$vacunas_observaciones,$maduracion_acorde,$maduracion_observaciones,$ex_fisico_normal,$ex_fisico_observaciones,$pc,$ppc,$talla,$alimentacion,$observaciones_generales,$idPaciente,$idUsuario)
	{
		$this->queryList("INSERT INTO historia_clinica(fecha, peso, vacunas_completas, vacunas_observaciones, maduracion_acorde, maduracion_observaciones, ex_fisico_normal, ex_fisico_observaciones, pc, ppc, talla, alimentacion, observaciones_generales, activo, id_paciente, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?);",[$fechaConsulta,$peso,$vacunas_completas,$vacunas_observaciones,$maduracion_acorde,$maduracion_observaciones,$ex_fisico_normal,$ex_fisico_observaciones,$pc,$ppc,$talla,$alimentacion,$observaciones_generales,1,$idPaciente,$idUsuario]);
    }

    public function getHistoriaClinica($idHistoriaClinica) {
        $result = $this->queryList("SELECT * FROM historia_clinica WHERE id=?;",[$idHistoriaClinica]);
        return $result;
    }

    public function borrarHistoriaClinica($idHistoriaClinica)
    {
        $this->queryList("UPDATE historia_clinica SET activo=? WHERE id=?;",[0, $idHistoriaClinica]);
    }

    public function modificarHistoriaClinica($idHistoriaClinica,$peso,$vacunas_completas,$vacunas_observaciones,$maduracion_acorde,$maduracion_observaciones,$ex_fisico_normal,$ex_fisico_observaciones,$pc,$ppc,$talla,$alimentacion,$observaciones_generales)
    {
        $this->queryList("UPDATE historia_clinica SET peso=?, vacunas_completas=?, vacunas_observaciones=?, maduracion_acorde=?, maduracion_observaciones=?, ex_fisico_normal=?, ex_fisico_observaciones=?, pc=?, ppc=?, talla=?, alimentacion=?, observaciones_generales=? WHERE id=?;",[$peso,$vacunas_completas,$vacunas_observaciones,$maduracion_acorde,$maduracion_observaciones,$ex_fisico_normal,$ex_fisico_observaciones,$pc,$ppc,$talla,$alimentacion,$observaciones_generales,$idHistoriaClinica]);
    }


    public function getListadoHistoriasClinicas($idPaciente) {
        $result = $this->queryList("SELECT * FROM historia_clinica WHERE id_paciente=? AND activo=? ORDER BY fecha;",[$idPaciente,1]);
        return $result;
    }


    public function getHistoriaClinicaByFecha($fechaConsulta) {
        $result = $this->queryList("SELECT * FROM historia_clinica WHERE fecha=?;",[$fechaConsulta]);
        return $result;
    }
    public function hcPagina($offSet,$porPagina,$idPaciente)
    {//devuelve las filas de pacientes para una pagina
        $conn= $this->getConnection();
        $statement = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM historia_clinica WHERE id_paciente=:idPac AND activo=:act LIMIT :offset,:porPag");
        $statement->bindValue(':idPac', (int) $idPaciente, PDO::PARAM_INT);
        $statement->bindValue(':porPag', (int) $porPagina, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offSet, PDO::PARAM_INT);
        $statement->bindValue(':act', (int) 1, PDO::PARAM_INT);
        $statement->execute();
        $answer=$statement->fetchAll();
        return $answer;
    }
    public function nroHC($idPaciente)
    {//numero total de pacientes en la BD
        $answer = $this->queryList("SELECT COUNT(*) AS total FROM historia_clinica WHERE id_paciente=? AND activo=?;",[$idPaciente,1]);
        return $answer;
    }
}

?>