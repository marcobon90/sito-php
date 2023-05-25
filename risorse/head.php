<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icona sito.png" type="image/x-icon">
    <style>@import url('https://fonts.googleapis.com/css2?family=Golos+Text:wght@400;500;600;700;800;900&display=swap');</style>
    <link rel="stylesheet" href="stili/style.css">
    <link rel="stylesheet" href="risorse/banner/banner.css">
    <link rel="stylesheet" href="stili/header.css">
    <?php include 'risorse/bootstrap/bootstrap.html' ?>

    <title>
        <?php 
        require_once 'sviluppo/post.php';
        $database = $_database;
        $database->Connetti();
        visualizza_titolo() ;
        ?>
    </title>
</head>