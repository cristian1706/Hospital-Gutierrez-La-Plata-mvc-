<?php
require_once("vendor/autoload.php");
require_once("model/TurnosModel.php");

// Instancia la app
$app = new \Slim\App();

// Devuelve todos los turnos disponibles
function obtenerTurnos() {
	return array('08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00');
}

// Funcion que valida que la fecha este en formato d-m-Y
function validarDatos($dato) {
    $d = DateTime::createFromFormat('d-m-Y', $dato);
    if ($d && $d->format('d-m-Y') === $dato)
    	return $d->format('Y-m-d'); // Lo devulve en un formato entendible por la DB
    return NULL;
}

// Funcion que valida que la hora este en formato Y-m-d
function validarTiempo($tiempo) {
    $formatoCorrecto = preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $tiempo);
	$turnos = obtenerTurnos();
	if($formatoCorrecto && in_array($tiempo, $turnos)){
		return $tiempo;
	}
    return NULL; 
}

// Funcion que devuelve todos los turnos posibles
function turnosDisponibles($dato) {
	$turnos = obtenerTurnos();

	// Obtengo los turnos reservados en esa fecha desde la DB
	$turnosModel = new TurnosModel();
	$turnosReservados = $turnosModel->turnosDisponibles($dato);

	// Borro los turnos que figuran en la DB (es decir, que ya estan reservados)
	foreach ($turnosReservados as $turnoReservado) {
		$horaTurno = $turnoReservado['horaTurno']; // Obtengo la hora de la DB
		$key = array_search($horaTurno, $turnos);
		if ($key !== false)
			unset($turnos[$key]);
	}

	//Reindexamos porque sino manda el JSON con las posiciones
	$turnos = array_values($turnos);
	return $turnos;
}

// Reserva un turno
function isInThePast($date) {
	$dateRequested = DateTime::createFromFormat('d-m-Y', $date);
	$now = new DateTime();
	return $dateRequested < $now;
}
// Funciones de rutas con Slim
// Obtener todos los turnos
$app->get('/{date}', function ($request, $response, $args) 
{
	$dato = validarDatos($args['date']);
	$ans = array();
	if (!is_null($dato)) 
	{ 
		if (isInThePast($args['date'])) 
		{
			$ans['success'] = false;
			$ans['dato'] = "Esa fecha ya paso";
		}
		else 
		{
			$ans['success'] = true;
			$ans['dato'] = turnosDisponibles($dato);
		}
	}
	else 
	{
		$ans['success'] = false;
		$ans['dato'] = "La fecha es incorrecta. Formato: dd-mm-yyyy";
	}
	return $response->withJson($ans);
});

// Reservar turno
$app->post('/{dni}/fecha/{date}/hora/{hour}', function ($request, $response, $args) {
	$dni = $args['dni'];
	$dato = validarDatos($args['date']);
	$hora =validarTiempo($args['hour']);
	$fecha = date('Y-m-d H:i:s', strtotime("$dato $hora"));
	// Checkeo si el turno ya se encuentra registrado en la DB
	$turnosModel = new TurnosModel();
	$exists = $turnosModel->exists($fecha);
	$ans = array();
	if (!is_null($dato) && !is_null($hora) && !$exists) {
		if (isInThePast($args['date'])) 
		{
			$ans['success'] = false;
			$ans['dato'] = "Esa fecha ya paso";
		} 
		else 
		{
			$pac=$turnosModel->existPaciente($dni);
			if(!$pac)
			{
				$ans['success'] = false;
				$ans['dato'] = "No es un paciente del hospital, para registrarse debe acercarse al hospital con su documento de identidad";
			}
			else
			{
				$ans['success'] = true; 
				$ans['dato'] = $turnosModel->insertTurno($dni, $fecha);
			}
		}
	}
	 else 
	 {
		$ans['success'] = false;
		if (is_null($dato)) 
		{
			$ans['dato'] = "La fecha es incorrecta. Formato: dd-mm-yyyy";
		} 
		else 
		{
			if ($exists) 
			{
				$ans['dato'] = "Ya se encuentra un turno reservado para esta fecha y hora";
			} 
			else 
			{
				if(is_null($hora))
				{
					$ans['dato'] = "La hora es incorrecta. Formato: hh:mm, utilize /turnos para consultar los turnos disponibles, /help para mas ayuda"; 
				}
			}
		}
	}
	return $response->withJson($ans);
});

// Corro la app
$app->run();

?>