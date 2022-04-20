<?php 
    if(!isset($_SESSION)) session_start();

    if (isset($_POST['password']) && isset($_SESSION['pseudo'])) 
    {
        include("gestion_db.php");
        change_password($_SESSION['pseudo'], $_POST['password']);
        header("Location:/index.php");
    }
    if (!isset($_SESSION['pseudo'])) {
        $_SESSION['info'] = "Vous devez être connecté pour pouvoir accéder à cette page";
        header("Location:/index.php");
    }

    $errmsg = (isset($_SESSION["error"])?$_SESSION["error"]:"");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Changer de MDP - PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>
    <body>
        <section id="section-login" class="section-form">

            <div class="div-form">
                <h2>Changement de mot de passe</h2>
                <div class="item-form">  
                        <div class="flashes">
                        <a class="error"><?= $errmsg ?></a>
                        </div>
                    </div>
                <form action="./temporary_change_password.php" method='POST' class="form">
                    <div class="item-form">
                        <label class="label-form">Mot de passe</label>
                        <input type="password" name="password" class="input-form" required id="password"/>
                    </div>
                    <div class="item-form">
                        <input class="button-form" type="submit" value="Changer le mot de passe"/>
                    </div>
                </form>
            </div>
        </section>