<?php
require_once 'database.php';
$database = new Database('infodit_db');

if($database) {
  Crea_tabella_post($database);
  Crea_tabella_commenti($database);
  Crea_tabella_utenti($database);
  Crea_tabella_categorie($database);
} else {
  echo 'Il database non è corretto';
}

function Crea_tabella_post($database)
{

  $conn = $database->Connetti(); 
  // Creare la tabella per i post
  $sql = "CREATE TABLE IF NOT EXISTS infodit_posts (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(255) NOT NULL,
    introduzione TEXT NOT NULL,
    contenuto TEXT NOT NULL,
    autore VARCHAR(255) NOT NULL,
    data_pubblicazione DATETIME NOT NULL,
    categoria VARCHAR(255) NOT NULL,
    titolo_seo VARCHAR(255) NOT NULL,
    descrizione_seo VARCHAR(255) NOT NULL,
    parole_chiave_seo VARCHAR(255) NOT NULL
    )";

  // Eseguire la query e controllare il risultato
  if ($conn->query($sql) === true) {
    echo "Tabella infodit_posts creata con successo<br>";
  } else {
    echo "Errore nella creazione della tabella: " . $conn->error;
  }

  // Chiudere la connessione
  $conn->close();
}

function Crea_tabella_utenti($database)
{
  $conn = $database->Connetti();
  // Creare la tabella per gli utenti registrati
  $sql = "CREATE TABLE IF NOT EXISTS infodit_utenti (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  abbonamento VARCHAR(255) NOT NULL
    )";

  // Eseguire la query e controllare il risultato
  if ($conn->query($sql) === true) {
    echo "Tabella infodit_utenti creata con successo<br>";
  } else {
    echo "Errore nella creazione della tabella: " . $conn->error;
  }

  // Chiudere la connessione
  $conn->close();
}

function Crea_tabella_categorie($database)
{
  $conn = $database->Connetti();
  // Creare la tabella per le categorie
  $sql = "CREATE TABLE IF NOT EXISTS infodit_categorie (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL UNIQUE,
  descrizione VARCHAR(255) NOT NULL
    )";

  // Eseguire la query e controllare il risultato
  if ($conn->query($sql) === true) {
    echo "Tabella infodit_categorie creata con successo<br>";
  } else {
    echo "Errore nella creazione della tabella: " . $conn->error;
  }

  // Chiudere la connessione
  $conn->close();
}

function Crea_tabella_commenti($database)
{
  $conn = $database->Connetti();
  // Creare la tabella per i commenti
  $sql = "CREATE TABLE IF NOT EXISTS infodit_commenti (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  post_id INT(11) UNSIGNED NOT NULL,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  contenuto TEXT NOT NULL,
  data_pubblicazione DATETIME NOT NULL,
  FOREIGN KEY (post_id) REFERENCES infodit_posts(id) ON DELETE CASCADE
  )";

  // Eseguire la query e controllare il risultato
  if ($conn->query($sql) === true) {
    echo "Tabella infodit_commenti creata con successo<br>";
  } else {
    echo "Errore nella creazione della tabella: " . $conn->error;
  }

  // Chiudere la connessione
  $conn->close();
}


function Inserisci_post($database)
{
  $conn = $database->Connetti();

  // Preparare i valori da inserire nel post
  $titolo = "Il mio primo post";
  $introduzione = "Introduzione";
  $contenuto = "Questo è il contenuto del mio primo post.";
  $autore = "Mario Rossi";
  $data_pubblicazione = date("Y-m-d H:i:s"); // Usare la data e l'ora correnti
  $categoria = "Generale";
  $titolo_seo = "Il mio primo post - Il mio cms";
  $descrizione_seo = "Questo è il riassunto del mio primo post.";
  $parole_chiavi_seo = "post,cms,blog";

  // Creare la query SQL per inserire il post
  $sql = "INSERT INTO infodit_posts (
    titolo,
    introduzione,
    contenuto,
    autore,
    data_pubblicazione,
    categoria,
    titolo_seo,
    descrizione_seo,
    parole_chiavi_seo
    ) VALUES (
        '$titolo',
        '$introduzione',
        '$contenuto',
        '$autore',
        '$data_pubblicazione',
        '$categoria',
        '$titolo_seo',
        '$descrizione_seo',
        '$parole_chiavi_seo')";

  // Eseguire la query e controllare il risultato
  if ($conn->query($sql) === true) {
    echo "Post inserito correttamente";
  } else {
    echo "Errore, riprova: " . $conn->error;
  }

  // Chiudere la connessione
  $conn->close();
}

