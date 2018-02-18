<?php
 
class ListarPacienteModel extends ConexionDBModel
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

    public function listAll() 
    {
        $answer = $this->queryList("SELECT * FROM paciente WHERE activo=?;", ['1']);
        return $answer;
    }
    public function pacientesPagina($offSet,$porPagina)
    {//devuelve las filas de pacientes para una pagina
        $conn= $this->getConnection();
        $statement = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM paciente WHERE activo=:act LIMIT :offset,:porPag");
        $statement->bindValue(':act', (int) 1, PDO::PARAM_INT);
        $statement->bindValue(':porPag', (int) $porPagina, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offSet, PDO::PARAM_INT);
        $statement->execute();
        $answer=$statement->fetchAll();
        return $answer;
    }
    public function pacientesPaginaBusqueda($offSet,$porPagina,$titulo)
    {//devuelve las filas de pacientes para una pagina
        $conn= $this->getConnection();
        $statement = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM paciente WHERE nombre LIKE :tit OR apellido LIKE :tit OR tipoDocumento LIKE :tit  OR numeroDocumento LIKE :tit LIMIT :offset,:porPag");
        $statement->bindValue(':porPag', (int) $porPagina, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offSet, PDO::PARAM_INT);
        $statement->bindValue(':tit', $titulo, PDO::PARAM_STR);
        $statement->execute();
        $answer=$statement->fetchAll();
        return $answer;
    }
    public function nroPacientes()
    {//numero total de pacientes en la BD
        $answer = $this->queryList("SELECT COUNT(*) AS total FROM paciente WHERE activo=?;",[1]);
        return $answer;
    }
    public function nroPacientesBusqueda($titulo)
    {//numero total de pacientes en la BD
        $answer = $this->queryList("SELECT COUNT(*) AS total FROM paciente WHERE nombre LIKE ? OR apellido LIKE ? OR tipoDocumento LIKE ?  OR numeroDocumento LIKE ?;",[$titulo,$titulo,$titulo,$titulo]);
    }
    public function getPaciente($idPaciente){
        $answer = $this->queryList("SELECT * FROM paciente WHERE id=?;", [$idPaciente]);
        return $answer;
    }
}
?>
