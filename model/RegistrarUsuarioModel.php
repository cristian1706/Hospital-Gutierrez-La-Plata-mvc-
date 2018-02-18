<?php  
	class RegistrarUsuarioModel extends ConexionDBModel
	{	      
		protected static $instance;
		//private static $connection;
		//get instance singelton
		public static function getInstance()
		{
			if (!isset(self::$instance)) 
			{
				self::$instance = new self();
			}
	
			return self::$instance;
		}

		public function agregarUsuario($first_name,$last_name,$username,$password,$email, $created_at, $updated_at)
		{
	       $this->queryList("INSERT INTO usuario(first_name, last_name, username, password, email, created_at, updated_at,activo) VALUES (?, ?, ?, ?, ?, ?, ?,?);", [$first_name, $last_name, $username, $password, $email, $created_at, $updated_at,1] );
		   $result=$this->queryList("SELECT * FROM usuario  WHERE email=?;",[$email]);
		   return $result;
		}

		public function roles()
		{
			$roles=$this->queryList("SELECT * FROM rol;",[]);
			return $roles;
		}

		public function usuarioRol($idUsuario,$id_rol)
		{
			$this->queryList("INSERT INTO usuario_rol(id_usuario,id_rol) VALUES(?,?);" , [$idUsuario,$id_rol]);
		}

		public function noExiste($usuario)
		{
			$conexion=getConexion();
			$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE usuario=:usuario"); 
			// Tanto el prepare como el bindParam nos ayuda a evitar SQL INJECTION
			$sentencia->bindParam(':usuario',$usuario);	
			$sentencia->execute();
			$conexion=null;
			return $sentencia->rowCount()==0;
		}

		public function check_username($username){
			$result=$this->queryList("SELECT COUNT(username) AS cant FROM usuario WHERE username=?;",[$username]);
			return $result;	
		}

		public function check_email($email){
			$result=$this->queryList("SELECT COUNT(email) AS cant FROM usuario WHERE email=?;",[$email]);
			return $result;	
		}

	}
?>

