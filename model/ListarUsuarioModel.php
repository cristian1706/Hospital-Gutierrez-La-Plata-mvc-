<?php
 
class ListarUsuarioModel extends ConexionDBModel
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
        $answer = $this->queryList("SELECT * FROM usuario;", []);
        return $answer;
    }

    public function usuariosPagina($offSet,$porPagina)
    {//devuelve las filas de pacientes para una pagina
        $conn= $this->getConnection();
        $statement = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE activo=:act LIMIT :offset,:porPag");
        $statement->bindValue(':porPag', (int) $porPagina, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offSet, PDO::PARAM_INT);
        $statement->bindValue(':act', 1, PDO::PARAM_INT);
        $statement->execute();
        $answer=$statement->fetchAll();
        return $answer;
    }

    public function usuariosPaginaBusqueda($offSet,$porPagina,$titulo,$activo)
    {//devuelve las filas de pacientes para una pagina
        $conn= $this->getConnection();
        $statement = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE (activo=:act AND (first_name LIKE :tit OR username LIKE :tit OR last_name LIKE :tit)) LIMIT :offset,:porPag");
        $statement->bindValue(':porPag', (int) $porPagina, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offSet, PDO::PARAM_INT);
        $statement->bindValue(':act', (int) $activo, PDO::PARAM_INT);        
        $statement->bindValue(':tit', $titulo, PDO::PARAM_STR);
        $statement->execute();
        $answer=$statement->fetchAll();
        return $answer;
    }

    public function nroUsuarios()
    {//numero total de pacientes en la BD
        $answer = $this->queryList("SELECT COUNT(*) AS total FROM usuario WHERE activo=?;",[1]);
        return $answer;
    }
    
    public function nroUsuariosBusqueda($titulo,$activo)
    {//numero total de pacientes en la BD
        $answer = $this->queryList("SELECT COUNT(*) AS total FROM usuario WHERE (activo=? AND (first_name LIKE ? OR username LIKE ? OR last_name LIKE ?));",[$activo,$titulo,$titulo,$titulo]);
        return $answer;
    }
    public function roles($id)
    {
       
        $roles=$this->queryList("SELECT * FROM usuario_rol  WHERE id_usuario=?;", [$id] );
        $answer= array();
        foreach($roles as $rol)
        {
             $result=$this->queryList("SELECT * FROM rol  WHERE id=?;", [$rol['id_rol']]);
             $res=$result[0];
             $answer[]=$res['nombre'];
        }
        return $answer;       
    }
}
?>