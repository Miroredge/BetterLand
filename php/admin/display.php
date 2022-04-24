<?php 
    include_once("verif_admin.php");
    include_once("./gestion_db_admin.php");

    verif_admin();

    if(!isset($_SESSION)) session_start();

    $info = (isset($_SESSION['info'])?$_SESSION['info']:"");
    unset($_SESSION['info']);

    $table = (isset($_GET['table'])?$_GET['table']:"");
    unset($_GET['table']);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Display Table : <?= $table ?> - PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/admin_display.css">
    </head>
    <body>


<?php if ($info != "") { ?>
            <div class=infos-admin>
                <ul>
                    <h3 id="infos">Informations :</h3>
                    <li>Message Instantané : <var id="response_err"><?= $info ?></var></li>
                </ul>
            </div>
<?php } ?>


<?php
    if ($table == "users" | $table == "roles" | $table == "primary_cats" | $table == "categories" | $table == "products" & $table != "") 
    {
        if ($table == "users" | $table == "roles") 
        {
            verif_s_admin();

            if ($table == 'users') display_table($table, (get_table_lists($table)));
            if ($table == 'roles') display_table($table, (get_table_lists($table)));
        }
        if ($table == 'primary_cats') display_table($table, (get_table_lists($table)));
        if ($table == 'categories') display_table($table, (get_table_lists($table)));
        if ($table == 'products') display_table($table, (get_table_lists($table)));
    }
    else
    {
        $_SESSION["info"] = "La table demandée n'existe pas.";
        header("Location:/php/admin/administration_menu.php");    
    }
?>
        <div id=div-ftr>    
            <div class="retour-index">
                <a id="retour-index-admin" href="/php/admin/administration_menu.php">Retour Au Menu d'Administration</a>
            </div>
            <div class="ajouter-obj">
                <a id="ajouter-obj" href="/php/admin/add.php?table=<?= $table ?>">Ajouter <?= french_translate($table) ?></a>
            </div>
        </div>
    </body>
</html>
