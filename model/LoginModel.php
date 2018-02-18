<?php   
Class LoginModel extends ConexionDBModel
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
	public function login($email, $clave)
	{
       $result =$this->queryList("SELECT * FROM usuario  WHERE email=? AND password=?;", [$email, $clave] );
            return $result; 
    }
    public function roles($id)
	{
       $roles=$this->queryList("SELECT * FROM usuario_rol  WHERE id_usuario=?;", [$id] );
       $answer= array();
       foreach($roles as $rol)
       {
            $result=$this->queryList("SELECT * FROM rol  WHERE id=?;", [$rol['id_rol']]);
            $res=$result[0];
    
            $answer[$res['id']]=$res['nombre'];
       }
       return $answer;       
	}
}

?>