function Cancella_post($database)
{

  $conn = $database->Connetti();
  // Creare la query SQL per cancellare il post
  $sql = "DELETE FROM infodit_posts WHERE id = 1"; // Cancellare il post con id = 1

  // Eseguire la query e controllare il risultato
  if ($conn->query($sql) === true) {
    echo "Post deleted successfully";
  } else {
    echo "Error deleting post: " . $conn->error;
  }

  // Chiudere la connessione
  $conn->close();
}

// Creare la classe Database che si occupa di connettersi al database e di eseguire le query
class Database
{
  // Definire le proprietà per i dati di connessione
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "infodit_db";

  // Definire una proprietà protetta per la connessione
  protected $conn;

  // Definire il costruttore che crea la connessione
  public function __construct()
  {
    // Creare la connessione
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

    // Controllare la connessione
    if ($this->conn->connect_error) {
      die("Problemi di connessione: " . $this->conn->connect_error);
    }
  }

  // Definire un metodo protetto per eseguire le query e restituire il risultato
  protected function query($sql)
  {
    // Eseguire la query e controllare il risultato
    $result = $this->conn->query($sql);

    // Verificare se la query ha avuto successo
    if ($result === true) {
      // Restituire true se la query è stata una INSERT, UPDATE o DELETE
      return true;
    } elseif ($result === false) {
      // Restituire false se la query ha fallito
      return false;
    } else {
      // Restituire il risultato se la query è stata una SELECT
      return $result;
    }
  }

  // Definire il distruttore che chiude la connessione
  public function __destruct()
  {
    // Chiudere la connessione
    $this->conn->close();
  }
}

// Creare la classe Post che eredita dalla classe Database e si occupa della tabella cms_posts
class Post extends Database
{
  // Definire le proprietà per i dati dei post
  public $id;
  public $titolo;
  public $introduzione;
  public $contenuto;
  public $autore;
  public $data_pubblicazione;
  public $categoria;
  public $titolo_seo;
  public $descrizione_seo;
  public $parole_chiave_seo;

  // Definire il costruttore che assegna i valori alle proprietà
  public function __construct($id, $titolo, $introduzione, $contenuto, $autore, $data_pubblicazione, $categoria, $titolo_seo, $descrizione_seo, $parole_chiave_seo)
  {
    // Chiamare il costruttore della classe genitore per creare la connessione
    parent::__construct();

    // Assegnare i valori alle proprietà
    $this->id = $id;
    $this->titolo = $titolo;
    $this->introduzione = $introduzione;
    $this->contenuto = $contenuto;
    $this->autore = $autore;
    $this->data_pubblicazione = $data_pubblicazione;
    $this->categoria = $categoria;
    $this->titolo_seo = $titolo_seo;
    $this->descrizione_seo = $descrizione_seo;
    $this->parole_chiave_seo = $parole_chiave_seo;
  }

  // Definire un metodo pubblico per creare un nuovo post nella tabella infodit_posts
  public function create()
  {
    // Creare la query SQL per inserire i dati del post nella tabella
    // Usare il metodo real_escape_string per prevenire le iniezioni SQL
    // Usare le proprietà della classe per i valori da inserire
    // Usare NOW() per inserire la data corrente come data di pubblicazione
    // Usare NULL per l'id che sarà generato automaticamente dal database
    $sql = "INSERT INTO infodit_posts (id, titolo, introduzione, contenuto, autore, data_pubblicazione, categoria, titolo_seo, descrizione_seo, parole_chiave_seo) VALUES (NULL, '" . $this->conn->real_escape_string($this->titolo) . "', '" . $this->conn->real_escape_string($this->introduzione) . "', '" . $this->conn->real_escape_string($this->contenuto) . "', '" . $this->conn->real_escape_string($this->autore) . "', NOW(), '" . $this->conn->real_escape_string($this->categoria) . "', '" . $this->conn->real_escape_string($this->titolo_seo) . "', '" . $this->conn->real_escape_string($this->descrizione_seo) . "', '" . $this->conn->real_escape_string($this->parole_chiave_seo) . "')";

    // Usare il metodo query() della classe Database per eseguire la query e restituire il risultato
    return $this->query($sql);
  }
}


// Creare un oggetto Post con i dati del post da inserire
$post = new Post(NULL, "Il mio primo post", "Questa è l'introduzione del mio primo post", "Questo è il contenuto del mio primo post", "Mario Rossi", NULL, "Informatica", "il-mio-primo-post", "Questa è la descrizione SEO del mio primo post", "post, informatica, seo");

// Chiamare il metodo create() dell'oggetto Post e controllare il risultato
if ($post->create()) {
  // Se la funzione restituisce true, stampare un messaggio di successo
  echo "Il post è stato inserito con successo";
} else {
  // Se la funzione restituisce false, stampare un messaggio di errore
  echo "Si è verificato un errore nell'inserimento del post";
}
