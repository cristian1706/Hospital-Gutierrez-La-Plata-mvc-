<?php  

class GraficosController
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

/*
$date1 = new DateTime("2010-07-06");
$date2 = new DateTime("2010-07-09");

$diff = $date2->diff($date1)->format("%a");
*/
	public function curvaPeso($idPaciente)
	{
		//Traer paciente
		$infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
        $infoGeneral = $infoGral[0];        
		$paciente = ModificarPacienteModel::getInstance()->datosPaciente($idPaciente);
		$fechaNacimiento = $paciente[0]['fechaDeNacimiento'];		
		$fecha = date_create($fechaNacimiento);
		date_add($fecha, date_interval_create_from_date_string('13 weeks'));
		$fechaFinal=date_format($fecha, 'Y-m-d');
		$pesoPorFecha = GraficosModel::getInstance()->datosPeso($idPaciente,$fechaNacimiento, $fechaFinal);
		//var_dump($pesoPorFecha);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showPeso($pesoPorFecha,$fechaNacimiento,$rol,$user);

		//traer historias clinicas desde el modelo
		//(id,fechaNacimiento, fin)
		//mostrar Vista
		/*
			{% set difference = date(endDate).diff(date(startDate)) %}
			{% set leftDays = difference.days %}
		*/
		

	}


	public function curvaTalla($idPaciente)
	{
		$paciente = ModificarPacienteModel::getInstance()->datosPaciente($idPaciente);
		$fechaNacimiento = $paciente[0]['fechaDeNacimiento'];		
		$fecha = date_create($fechaNacimiento);
		date_add($fecha, date_interval_create_from_date_string('24 months'));
		$fechaFinal=date_format($fecha, 'Y-m-d');
		$tallaPorFecha = GraficosModel::getInstance()->datosTalla($idPaciente,$fechaNacimiento, $fechaFinal);
		//var_dump($pesoPorFecha);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showTalla($tallaPorFecha,$fechaNacimiento,$rol,$user);
	}

	public function curvaPercentil($idPaciente)
	{
		$paciente = ModificarPacienteModel::getInstance()->datosPaciente($idPaciente);
		$fechaNacimiento = $paciente[0]['fechaDeNacimiento'];		
		$fecha = date_create($fechaNacimiento);
		date_add($fecha, date_interval_create_from_date_string('13 weeks'));
		$fechaFinal=date_format($fecha, 'Y-m-d');
		$percentilPorFecha = GraficosModel::getInstance()->datosPercentil($idPaciente,$fechaNacimiento, $fechaFinal);
		//var_dump($pesoPorFecha);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showPercentil($percentilPorFecha,$fechaNacimiento,$rol,$user);
	}

	public function estadisticaHeladera()
	{
		// El 1 siempre es por SI
		$consulta = GraficosModel::getInstance()->heladera(1);
		$aux = $consulta[0]['total'];
		$tienenHeladera = intval($aux);		
		$consulta = GraficosModel::getInstance()->heladera(0);
		$aux = $consulta[0]['total'];
		$noTienenHeladera = intval($aux);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showHeladera($tienenHeladera,$noTienenHeladera,$rol,$user);
	}

	public function estadisticaElectricidad()
	{
		$consulta = GraficosModel::getInstance()->electricidad(1);
		$aux = $consulta[0]['total'];
		$tienenElectricidad = intval($aux);		
		$consulta = GraficosModel::getInstance()->electricidad(0);
		$aux = $consulta[0]['total'];
		$noTienenElectricidad = intval($aux);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showElectricidad($tienenElectricidad,$noTienenElectricidad,$rol,$user);
	}

	public function estadisticaMascota()
	{
		$consulta = GraficosModel::getInstance()->mascota(1);
		$aux = $consulta[0]['total'];
		$tienenMascota = intval($aux);		
		$consulta = GraficosModel::getInstance()->mascota(0);
		$aux = $consulta[0]['total'];
		$noTienenMascota = intval($aux);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showMascota($tienenMascota,$noTienenMascota,$rol,$user);
	}

	public function estadisticaAgua()
	{
		$consulta = GraficosModel::getInstance()->agua(1);
		$aux = $consulta[0]['total'];
		$aguaCorriente = intval($aux);		
		$consulta = GraficosModel::getInstance()->agua(2);
		$aux = $consulta[0]['total'];
		$aguaPozo = intval($aux);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showAgua($aguaCorriente,$aguaPozo,$rol,$user);
	}

	public function estadisticaVivienda()
	{
		$consulta = GraficosModel::getInstance()->vivienda(1);
		$aux = $consulta[0]['total'];
		$material = intval($aux);		
		$consulta = GraficosModel::getInstance()->vivienda(2);
		$aux = $consulta[0]['total'];
		$chapa = intval($aux);
		$consulta = GraficosModel::getInstance()->vivienda(3);
		$aux = $consulta[0]['total'];
		$madera = intval($aux);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];		
		GraficosView::getInstance()->showVivienda($material,$chapa,$madera,$rol,$user);
	}

	public function estadisticaCalefaccion()
	{
		$consulta = GraficosModel::getInstance()->calefaccion(1);
		$aux = $consulta[0]['total'];
		$gas = intval($aux);		
		$consulta = GraficosModel::getInstance()->calefaccion(2);
		$aux = $consulta[0]['total'];
		$lenia = intval($aux);
		$consulta = GraficosModel::getInstance()->calefaccion(3);
		$aux = $consulta[0]['total'];
		$electrica = intval($aux);
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		GraficosView::getInstance()->showCalefaccion($gas,$lenia,$electrica,$rol,$user);
	}
}

?>