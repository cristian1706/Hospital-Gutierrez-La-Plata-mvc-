<?php  
class ConexionDBModel 
{

	private static $connection;
  
	public static function getConnection()
	{
		if (!isset(self::$connection)) 
		{
			$db_host="localhost";
			$db_user="root";
			$db_pass="";
			$db_base="grupo26";
			$connection_uri="mysql:host=".$db_host.";dbname=".$db_base;
			$con = new PDO($connection_uri,$db_user,$db_pass);
			return $con;
		}
		
		return self::$connection;
	}

	protected function queryList($sql,$args){
		$connection = $this->getConnection();
		$statement = $connection->prepare($sql);
		$statement->execute($args);
		$a= $statement->fetchAll();
		return $a;
	}

}

?>