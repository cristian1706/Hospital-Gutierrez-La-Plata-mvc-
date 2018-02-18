<?php
Class ModificarUsuarioModel extends ConexionDBModel
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
    public function modificar($email,$usuario,$clave,$nombre,$apellido,$updated_at)
    {
      $this->queryList("UPDATE usuario SET first_name=?, last_name=?, username=?, password=?, updated_at=?WHERE email=?;",[$nombre,$apellido,$usuario,$clave,$updated_at,$email]);
    }//conexion hereda de objeto
    
    public function datosUsuario($id)
    {
        $result=$this->queryList("SELECT * FROM usuario  WHERE id=?;",[$id]);
        return $result;
    }

    public function check_username($username,$idUsuario){
        $result=$this->queryList("SELECT COUNT(username) AS cant FROM usuario WHERE username=? AND id<>?;",[$username,$idUsuario]);
        return $result; 
    }

    public function check_email($email,$idUsuario){
        $result=$this->queryList("SELECT COUNT(email) AS cant FROM usuario WHERE email=? AND id<>?;",[$email,$idUsuario]);
        return $result; 
    }

    public function getRoles($idUsuario){
        $result=$this->queryList("SELECT id_rol FROM usuario_rol WHERE id_usuario=?;",[$idUsuario]);
        return $result;
    }

    public function usuarioRol($idUsuario,$id_rol){
        $this->queryList("INSERT INTO usuario_rol(id_usuario,id_rol) VALUES(?,?);",[$idUsuario,$id_rol]);
    }

    public function borrarRoles($idUsuario){
        $this->queryList("DELETE FROM usuario_rol WHERE id_usuario=?;",[$idUsuario]);
    }
    
}

?>