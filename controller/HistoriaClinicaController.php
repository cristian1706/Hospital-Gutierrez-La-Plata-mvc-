<?php  
class HistoriaClinicaController 
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


	public function registrarHistoriaClinica($idPaciente) {
		
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		$idUsuario = $_SESSION['idUsuario'];
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			if (/*isset($_POST['fechaConsulta']) and isset($_POST['edad']) and */isset($_POST['peso']) and isset($_POST['vacunas_completas']) and isset($_POST['maduracion_acorde']) and isset($_POST['ex_fisico_normal']) and isset($_POST['ex_fisico_observaciones']) and isset($_POST['pc']) and isset($_POST['ppc']) and isset($_POST['talla']) and isset($_POST['alimentacion']) and isset($_POST['observaciones_generales']) and isset($_POST['vacunas_observaciones']) and isset($_POST['maduracion_observaciones']) and isset($_POST['idPaciente'])) {

				if (/*(!empty($_POST['fechaConsulta'])) and (!empty($_POST['edad'])) and */(!empty($_POST['peso'])) and (!empty($_POST['ex_fisico_observaciones'])) and (!empty($_POST['vacunas_observaciones'])) and (!empty($_POST['maduracion_observaciones'])) and (!empty($_POST['idPaciente'])) and (strlen(str_replace(' ','',$_POST['vacunas_completas']))!=0) and (strlen(str_replace(' ','',$_POST['maduracion_acorde']))!=0) and (strlen(str_replace(' ','',$_POST['ex_fisico_normal']))!=0)) {

					//$fechaConsulta = ValidarDatosController::getInstance()->validarDatos($_POST['fechaConsulta']);
					$fechaConsulta = date("Y-m-d H:i:s");
					//$edad = ValidarDatosController::getInstance()->validarDatos($_POST['edad']);
					$peso = ValidarDatosController::getInstance()->validarDatos($_POST['peso']);
					$vacunas_completas = ValidarDatosController::getInstance()->validarDatos($_POST['vacunas_completas']);
					$vacunas_observaciones = ValidarDatosController::getInstance()->validarDatos($_POST['vacunas_observaciones']);
					$maduracion_acorde = ValidarDatosController::getInstance()->validarDatos($_POST['maduracion_acorde']);
					$maduracion_observaciones = ValidarDatosController::getInstance()->validarDatos($_POST['maduracion_observaciones']);
					$ex_fisico_normal = ValidarDatosController::getInstance()->validarDatos($_POST['ex_fisico_normal']);
					$ex_fisico_observaciones = ValidarDatosController::getInstance()->validarDatos($_POST['ex_fisico_observaciones']);
					$pc = ValidarDatosController::getInstance()->validarDatos($_POST['pc']);
					$ppc = ValidarDatosController::getInstance()->validarDatos($_POST['ppc']);
					$talla = ValidarDatosController::getInstance()->validarDatos($_POST['talla']);
					$alimentacion = ValidarDatosController::getInstance()->validarDatos($_POST['alimentacion']);
					$observaciones_generales = ValidarDatosController::getInstance()->validarDatos($_POST['observaciones_generales']);
					$idPaciente = ValidarDatosController::getInstance()->validarDatos($_POST['idPaciente']);

					HistoriaClinicaModel::getInstance()->registrarHistoriaClinica($fechaConsulta,$peso,$vacunas_completas,$vacunas_observaciones,$maduracion_acorde,$maduracion_observaciones,$ex_fisico_normal,$ex_fisico_observaciones,$pc,$ppc,$talla,$alimentacion,$observaciones_generales,$idPaciente,$idUsuario);
					$mensajeExito = "La historia clinica ha sido registrada exitosamente";
					$historia_clinica_query = HistoriaClinicaModel::getInstance()->getHistoriaClinicaByFecha($fechaConsulta);
					$historia_clinica = $historia_clinica_query[0];
					$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($idPaciente);
					$paciente = $pacienteQuery[0];
					$fechaNacimiento = $paciente['fechaDeNacimiento'];
					$fechaActual = date('Y-m-d');
					$edad = $fechaActual - $fechaNacimiento;
					HistoriaClinicaView::getInstance()->showHistoriaClinica($historia_clinica,$user,$rol,$idUsuario,$paciente,$edad);

				}
				else {
					
					$mensajeError = "No se puede registrar si deja campos vacíos";
					$idPaciente = ValidarDatosController::getInstance()->validarDatos($_POST['idPaciente']);
					$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($idPaciente);
					$paciente = $pacienteQuery[0];
					HistoriaClinicaView::getInstance()->showRegistrarHistoriaClinica($user,$rol,$idUsuario,$idPaciente,$paciente,$mensajeError);
				}
			}
			else {
				$mensajeError = "Por favor no elimine campos del formulario";
				$idPaciente = ValidarDatosController::getInstance()->validarDatos($_POST['idPaciente']);
				$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($idPaciente);
				$paciente = $pacienteQuery[0];
				HistoriaClinicaView::getInstance()->showRegistrarHistoriaClinica($user,$rol,$idUsuario,$idPaciente,$paciente,$mensajeError);
			}
		}
		else {
			$mensajeError = "";
			$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($idPaciente);
			$paciente = $pacienteQuery[0];
			HistoriaClinicaView::getInstance()->showRegistrarHistoriaClinica($user,$rol,$idUsuario,$idPaciente,$paciente,$mensajeError);
		}
	}


	public function verHistoriaClinica($idHistoriaClinica) {
		$rol = $_SESSION['roles'];
		$user = $_SESSION['username'];
		$idUsuario = $_SESSION['idUsuario'];
		$historia_clinica = HistoriaClinicaModel::getInstance()->getHistoriaClinica($idHistoriaClinica);
		$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($historia_clinica[0]['id_paciente']);
		$paciente = $pacienteQuery[0];
		$fechaNacimiento = $paciente['fechaDeNacimiento'];
		$fechaActual = date('Y-m-d');
		$edad = $fechaActual - $fechaNacimiento;
		HistoriaClinicaView::getInstance()->showHistoriaClinica($historia_clinica[0],$user,$rol,$idUsuario,$paciente,$edad);
	}


	public function modificarHistoriaClinica($idHistoriaClinica) {
		
		$rol=$_SESSION['roles'];
		$user=$_SESSION['username'];
		$idUsuario = $_SESSION['idUsuario'];
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			if (isset($_POST['peso']) and isset($_POST['vacunas_completas']) and isset($_POST['maduracion_acorde']) and isset($_POST['ex_fisico_normal']) and isset($_POST['ex_fisico_observaciones']) and isset($_POST['pc']) and isset($_POST['ppc']) and isset($_POST['talla']) and isset($_POST['alimentacion']) and isset($_POST['observaciones_generales']) and isset($_POST['vacunas_observaciones']) and isset($_POST['maduracion_observaciones']) and isset($_POST['idHistoriaClinica'])) {

				if (/*(!empty($_POST['fechaConsulta'])) and (!empty($_POST['edad'])) and */(!empty($_POST['peso'])) and (!empty($_POST['ex_fisico_observaciones'])) and (!empty($_POST['vacunas_observaciones'])) and (!empty($_POST['maduracion_observaciones'])) and (!empty($_POST['idHistoriaClinica'])) and (strlen(str_replace(' ','',$_POST['vacunas_completas']))!=0) and (strlen(str_replace(' ','',$_POST['maduracion_acorde']))!=0) and (strlen(str_replace(' ','',$_POST['ex_fisico_normal']))!=0)) {

					//$fechaConsulta = ValidarDatosController::getInstance()->validarDatos($_POST['fechaConsulta']);
					//$edad = ValidarDatosController::getInstance()->validarDatos($_POST['edad']);
					$peso = ValidarDatosController::getInstance()->validarDatos($_POST['peso']);
					$vacunas_completas = ValidarDatosController::getInstance()->validarDatos($_POST['vacunas_completas']);
					$vacunas_observaciones = ValidarDatosController::getInstance()->validarDatos($_POST['vacunas_observaciones']);
					$maduracion_acorde = ValidarDatosController::getInstance()->validarDatos($_POST['maduracion_acorde']);
					$maduracion_observaciones = ValidarDatosController::getInstance()->validarDatos($_POST['maduracion_observaciones']);
					$ex_fisico_normal = ValidarDatosController::getInstance()->validarDatos($_POST['ex_fisico_normal']);
					$ex_fisico_observaciones = ValidarDatosController::getInstance()->validarDatos($_POST['ex_fisico_observaciones']);
					$pc = ValidarDatosController::getInstance()->validarDatos($_POST['pc']);
					$ppc = ValidarDatosController::getInstance()->validarDatos($_POST['ppc']);
					$talla = ValidarDatosController::getInstance()->validarDatos($_POST['talla']);
					$alimentacion = ValidarDatosController::getInstance()->validarDatos($_POST['alimentacion']);
					$observaciones_generales = ValidarDatosController::getInstance()->validarDatos($_POST['observaciones_generales']);
					//$idPaciente = ValidarDatosController::getInstance()->validarDatos($_POST['idPaciente']);
					$idHistoriaClinica = ValidarDatosController::getInstance()->validarDatos($_POST['idHistoriaClinica']);

					HistoriaClinicaModel::getInstance()->modificarHistoriaClinica($idHistoriaClinica,$peso,$vacunas_completas,$vacunas_observaciones,$maduracion_acorde,$maduracion_observaciones,$ex_fisico_normal,$ex_fisico_observaciones,$pc,$ppc,$talla,$alimentacion,$observaciones_generales);
					
											//FALTA REDIRIGIR CON MENSAJE DE EXITO
					$mensajeExito = "La historia clinica ha sido modificada exitosamente";
					$historia_clinica = HistoriaClinicaModel::getInstance()->getHistoriaClinica($idHistoriaClinica);
					$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($historia_clinica[0]['id_paciente']);
					$paciente = $pacienteQuery[0];
					$fechaNacimiento = $paciente['fechaDeNacimiento'];
					$fechaActual = date('Y-m-d');
					$edad = $fechaActual - $fechaNacimiento;
					HistoriaClinicaView::getInstance()->showHistoriaClinica($historia_clinica[0],$user,$rol,$idUsuario,$paciente,$edad);

				}
				else {
					$mensajeError= "No se puede modificar si deja campos vacíos";
					$idHistoriaClinica = ValidarDatosController::getInstance()->validarDatos($_POST['idHistoriaClinica']);
					$historia_clinica = HistoriaClinicaModel::getInstance()->getHistoriaClinica($idHistoriaClinica);
					$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($historia_clinica[0]['id_paciente']);
					$paciente = $pacienteQuery[0];
					HistoriaClinicaView::getInstance()->showModificarHistoriaClinica($historia_clinica[0],$user,$rol,$idUsuario,$paciente,$mensajeError);
				}
			}
			else {
				$mensajeError= "Por favor no elimine campos del formulario";
				$idHistoriaClinica = ValidarDatosController::getInstance()->validarDatos($_POST['idHistoriaClinica']);
				$historia_clinica = HistoriaClinicaModel::getInstance()->getHistoriaClinica($idHistoriaClinica);
				$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($historia_clinica[0]['id_paciente']);
				$paciente = $pacienteQuery[0];
				HistoriaClinicaView::getInstance()->showModificarHistoriaClinica($historia_clinica[0],$user,$rol,$idUsuario,$paciente,$mensajeError);
			}
		}
		else {
			$mensajeError = "";
			$historia_clinica = HistoriaClinicaModel::getInstance()->getHistoriaClinica($idHistoriaClinica);
			$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($historia_clinica[0]['id_paciente']);
			$paciente = $pacienteQuery[0];
			HistoriaClinicaView::getInstance()->showModificarHistoriaClinica($historia_clinica[0],$user,$rol,$idUsuario,$paciente,$mensajeError);
		}
	}


	public function borrarHistoriaClinica($idHistoriaClinica,$idPaciente) {
		$rol = $_SESSION['roles'];
		$user = $_SESSION['username'];
		$idUsuario = $_SESSION['idUsuario'];
		$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($idPaciente);
		$paciente = $pacienteQuery[0]; 
		HistoriaClinicaModel::getInstance()->borrarHistoriaClinica($idHistoriaClinica);
		$historia_clinica = HistoriaClinicaModel::getInstance()->getListadoHistoriasClinicas($idPaciente); 
		//HistoriaClinicaView::getInstance()->showListadoHistoriasClinicas($historia_clinica,$user,$rol,$idUsuario,$idPaciente,$paciente);
		$this->listarHistoriasClinicas($idPaciente,1);
	}


	public function listarHistoriasClinicas($idPaciente,$pagina) {
		$rol = $_SESSION['roles'];
		$user = $_SESSION['username'];
		$idUsuario = $_SESSION['idUsuario'];
		$infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
		$infoGeneral = $infoGral[0];
		$paginacion=$infoGeneral['cant_elementos_pagina'];
		$paginasLista=HistoriaClinicaController::getInstance()->paginar($paginacion, $pagina,$idPaciente);
		//Para moverse de página
		$mover=array();
		$mover['actual']=$pagina;
		$mover['final']=$paginasLista['nroPaginas'];
		if($pagina+1<$paginasLista['nroPaginas'])
		{
			$mover['sig']=$pagina+1;
		}
		else
		{
			$mover['sig']=$paginasLista['nroPaginas'];
		}
		if($pagina-1>1)
		{
			$mover['ant']=$pagina-1;
		}
		else
		{
			$mover['ant']=1;
		}                    
		//control para no salirse de la primera pagina ni la ultima!
		if($paginasLista['nroPaginas']<$pagina)
		{
			$pagina=$paginasLista['nroPaginas'];
			$paginasLista=HistoriaClinicaController::getInstance()->paginar($paginacion, $pagina, $idPaciente);
		}
		$lista=array('paginas'=>  $paginasLista['paginasNro'],'listaPaginada'=> $paginasLista['consultas']);
		$pacienteQuery = VerPacienteModel::getInstance()->verPaciente($idPaciente);
		$paciente = $pacienteQuery[0];
		HistoriaClinicaView::getInstance()->showListadoHistoriasClinicas($lista,$mover,$user,$rol,$idUsuario,$idPaciente,$paciente);
	}
	public function paginar($hcPorPagina,$paginaActual,$idPaciente)
    {
        
        $paginasLista=array();//la funcion retorna este array
        if($paginaActual<1)
        {
            $paginaActual=1;
        }
        $offSet=($paginaActual-1)*$hcPorPagina;//FILA INICIAL!! PRIMER PACIENTE DE LA LISTA EN LA PAGINA
        $porPagina=(int)$hcPorPagina;
        $filasHC=HistoriaClinicaModel::getInstance()->hcPagina($offSet,$porPagina,$idPaciente);
        $nroFilasTotal=HistoriaClinicaModel::getInstance()->nroHC($idPaciente);
        $nro_FilasTotal=$nroFilasTotal[0];
        $totalFilas=(int)$nro_FilasTotal['total'];
        //generar el href en un arreglo para poder ir de posicion en posicion
        $paginas=array();
        $nroPaginas=ceil($totalFilas/$hcPorPagina);//ceil redondea para arriba
        for($nro=1; $nro<=$nroPaginas;$nro++)
        {
            $paginas[$nro]='pag='.$nro;
        }
        
        $paginasLista['paginasNro']=$paginas;
		$paginasLista['consultas']= $filasHC;
        $paginasLista['nroPaginas']=$nroPaginas;
        return $paginasLista;
    }

}

?>