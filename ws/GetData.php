<?php
// il messaggio indicherà se la richiesta è valida oppure no
// e se la risposta è stata trovata oppure no
function deliver_response($status,
							$status_message,
							$data)
{
	header("HTTP/1.1 $status $status_message");

	// le variabili dell'argomento devono essere formattate in JSON
	// le memorizzo quindi in un array response in formato JSON
	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;
	
	// codifica dell'array response in formato JSON
	$json_response = json_encode($response);
	
	// stampa a video della risposta
	echo $json_response;
}

function getData($url)
{
	// assegno alla variabile pagina il risultato della funzione file_get_content
	// legge tutto il file in una stringa
	// cioè il risultato della ricerca tramite l'url
	$pagina = file_get_contents($url);
		
	// json_decode interpreta il file json
	// gli passo come parametri la pagina (in formato json) e il valore booleano true
	// che sta ad indicare che l'oggetto restituito sarà convertito in un array associativo
	// assegno alla variabile json_output il risultato della funzione
	$output = json_decode($pagina,true);
	
	return $output;
}
?>