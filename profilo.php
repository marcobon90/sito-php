<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Verifica se l'utente è loggato, altrimenti reindirizza alla pagina di login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Prendi l'username dalla sessione
$username = $_SESSION['username'];

// Prendi i dati dell'utente dal database
$database = $_database;
$conn = $database->Connetti();
$sql = "SELECT * FROM utenti WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Prendi i dati dal form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];

    // Aggiorna i dati dell'utente nel database
    $sql = "UPDATE utenti SET nome='$nome', cognome='$cognome', email='$email' WHERE username='$username'";
    if (mysqli_query($conn, $sql)) {
        // Aggiornamento riuscito
        $successo = "Dati aggiornati con successo!";
    } else {
        // Aggiornamento fallito
        $errore = "Errore durante l'aggiornamento dei dati: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestione profilo</title>
</head>
<body>
    <h1>Gestione profilo</h1>
    <p>Benvenuto, <?php echo $row['nome'] . " " . $row['cognome']; ?></p>

    <?php if (isset($successo)) { ?>
        <p style="color: green;"><?php echo $successo; ?></p>
    <?php } ?>

    <?php if (isset($errore)) { ?>
        <p style="color: red;"><?php echo $errore; ?></p>
    <?php } ?>

    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo $row['nome']; ?>"><br>

        <label>Cognome:</label><br>
        <input type="text" name="cognome" value="<?php echo $row['cognome']; ?>"><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>

        <input type="submit" value="Salva">
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
