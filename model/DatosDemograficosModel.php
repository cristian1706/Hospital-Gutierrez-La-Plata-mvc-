<?php  
class DatosDemograficosModel extends ConexionDBModel
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

	public function agregar($vivienda,$agua,$calefaccion,$heladera,$electricidad,$mascota,$id)
	{
		$this->queryList("INSERT INTO datos_demograficos(id_vivienda,id_agua,id_calefaccion,heladera,electricidad,mascota,id_paciente) VALUES (?, ?, ?, ?, ?, ?, ?);", [$vivienda,$agua,$calefaccion,$heladera,$electricidad,$mascota, $id] );

		
	}

	public function modificar($heladera,$electricidad,$mascota,$calefaccion,$vivienda,$agua,$idPaciente)
	{
		$this->queryList("UPDATE datos_demograficos SET heladera=?, electricidad=?, mascota=?, id_calefaccion=?, id_vivienda=?, id_agua=? WHERE id_paciente=?;",[$heladera,$electricidad,$mascota,$calefaccion,$vivienda,$agua,$idPaciente]);
    }//conexion hereda de objeto
    
    public function datosDemograficos($id)
    {
    	$result=$this->queryList("SELECT * FROM datos_demograficos WHERE id_paciente=?;",[$id]);
    	return $result;
    }

    public function tiposVivienda(){
    	return json_decode($this-> makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-vivienda", "GET"));
    }


    public function tipoVivienda($idVivienda){
    	return json_decode($this-> makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-vivienda/" . $idVivienda, "GET"));
    }

    public function tiposAgua(){
    	return json_decode($this->makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-agua", "GET"));
    }

    public function tipoAgua($idAgua){
    	return json_decode($this-> makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-agua/" . $idAgua, "GET"));
    }

    public function tiposCalefaccion(){
    	return json_decode($this->makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-calefaccion", "GET"));
    }

    public function tipoCalefaccion($idCalefaccion){
    	return json_decode($this-> makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-calefaccion/" . $idCalefaccion, "GET"));
    }

    public function tiposObraSocial(){
    	return json_decode($this->makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/obra-social", "GET"));
    }

    public function tipoObraSocial($idObraSocial){
    	return json_decode($this-> makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/obra-social/" . $idObraSocial, "GET"));
    }

    public function tiposDocumento(){
    	return json_decode($this-> makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-documento", "GET"));
    }

    public function tipoDocumento($idDocumento){
    	return json_decode($this-> makeRequest("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-documento/" . $idDocumento, "GET"));
    }


    function makeRequest($url,$method) {
    	$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    	curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query([]));
    	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    	$response = curl_exec($curl);
    	return $response;


    }
}
?>