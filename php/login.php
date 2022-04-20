<?php
    if(!isset($_SESSION)) session_start();

    if (isset($_POST['email']) && isset($_POST['password'])) {
        include("gestion_db.php");

        login_user($_POST);
    }

    $errmsg = (isset($_SESSION["error"])?$_SESSION["error"]:"");
    
    if (isset($_SESSION["error"])) unset($_SESSION["error"]);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Se Connecter - PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>
    <body>
        <h1><a href="/" id="title-page">PaperLand</a></h1>
        <section id="section-login" class="section-form">
            <div class="div-form">
                <h2>S'identifier</h2>
                <form action="login.php" method='POST' class="form">   
                    <div class="item-form">  
                        <div class="flashes">
                        <a class="error"><?= $errmsg ?></a>
                        </div>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Email</label>
                        <input type="email" name="email" class="input-form" required pattern=".*[@].*[.].*" placeholder="exemple@exemple.fr" id="email"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Mot de passe</label>
                        <input type="password" name="password" class="input-form" required id="password"/> 
                    </div>
                    <div class="item-form">
                        <input class="button-form" type="submit" value="Connexion"/> 
                    </div>
                </form>
                <p>Pas encore inscrit ? <a href="./register.php" id="lien-register">Inscrivez-vous ici</a><br>Mot de passe oublié ? <a href="./recovery_password.php" id="lien-lostpassword">Récupérez le ici</a></p>
            </div>
        </section>
    </body>