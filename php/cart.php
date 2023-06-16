<?php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );
    
    // Path: php\cart.php
    include_once("./gestion_db.php");

    if(!isset($_SESSION['pseudo']))
    {
        $_SESSION['info'] = "Vous devez être connecté pour accéder à cette page";
        header("Location:/index.php"); 
    }
    else
    {
        $user_id = get_value_global_tables("USR", "ROW_IDT", "PSD", $_SESSION['pseudo']);

        $data = get_products_in_cart($_SESSION['pseudo']);

        if ($data == false) $_SESSION['info_cart'] = "Votre panier est vide.";
    }

    if (isset($_SESSION['info_cart'])?$_SESSION['info_cart']:"")
    {
        $info_cart = $_SESSION['info_cart'];
        unset($_SESSION['info_cart']);
    }
    else
    {
        $info_cart = "";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/static/css/cart.css">
        <link rel="stylesheet" href="/static/css/admin_display.css">
    </head>
    <body>
    <header id="classement-header">
            <h1 id=accueil-titre>Panier Utilisateur</h1>
            <div class="separator"></div>
            <?php if($info_cart != "") { ?>
                <div class="flashes">
                    <a class="error"><?= $info_cart ?></a>
                </div>
            <?php } if($data != false) { ?>
                <?= display_user_table_cart($data) ?>
                <p>Total du panier : <?= get_amount_in_user_cart($user_id) ?></p>
                <a id="validate-cart" href="/php/validate_cart.php?user_id=<?= $user_id ?>">Valider le Panier</a>
            <?php } ?>

            <div class="separator"></div>
            <a id="retour-cart" href="/index.php">Retour</a>
    </body>
</html>
