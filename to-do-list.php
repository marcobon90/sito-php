<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'infodit-config.php';
//require_once 'risorse/head.php';
//require_once 'risorse/header.php';
//require_once 'risorse/post.php';

?>
<!DOCTYPE html>
<html lang="it">
<?php include 'risorse/head.php'; include 'progetti/to-do-list/head.html' ?>
<body>
<div class="contenitore">
        <?php include 'risorse/header.php' ?>
        <?php include 'risorse/banner/banner.html' ?>

        <?php include 'progetti/to-do-list/body.html'?>
        <?php
         ?>
         <script src="progetti/to-do-list/main.js"></script>
          <?php
           ?>
    </div>

</body>
</html>