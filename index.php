<?php
    if(!isset($_SESSION)) session_start();

    $info = (isset($_SESSION["info"])?$_SESSION["info"]:"");
    unset($_SESSION["info"]);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Index - PaperLand</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/headerFooter.css">
        <link rel="stylesheet" href="/static/css/index.css">
    </head>
    <body>

    <?php include_once("./static/templates/base-page/header.php") ?>

    <?php include_once("./php/accueil.php") ?>

    <?php include_once("./static/templates/base-page/footer.php") ?>

    </body>
</html>