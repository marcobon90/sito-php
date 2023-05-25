<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

function Login($_database) {

    // Verifica se l'utente è già loggato, in tal caso reindirizza alla home
    if (isset($_SESSION['username'])) {
        header("Location: home.php");
        //$_SESSION['username'] = $username;
        exit;
    }
    
    // Verifica se il form è stato inviato
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prendi i dati dal form
        $database = $_database;
        $conn = $database->Connetti();
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Query SQL per selezionare l'utente dal database
        $sql = "SELECT * FROM utenti WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
    
        // Verifica se l'utente esiste nel database
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hash = $row['password'];
    
            // Verifica se la password è corretta
            if (password_verify($password, $hash)) {
                // Imposta la sessione per l'utente loggato
                $_SESSION['username'] = $username;
    
                // Reindirizza alla home
                header("Location: home.php");
                //echo "Benvenuto '$username";
                exit;
            } else {
                // Password errata
                $errore = "Password errata.";
            }
        } else {
            // L'utente non esiste
            $errore = "Utente non trovato.";
        }
    
        // Chiudi la connessione al database
        mysqli_close($conn);
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
            <h1>Login</h1>
            <?php
            //Effettua il login
            Login($_database);

            if (isset($errore)) {
                ?>
                    <p style="color: red;"><?php echo $errore; ?></p>
                <?php 
            } ?>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" value="Accedi">
            </form>
        </div>
    </div>  
</body>
</html>