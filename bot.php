<?php
require_once("vendor/autoload.php");
ini_set("allow_url_fopen", 1);
$returnArray = true;
$rawData = file_get_contents('php://input');
$response = json_decode($rawData, $returnArray);
$id_del_chat = $response['message']['chat']['id'];


// Funcion que permite realizar un request
function makeRequest($url, $method, $content = array()) {
	$options = array( 'http' => array( 'header'  => "Content-type: application/x-www-form-urlencoded\r\n", 'method'  => $method, 'content' => http_build_query($content)));
	$context  = stream_context_create($options);
	return file_get_contents($url, false, $context);
}

//comando (y sus posibles parametros)
$regExp = '#^(\/[a-zA-Z0-9\/]+?)(\ .*?)$#i';

$tmp = preg_match($regExp, $response['message']['text'], $aResults);

if (isset($aResults[1])) {
    $cmd = trim($aResults[1]);
    $cmd_params = trim($aResults[2]);
} else {
    $cmd = trim($response['message']['text']);
    $cmd_params = '';
}

$msg = array();
$msg['chat_id'] = $response['message']['chat']['id'];
$msg['text'] = null;
$msg['disable_web_page_preview'] = true;
$msg['reply_to_message_id'] = $response['message']['message_id'];
$msg['reply_markup'] = null;

switch ($cmd) {
	case '/start':
	    $msg['text']  = 'Hola ' . $response['message']['from']['first_name'] . '!' . PHP_EOL;
	    $msg['text'] .= 'Use el comendo /help para ver los comandos disponibles';
	    break;

	case '/help':
	    $msg['text']  = 'Los comandos disponibles son:' . PHP_EOL;
	    $msg['text'] .= '/start Inicia el bot' . PHP_EOL;
	    $msg['text'] .= '/turnos dd-mm-aaaa Muestra los turnos disponibles del día' . PHP_EOL;
	    $msg['text'] .= '/reservar dni dd-mm-aaaa hh:mm Realiza la reserva del turno' . PHP_EOL;
	    $msg['text'] .= '/help Muestra esta ayuda';
	    break;

	case '/reservar':
		$params = preg_split("/[\s]+/", $cmd_params);
		if (!isset($params[0]) || !isset($params[1]) || !isset($params[2])) {
			$msg['text'] = "Error: Falta algun dato,utilice /help para ver el formato";
		} else {
			$dni = $params[0];
			$date = $params[1];
			$hour = $params[2];
			$url = 'https://grupo26.proyecto2017.linti.unlp.edu.ar/turnosBot.php/' . $dni . "/fecha/" . $date . "/hora/" . $hour;
			$json = makeRequest($url, 'POST');
			$obj = json_decode($json);
			if ($obj->success == true) {
			    $msg['text']  = 'Te confirmamos el turno para la fecha: ' . $date . PHP_EOL;
			    $msg['text'] .= 'En el horario: ' . $hour . PHP_EOL;
			} else {
				$msg['text'] = 'Error: ' . $obj->dato;
			}
		}
	    break;

	case '/turnos':
        if(strlen($cmd_params) == 0) 
        {
			$msg['text'] = "Error: Falta especificar la fecha";
        } 
        else 
        {
			$url = 'https://grupo26.proyecto2017.linti.unlp.edu.ar/turnosBot.php/' . $cmd_params;
			$json = makeRequest($url, 'GET');
            $obj = json_decode($json);
            if ($obj->success == true) 
            {
				$msg['text'] = 'Los turnos disponibles para la fecha ' . str_replace("-", "/", $cmd_params) . ' son: ' . implode(", ", $obj->dato);
            } 
            else 
            {
				$msg['text'] = "Error:".$obj->dato;
			}
		}
		break;

		default:
		$msg['text'] = $cmd. " no es un comando diaponible, /help para mas ayuda" ;
		break;
}

$msg['reply_to_message_id'] = null;

// Envio el mensaje al bot
makeRequest('https://api.telegram.org/bot416015887:AAGxgewQroED5T_YpLSVGlyyughNDsysmZ4/sendMessage', 'POST', $msg);

exit(0);
?>