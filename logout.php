<?php
session_start();

// distrugge la sessione
session_destroy();

// reindirizza alla home
header("Location: home.php");
exit;
?>
