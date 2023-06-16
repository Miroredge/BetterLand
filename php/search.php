<?php

use LDAP\Result;

    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    // Path: php\search.php
    
    include_once('./gestion_db.php');
    
    if(!isset($_GET['search_bar']) or (isset($_GET['search_bar']) and trim($_GET['search_bar']) == ''))
    {
        $_SESSION['info'] = "Vous devez entrer un terme de recherche";
        header('Location: /index.php');
    }
    else
    {
        $query_search = $_GET['search_bar'];

        $_TITLE = mb_convert_case($query_search, MB_CASE_TITLE);

        include_once('../static/templates/base-page/header.php');

        $result = get_search_result($query_search);

        if($result == null)
        {
            $_SESSION['info'] = "Aucun résultat trouvé";
        }
        else
        {
            $_SESSION['info'] = "";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/static/css/index.css">
    </head>
    <body>
        <header id="index-header">
            <h1 id="category-name">Recherche : <?= mb_convert_case($query_search, MB_CASE_TITLE)?></h1>
            <?php if ($_SESSION['info'] != "") { ?>
                <div id="info">
                    <?= $_SESSION['info'] ?>
                </div>
            <?php } ?>
            <div class="orga-produits">
                <?php if($result != null)display_products($result); ?>
            </div>
        </header>
    </body>
</html>