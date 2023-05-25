<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


//require_once 'risorse/head.php';
//require_once 'risorse/header.php';
//require_once 'risorse/post.php';
function Registrazione($database) {
    // Verifica se il form è stato inviato
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Prendi i dati dal form
    $conn = $database->Connetti();
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
    $password_crittografata = password_hash($password, PASSWORD_DEFAULT);

    $trova_utente = "SELECT * FROM utenti WHERE username = '$username' OR email = '$email'";
    $utente_esiste = mysqli_query($conn, $trova_utente);
    
    if (password_verify($password, $password_crittografata)) {
        // la password è corretta
        if (mysqli_num_rows($utente_esiste) > 0) {
            // l'utente esiste già nel database
            echo "L'utente esiste già nel database.";
        } else {
            // Crea una query SQL per inserire i dati nel database
            $sql = "INSERT INTO utenti (username, email, password) VALUES ('$username', '$email', '$password_crittografata')";
    
            // Esegui la query SQL
            if (mysqli_query($conn, $sql)) {
                echo "Registrazione effettuata con successo!";
            } else {
                echo "Errore durante la registrazione: " . mysqli_error($conn);
            }
    
            // Chiudi la connessione al database
            mysqli_close($conn);
            }
        } else {
            // la password non è corretta
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<?php include 'risorse/head.php' ?>
<body>
<div class="contenitore">
        <?php include 'risorse/header.php' ?>
        <?php include 'risorse/banner/banner.html' ?>

        <div class="principale">
            <div id="registrazione" class = "registrazione">
                <?php
                    Registrazione($_database);
                ?>
            </div>
            <h2>Registrazione</h2>
	        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		        <label for="username">Username:</label><br>
		        <input type="text" id="username" name="username" required><br><br>

		        <label for="email">Email:</label><br>
		        <input type="email" id="email" name="email" required><br><br>

		        <label for="password">Password:</label><br>
		        <input type="password" id="password" name="password" required><br><br>

		        <input type="submit" value="Registrati">
	        </form>
        </div>
    </div>  

</body>
</html>

