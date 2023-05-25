<?php
require_once 'sviluppo/database.php';
//Manda la richiesta al server indicando cosa cerca l'utente

function seleziona_post($percorso)
{
    // Sanifichiamo l'url inviato
    $percorso = filter_var($percorso, FILTER_SANITIZE_URL);

    $database = new Database('infodit_db');
    $database_wp = new Database('infoditwp');
    // Esegue la query per selezionare il post con lo slug corrispondente
    $conn = $database_wp->Connetti(); // Richiama la funzione per connettersi al database
    $slug = $percorso;
    $tabella_post = 'wp_posts'; //inserisci il nome della tabella del tuo db
    $nome_post = 'post_name'; //Inserisci il nome dato nella tua tabella per i nomi dei post

    $query = "SELECT * FROM $tabella_post WHERE $nome_post = '$slug' LIMIT 10";
    $result = $conn->query($query);

    $conn->close();
    return $result;
}

function esiste_post()
{
    // Controlla se c'è un percorso specifico richiesto dall'utente
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['percorso'])) {
            $percorso = $_GET['percorso'];
            $post = seleziona_post($percorso);
        } else {
            $post = seleziona_post('');
        }
        return $post;
    }
}

//Raccogli i dati che manda il server a seconda della richiesta
function ottieni_post($post)
{
    if ($post->num_rows > 0) {
        // output data of each row
        while ($row = $post->fetch_assoc()) {
            $titolo = $row["post_title"];
            $contenuto = $row["post_content"];
            echo "<h2>$titolo</h2>";
            echo "<p>$contenuto</p>";
        }
    } else {
        echo "Nessun risultato";
    }
}

//Il titolo va inserito nel relativo tag in head
function ottieni_titolo($post)
{
    if ($post->num_rows > 0) {
        $row = $post->fetch_assoc();
        $titolo = $row["post_title"];
        echo $titolo;
    } else {
        echo "Nessun risultato";
    }
}

//Il tipo di post serve per i template
function ottieni_tipo_post($post)
{
    if ($post->num_rows > 0) {
        $row = $post->fetch_assoc();
        $tipo_post = $row["post_type"];
        return $tipo_post;
    }
}

//Visualizza titolo in h1 o in altri campi personalizzati
function visualizza_titolo()
{
    if (esiste_post()) {
        $post = esiste_post();
        ottieni_titolo($post);
    }
}

//In caso di un editor o per verificare che tutto funzioni tramite console.log
function visualizza_tipo_post($post)
{
    $tipo_post = ottieni_tipo_post($post);
    if ($tipo_post == "post") {
        include 'risorse/post.php';
    }
}