                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <!DOCTYPE php>
<?php
// dichiarazione e inizializzazione variabili locali
$width = 120;
$height = 120;

if(isset($_GET["name"]))
{
	// trasformo il nome inserito in maiuscolo
	$string_upper = strtoupper($_GET["name"]);
    echo "<b>LISTA COCKTAILS CONTENENTI L'INGREDIENTE: ".$string_upper."</b><br>";
    
    // assegno alla variabile name il nome dell'ingrediente che � stato inserito dall'utente
	$name = $_GET["name"];
    
    // se nome non � vuoto
    if(!empty($_GET["name"]))
    {
    	// trasformo la stringa inserita dall'utente in url
    	// se il nome dell'ingrediente � composto da due nomi questi vengono uniti con il + nel mezzo
    	$stringa_decodificata = urlencode($name);
    	
    	// accodo il nome del cocktail inseriro all''url
    	$url = "https://drinkfinder.herokuapp.com/ws/GetIngredient.php?name=".$stringa_decodificata;
    	
    	// assegno alla variabile pagina il risultato della funzione file_get_content
		// legge tutto il file in una stringa
		// cio� il risultato della ricerca tramite l'url
    	$pagina = file_get_contents($url);
		
		// json_decode interpreta il file json
		// gli passo come parametri la pagina (in formato json) e il valore booleano true
		// che sta ad indicare che l'oggetto restituito sar� convertito in un array associativo
		// assegno alla variabile data il risultato della funzione
		$data = json_decode($pagina,true);
		echo "<br>";
		
		// se lo status � compreso tra 200 e 300 significa che il risultato � stato trovato
		if($data["status"] >= 200 
					&& $data["status"] < 300) 
		{
			// assegno a data tutti i dati trovati
			$data = $data["data"];
			
			for ($i = 0; 
					$i < count($data["ingredientName"]); 
					$i++) 
			{
				// stampo il nome del drink
				echo "<b>Drink:</b> ".$data["ingredientName"][$i]."<br><br>";
            
				// stampo l'immagine del drink
				// controllo se � presente il link dell'immagine del drink associato al nome
				if(isset($data["ingredientImage"][$i]) &&
							$data["ingredientImage"][$i] != "null")
				{
					// se il link � presente inserisco l'immagine trovata
					$img = $data["ingredientImage"][$i];
					// con le rispettive dimensioni
					echo "<img src=\"$img\" width=\"$width\" height=\"$height\"><br><br>";
				}
				else
					// altrimenti inserisco l'immagine di default
                	echo "<img src= .\defaultIngredient.jpg>";
                echo "<br>";
                
                // stampo la linea di separazione
                echo "<hr><hr>";
            }// end ciclo for
        
        }// altrimenti significa che il cocktail inserito non � presente
        else
    		echo "Ingrediente non presente<br><br>";
    }// altrimenti significa che il campo nome � stato lasciato vuoto
    else
    	echo "Richiesta non valida<br><br>";
}// end if

// stampo il bottone per tornare alla pagina iniziale
echo "<input type=\"button\" onclick=\"location.href='actionSelect.php'\" value=\"Indietro\"/> ";
// stampo il bottone per eseguire il logout
echo "<input type=\"button\" onclick=\"location.href='index.php'\" value=\"Logout\"/>";
?>

<!DOCTYPE HTML>
<html>
<body background = 'https://static.vecteezy.com/system/resources/previews/000/401/351/non_2x/vector-background-wallpaper-with-polygons-in-gradient-colors.jpg';
</html>