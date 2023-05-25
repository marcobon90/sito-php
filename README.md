# Sito PHP

Questo è un progetto di un sito web sviluppato in PHP.

## Descrizione

Il progetto "sito-php" è un sito web che utilizza PHP per la gestione di utenti, autenticazione, ruoli e altro. Il sito fornisce funzionalità come la registrazione degli utenti, il login, la gestione del profilo e la visualizzazione di contenuti basati sui ruoli degli utenti.

## Funzionalità

- Registrazione degli utenti
- Login e autenticazione
- Gestione del profilo utente
- Ruoli degli utenti (admin, user, silver, platinum, gold)
- Visualizzazione di contenuti basati sui ruoli degli utenti

## Requisiti

- PHP 7.0 o versione successiva
- Database MySQL

## Installazione

E' necessario l'uso di un ambiente di sviluppo come Xampp o l'utilizzo di un hosting web. 
Bisogna anche avere a disposizione un database creato nell'ambiente di sviluppo o fornito da un servizio di hosting.

1. Clonare il repository:
Digitare sul terminale di Visual Studio Code, o un altro editor appropriato, all'interno della cartella dove si vuole inserire il progetto:
git clone https://github.com/tuonome/sito-php.git


2. Configurare le informazioni del database:

- Aprire il file `sviluppo/database.php`
- Sono stati creati due istanze della classe del database, uno generico e un'altro relativo un database wordpress. Questo significa che è anche possibile visualizzare i post di un database Wordpress.
- Modificare i parametri in base alle proprie preferenze.

3. Avviare il server web:

- Copiare la cartella del progetto nella directory del server web (ad es. `htdocs` in XAMPP)
- Avviare il server web (ad es. Apache in XAMPP)

4. Accedere al sito:

- Aprire un browser web
- Visitare `http://localhost/sito-php` o il percorso corretto del tuo server web

## Contributi

Sono benvenuti i contributi al progetto. Se desideri contribuire, puoi aprire una pull request.

## Licenza

Questo progetto è concesso in licenza sotto i termini della [MIT License](LICENSE).
