<?php  
class DatosDemograficosController 
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
	public function agregarDatosDemograficos()
	{
			$user=$_SESSION['username'];
			$rol=$_SESSION['roles'];
			DatosDemograficosView::getInstance()->show($user,$rol);

	}
	public function verDatosDemograficos($idPaciente){

			if (isset($_SESSION['idUsuario']))
			{
				$rol=$_SESSION['roles'];
				$user=$_SESSION['username'];
				$idUsuario=$_SESSION['idUsuario'];
				$datosDemograficos = DatosDemograficosModel::getInstance()->datosDemograficos($idPaciente);
				$infoPaciente = ListarPacienteModel::getInstance()->getPaciente($idPaciente);
				
				$vivienda=DatosDemograficosModel::getInstance()->tipoVivienda($datosDemograficos[0]["id_vivienda"]);
				$agua=DatosDemograficosModel::getInstance()->tipoAgua($datosDemograficos[0]["id_agua"]);
                $calefaccion=DatosDemograficosModel::getInstance()->tipoCalefaccion($datosDemograficos[0]["id_calefaccion"]);

				$paciente = $infoPaciente[0];
				DatosDemograficosView::getInstance()->show($datosDemograficos[0],$paciente,$user,$rol,$idUsuario,$vivienda,$agua,$calefaccion);
			}
			else
			{
				$mensajeError = "";
				LoginView::getInstance()->show($mensajeError);
			}
	}

}

?>