<?php

class Utente
{
    private $database;

    /**
     * Summary of __construct
     * @param Database $_database
     */
    function __construct($_database)
    {
        $this->database = $_database;
    }

    // Funzione per registrare un nuovo utente
    function Registra()
    {
        // Verifica se il form è stato inviato
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Prendi i dati dal form
            $conn = $this->database->Connetti();
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
        // Logica per inserire l'utente nel database
        // Utilizza l'istanza del database ($this->data$database) per eseguire le query necessarie
    }

    // Funzione per autenticare un utente
    function Accedi($email, $password)
    {
        session_start();
        // Verifica se l'utente è già loggato, in tal caso reindirizza alla home
        if (isset($_SESSION['username'])) {
            header("Location: home.php");
            //$_SESSION['username'] = $username;
            exit;
        }

        // Verifica se il form è stato inviato
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Prendi i dati dal form
            $conn = $this->database->Connetti();
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
        // Logica per verificare l'autenticità dell'utente
        // Utilizza l'istanza del database ($this->$database) per eseguire le query necessarie
    }

    // Altre funzioni per gestire gli utenti come aggiornare il profilo, eliminare l'account, ecc.
}