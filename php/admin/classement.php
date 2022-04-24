<?php 
    // Path: php\classement.php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    include_once ('/php/admin/gestion_db_admin.php');

    $err = "";
    unset($_SESSION['err']);

    if(isset($_SESSION['pseudo']))
    {
        if(!verif_role('SuperAdmin'))
        {
            $_SESSION["info"] = "Vous devez être connecté en tant que SuperAdmin pour accéder à cette page";
            header("Location:php/admin/administration_menu.php");
        }
    }
    else
    {
        $_SESSION["info"] = "Vous devez être connecté pour accéder à cette page";
        header("Location:/index.php");
    }

    if(isset($_POST['price'])) 
    {
        $price = $_POST['price'];
        if($price == "")
        {
            $err = $_SESSION["err"] = "Vous devez choisir une somme";
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/static/css/classement.css">
        <link rel="stylesheet" href="/static/css/admin_display.css">
    </head>
    <body>
        <header id="classement-header">
            <h1 id=accueil-titre>Classement des Utilisateurs</h1>
            <form action="/php/admin/classement.php" method="post">
                <div class="flashes">
                    <a class="error"><?= $err ?></a>
                </div>
                <input type="number" name="price" min=0 placeholder="Dépenses supérieures à...">
                <input class="button-form" type="submit" value="Valider">
            </form>
            <div class="separator"></div>
            <?php if(isset($_POST['price']) & ($err == "")) { ?>
                <?= display_user_table_classement(get_users_total_cart($price), $_POST['price']); ?>
            <?php } ?>
            <div class="separator"></div>
            <a id="retour-menu" href="/php/admin/administration_menu.php">Retour</a>
        </header>
    </body>
</html>