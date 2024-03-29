<!DOCTYPE php>
<?php
// dichiarazione e inizializzazione variabili locali
$width = 160;
$height = 160;
$ingredients = "";
$measures = "";

if(isset($_GET["name"]))
{
	// trasformo il nome inserito in maiuscolo
	$string_upper = strtoupper($_GET["name"]);
    echo "<b>LISTA COCKTAILS CON NOME: ".$string_upper."</b><br>";
    
    // assegno alla variabile name il nome del drink che � stato inserito dall'utente
	$name = $_GET["name"];
	
    // se nome non � vuoto
    if(!empty($name))
    {
    	// trasformo la stringa inserita dall'utente in url
    	// se il drink � composto da due nomi questi vengono uniti con il + nel mezzo
    	$stringa_decodificata = urlencode($name);
    	
    	// accodo il nome del cocktail inseriro all''url
    	$url = "https://drinkfinder.herokuapp.com/ws/GetDrink.php?name=".$stringa_decodificata;
    	
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
					$i < count($data["drinkName"]); 
					$i++) 
			{
				// stampo il nome del cocktail
				echo "<b>Drink:</b> ".$data["drinkName"][$i]."<br><br>";
				
				// stampo l'immagine del cocktail
				// controllo se � presente il link dell'immagine del drink associato al nome
				if(isset($data["drinkImage"][$i]) 
							&& $data["drinkImage"][$i] != "null")
				{
					// se il link � presente inserisco l'immagine
					$img = $data["drinkImage"][$i];
					echo "<img src=\"$img\" width=\"$width\" height=\"$height\"><br>";
				}
				else
					// altrimenti inserisco l'immagine di default
					echo "<img src= .\defaultDrink.jpg>";
				echo "<br>";
	
				// se � presente stampo la categoria del cocktail
				if(isset($data["drinkCategory"][$i]) 
							&& $data["drinkCategory"][$i] != "null" )
					echo "<b>Category:</b> ".$data["drinkCategory"][$i];
				else
					echo "Cagtegory: not present";
				echo "<br>";
				
				// stampo caratteristica del cocktail
				if(isset($data["drinkAlcoholic"][$i]) 
							&& $data["drinkAlcoholic"][$i] != "null" )
					echo "<b>Alcholic:</b> ".$data["drinkAlcoholic"][$i];
				else
					echo "Alcholic: not present";
				echo "<br>";
	
			   // stampo caratteristica del cocktail
				if(isset($data["drinkGlass"][$i]) 
							&& $data["drinkGlass"][$i] != "null" )
					echo "<b>Glass:</b> ".$data["drinkGlass"][$i];
				else
					echo "Glass: not present";
				echo "<br>";
	
				// stampo la ricetta del cocktail
				if(isset($data["drinkInstructions"][$i]) 
							&& $data["drinkInstructions"][$i] != "null" )
					echo "<b>Instructions:</b> ".$data["drinkInstructions"][$i];
				else
					echo "Instructions: not present";
				echo "<br>";
				
				// stampo gli ingredienti del cocktail
				// per ogni ingrediente del drink controllo se � presente ed � diverso da null
				// in caso positivo lo aggiungo ad ingrediends
				$ingredients="";
				if(isset($data["drinkIngredient1"][$i]) 
							&& $data["drinkIngredient1"][$i] != "null" )
				   $ingredients = $ingredients.$data["drinkIngredient1"][$i];
				
				if(isset($data["drinkIngredient2"][$i]) 
							&& $data["drinkIngredient2"][$i] != "null" )
				   $ingredients = $ingredients.", ".$data["drinkIngredient2"][$i];
				   
				if(isset($data["drinkIngredient3"][$i]) 
							&& $data["drinkIngredient3"][$i] != "null" )
				   $ingredients = $ingredients.", ".$data["drinkIngredient3"][$i];
				   
				if(isset($data["drinkIngredient4"][$i]) 
							&& $data["drinkIngredient4"][$i] != "null" )
				   $ingredients = $ingredients.", ".$data["drinkIngredient4"][$i];
				   
			   // stampo tutti gli ingredienti 
			   echo "<b>Ingredients:</b> ".$ingredients."<br>";
			   
			   // stampo le dosi del cocktail
			   // per ogni dose del drink controllo se � presente ed � diversa da null
			   // in caso positivo la aggiungo a measures
			   $measures="";
				if(isset($data["drinkMeasure1"][$i]) 
							&& $data["drinkMeasure1"][$i] != "null" )
					$measures = $measures.$data["drinkMeasure1"][$i];
					
				if(isset($data["drinkMeasure2"][$i]) 
							&& $data["drinkMeasure2"][$i] != "null" )
					$measures = $measures.", ".$data["drinkMeasure2"][$i];
					
				if(isset($data["drinkMeasure3"][$i]) 
							&& $data["drinkMeasure3"][$i] != "null" )
					$measures = $measures.", ".$data["drinkMeasure3"][$i];
					
				if(isset($data["drinkMeasure4"][$i]) 
							&& $data["drinkMeasure4"][$i] != "null" )
					$measures = $measures.", ".$data["drinkMeasure4"][$i];
				
				// stampo tutte le dosi
				echo "<b>Measures:</b> ".$measures."<br>";
				
				echo "<br>";
				echo "<hr><hr>";
				echo "<br>";
			}
		}// altrimenti significa che non � presente nessun cocktail con l'ingrediente inserito
		else
    		echo "Cocktail non presente<br><br>";
    }// altrimenti significa che il campo nome � stato lasciato vuoto
    else
    	echo "Richiesta non valida<br><br>";
}

// stampo il bottone per tornare alla pagina iniziale
echo "<input type=\"button\" onclick=\"location.href='actionSelect.php'\" value=\"Indietro\"/> ";
echo "<input type=\"button\" onclick=\"location.href='index.php'\" value=\"Logout\"/>";
?>

<!DOCTYPE HTML>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <html>
<body background = 'https://static.vecteezy.com/system/resources/previews/000/401/351/non_2x/vector-background-wallpaper-with-polygons-in-gradient-colors.jpg';
</html>
