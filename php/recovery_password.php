<?php 
    require_once("../php/gestion_db.php");

    if (!isset($_SESSION)) session_start();

    $errmsg = (isset($_SESSION["error"])?$_SESSION["error"]:"");
    unset($_SESSION["error"]);

    if(isset($_POST['email']) && isset($_POST['birthday'])) 
    {
        recover_password($_POST['email'], $_POST['birthday']);
        $errmsg = (isset($_SESSION["error"])?$_SESSION["error"]:"");

        if ($errmsg == "") 
        {
        $_SESSION["error"] = "Un email vous a été envoyé pour réinitialiser votre mot de passe à l'adresse '" . $_POST['email'] . "'";
        header("Location:/php/login.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Récupérer son compte -  PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>
    <body>
        <h1><a href="/" id="title-page">PaperLand</a></h1>
        <section id="section-lostpassword" class="section-form">
            <div class="div-form">
                <h2>Récupération du mot de passe</h2>
                <form action="../php/recovery_password.php" method="POST" class="form">
                    <div class="item-form">  
                        <div class="flashes">
                        <a class="error"><?= $errmsg ?></a>
                        </div>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Email</label>
                        <input type="email" name="email" class="input-form" required pattern=".*[@].*[.].*" placeholder="exemple@exemple.fr"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Date de naissance</label>
                        <input type="date" name="birthday" class="input-form" required/>
                    </div>
                    <div class="item-form">
                        <input class="button-form" type='submit' value='Récupérer le mot de passe'></button>
                    </div>
                </form>
                <p>Mot de passe retrouvé ? <a href="login.php" id="lien-login">Connectez-vous ici</a></p>
            </div>
        </section>
    </body>
</html>