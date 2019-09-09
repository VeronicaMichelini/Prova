<!DOCTYPE php>
<?php
// definizione e inizializzazione delle variabile locale
$username = "";
$password = "";
$username_err = "";
$password_err = "";
$login_err = "";

// array utente -> password
$utenti = array(
  array('username' => 'user1','password' => 'u1'),
  array('username' => 'user2','password' => 'u2'),
  array('username' => 'user3','password' => 'u3')
);

// controllo se il campo username è stato inserito
if( empty($_POST["username"]) )
	// il campo username è vuoto, assegno alla variabile username_err un messaggio di errore
	$username_err = "Inserire username.";
else
	// altrimenti assegno l'username inserito dall'utente alla variabile username
	$username = ($_POST["username"]);
    
// controllo se il campo password è stato inserito
if( empty($_POST["password"]) )
	// il campo password è vuoto, assegno alla variabile password_err un messaggio di errore
	$password_err = "Inserire password.";
else
	// altrimenti assegno la password inserita dall'utente alla variabile password
	$password = ($_POST["password"]);

// validazione delle credenziali
// se le variabili username_err e password_err sono ancora vuote significa che entrambi i campi sono stati inseriti
if(empty($username_err) && 
	empty($password_err))
{
	// per tutti gli utenti
	for($i = 0; $i < count($utenti); $i++)
	{
		if(($utenti[$i]['username'] == $username) && 
				($utenti[$i]['password'] == $password))
			// reindirizzamento alla pagina actionSelect.php
			header("location: actionSelect.php");
		else
			// assegno alla variabile login_err un messaggio di errore
			$login_err = "Utente non valido<br>";
	}// end for
}// end if

// stampo il messaggio di errore
echo $login_err;
?>
 
<!DOCTYPE html>
<html>
<body background = 'https://static.vecteezy.com/system/resources/previews/000/401/351/non_2x/vector-background-wallpaper-with-polygons-in-gradient-colors.jpg';
<head>
    <meta charset="UTF-8">
    
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
    
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  
            
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
        
    </div>    
</body>
</html>