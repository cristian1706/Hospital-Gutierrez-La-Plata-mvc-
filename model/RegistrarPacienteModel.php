<?php  
	class RegistrarPacienteModel extends ConexionDBModel
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

		public function agregarPaciente($nombre,$apellido,$fechaDeNacimiento,$genero,$tipoDocumento,$numeroDocumento,$domicilio,$telefono,$obraSocial)
		{
	       $this->queryList("INSERT INTO paciente(nombre, apellido, fechaDeNacimiento, genero, id_documento, numeroDocumento, domicilio, telefono, id_obraSocial,activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?);", [$nombre, $apellido, $fechaDeNacimiento, $genero, $tipoDocumento, $numeroDocumento, $domicilio, $telefono, $obraSocial,1] );
			$result=  $result=$this->queryList("SELECT * FROM paciente  WHERE numeroDocumento=?;",[$numeroDocumento]);
		   return $result;
		}


		public function noExiste($usuario)
		{
			$conexion=getConexion();
			$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE usuario=:usuario"); // Tanto el prepare como el bindParam nos ayuda
			$sentencia->bindParam(':usuario',$usuario);														// a evitar SQL INJECTION
			$sentencia->execute();
			$conexion=null;
			return $sentencia->rowCount()==0;
		}

		public function check_documento($documento)
		{
			$result=$this->queryList("SELECT COUNT(numeroDocumento) AS cant FROM paciente WHERE numeroDocumento=?;",[$documento]);
			return $result;
		}
	}
?>

