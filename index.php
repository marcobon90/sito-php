<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'sviluppo/post.php';

?>
<!DOCTYPE html>
<html lang="it">
<?php include 'risorse/head.php' ?>
<body>
    <div class="contenitore">
        <?php include 'risorse/header.php' ?>

        <div class="principale">
            <?php if(esiste_post()) {
                $post = esiste_post();
                visualizza_tipo_post($post);
            }
            ?>

        </div>
    </div>  
</body>
</html>