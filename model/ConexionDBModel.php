<?php  
class ConexionDBModel 
{

	const USERNAME = "grupo26";
    const PASSWORD = "NzdhOGVkODkxN2Yz";
	const HOST ="localhost";
	const DB = "grupo26";
    
    
    protected function getConnection(){
        $u=self::USERNAME;
        $p=self::PASSWORD;
        $db=self::DB;
        $host=self::HOST;
        $connection = new PDO("mysql:dbname=$db;host=$host;charset=utf8", $u, $p);
        return $connection;
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