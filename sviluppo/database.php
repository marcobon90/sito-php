<?php

class Database
{
    public string $host_database;
    public string $utente_database;
    public string $password_database;
    public string $nome_database;


    /**
     * Summary of __construct
     * @param string $host_database
     * @param string $utente_database
     * @param string $password_database
     * @param string $nome_database
     */
    function __construct(
        string $nome_database,
        string $host_database = 'localhost', 
        string $utente_database = 'root', 
        string $password_database = '', 
        )
    {
        $this->nome_database = $nome_database;
        $this->host_database = $host_database;
        $this->utente_database = $utente_database;
        $this->password_database = $password_database;
        
    }

    function Connetti()
    {
        // Crea la connessione  
        $conn = new mysqli(
            $this->host_database, 
            $this->utente_database, 
            $this->password_database, 
            $this->nome_database
        );

        // Verifica la connessione
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

}
$_database = new Database('infodit_db');
$_database_wp = new Database('infoditwp');
