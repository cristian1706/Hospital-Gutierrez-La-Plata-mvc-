<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require_once('require.php');	


$action = isset($_GET['action']) ? $_GET['action'] : NULL;	

//GraficosController::getInstance()->curvaPeso(1);
//die();
//GraficosController::getInstance()->curvaTalla(1);
//die();
//GraficosController::getInstance()->curvaPercentil(1);
//die();
//GraficosController::getInstance()->estadisticaHeladera();
//die();
//GraficosController::getInstance()->estadisticaElectricidad();
//die();
//GraficosController::getInstance()->estadisticaMascota();
//die();
//GraficosController::getInstance()->estadisticaCalefaccion();
//die();

switch ($action) 
{
	case '':
	LoginController::getInstance()->index();
	die();
	case 'login':
	LoginController::getInstance()->login();
	die();
	case 'cerrarSesion':
	LoginController::getInstance()->cerrarSesion();
	die();
	default:
	break;
}

$condicion = PermisosController::getInstance()->chequearPermisos($action);
if ($condicion)
{
	switch ($action) 
	{
		case 'configuracion_update':
		ConfiguracionAdminController::getInstance()->configurar();
		break;
		//CRUD Usuario
		case 'usuario_new':
		RegistrarUsuarioController::getInstance()->registrarUsuario();
		break;
		case 'usuario_update':
		$id = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : NULL;
		ModificarUsuarioController::getInstance()->modificarUsuario($id);
		break;
		case 'perfil_show':
		PerfilController::getInstance()->perfil();
		break;
		case 'usuario_destroy':
		$id = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : NULL;
		$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
		BorrarUsuarioController::getInstance()->borrarUsuario($id,$pag);//baja logica si o si!
		break;
		case 'usuario_index':
		$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
		ListarUsuarioController::getInstance()->listarUsuario($pag);
		break;
		case 'usuario_busqueda':
		$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
		ListarUsuarioBusquedaController::getInstance()->listarUsuario($pag);
		break;
		case 'usuario_reload':
		$id = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : NULL;
		$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
		ReactivarUsuarioController::getInstance()->reactivarUsuario($id,$pag);
		break;

		//CRUD Paciente
		case 'paciente_new':
		RegistrarPacienteController::getInstance()->registrarPaciente();
		break;
		case 'paciente_update':	
		$id = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		ModificarPacienteController::getInstance()->modificarPaciente($id);
		break;
		case 'paciente_show':
		$id = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		VerPacienteController::getInstance()->verPaciente($id);
		break;						
		case 'paciente_destroy':
		$id = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
		BorrarPacienteController::getInstance()->borrarPaciente($id,$pag);
		break;
		case 'paciente_index':
		$pag= isset($_GET['pag']) ? $_GET['pag'] : 1;
		ListarPacienteController::getInstance()->listarPaciente($pag);
		break;
		case 'paciente_busqueda':
		$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;
		ListarPacienteBusquedaController::getInstance()->listarPaciente($pag);
		break;
		case 'datosDem_show':
		$id = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		DatosDemograficosController::getInstance()->verDatosDemograficos($id);
		break;

		//Graficos de tortas y curvas de crecimientos
		case 'graficoPeso_show':
		$id = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		GraficosController::getInstance()->curvaPeso($id);
		break;
		case 'graficoTalla_show':
		$id = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		GraficosController::getInstance()->curvaTalla($id);
		break;
		case 'graficoPC_show':
		$id = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		GraficosController::getInstance()->curvaPercentil($id);
		break;

		// Estos gráficos son estadísticas generales de todos los pacientes
		case 'graficoHeladera_show':
		GraficosController::getInstance()->estadisticaHeladera();
		break;
		case 'graficoElectricidad_show':
		GraficosController::getInstance()->estadisticaElectricidad();
		break;
		case 'graficoMascota_show':
		GraficosController::getInstance()->estadisticaMascota();
		break;
		case 'graficoAgua_show':
		GraficosController::getInstance()->estadisticaAgua();
		break;
		case 'graficoVivienda_show':
		GraficosController::getInstance()->estadisticaVivienda();
		break;
		case 'graficoCalefaccion_show':
		GraficosController::getInstance()->estadisticaCalefaccion();
		break;

		//historia clinica
		case 'historiaClinica_new':
		$idPaciente = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		HistoriaClinicaController::getInstance()->registrarHistoriaClinica($idPaciente);
		break;
		case 'historiaClinica_show':
		$idHistoriaClinica = isset($_GET['idHistoriaClinica']) ? $_GET['idHistoriaClinica'] : NULL;
		HistoriaClinicaController::getInstance()->verHistoriaClinica($idHistoriaClinica);
		break;
		case 'historiaClinica_update':
		$idHistoriaClinica = isset($_GET['idHistoriaClinica']) ? $_GET['idHistoriaClinica'] : NULL;
		HistoriaClinicaController::getInstance()->modificarHistoriaClinica($idHistoriaClinica);
		break;
		case 'historiaClinica_index':
		$pag= isset($_GET['pag']) ? $_GET['pag'] : 1;
		$idPaciente = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		HistoriaClinicaController::getInstance()->listarHistoriasClinicas($idPaciente,$pag);
		break;
		case 'historiaClinica_destroy':
		$idPaciente = isset($_GET['idPaciente']) ? $_GET['idPaciente'] : NULL;
		$idHistoriaClinica = isset($_GET['idHistoriaClinica']) ? $_GET['idHistoriaClinica'] : NULL;
		HistoriaClinicaController::getInstance()->borrarHistoriaClinica($idHistoriaClinica,$idPaciente);
		break;
		default:		
		    break;
		}
	}

else
{
	if  (PermisosController::getInstance()->existeAccion($action))
	{
		$mensajeError = "No tiene permisos para realizar esta acción";	
	}
	else
	{
		$mensajeError = "No existe la acción que quiere realizar";
	}
	ErrorController::getInstance()->errorPermiso($mensajeError);
}


?>