<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



//require_once 'risorse/head.php';
//require_once 'risorse/header.php';
//require_once 'risorse/post.php';

session_start();

function Saluta_utente() {

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        //$_SESSION['username'] = $username;
        exit;
    }
    // Verifica se l'utente è loggato
    if (isset($_SESSION['username'])) {
    // Prendi l'username dalla sessione
    $username = $_SESSION['username'];
    // Saluta l'utente
    echo "Benvenuto, $username!";
    } 
}
?>
<!DOCTYPE html>
<html lang="it">
<?php include 'risorse/head.php' ?>
<body>
    <div class="contenitore">
        <?php include 'risorse/header.php' ?>

        <div class="principale">
            <?php Saluta_utente();?>
        </div>
    </div>  
</body>
</html>