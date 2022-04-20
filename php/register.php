<?php
    if(!isset($_SESSION)) session_start(); 

    if (isset($_POST['pseudo'])) {
        include("gestion_db.php");

        add_user($_POST);
    }

    $errmsg = (isset($_SESSION["error"])?$_SESSION["error"]:"");
    unset($_SESSION["error"]);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>S'enregistrer - PaperLand</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>

    <body>
        
        <h1><a href="/" id="title-page">PaperLand</a></h1>
        <section id="section-register" class="section-form">
            <div class="div-form">
                <h2>Créer un compte</h2>
                <form action="./register.php" method="POST" class="form"> 
                    <div class="item-form">
                        <div class="flashes">
                            <a class="error"><?= $errmsg ?></a>
                        </div>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Pseudo<strong>*</strong><var>-20:Caractères maximum-</var></label>
                        <input type="text" name="pseudo" class="input-form" pattern="([A-Z]|[a-z])\S+" required minlength="3" maxlength="20" autocomplete="off" title="Compris entre 3 et 20 caractères sans espaces"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Nom</label>
                        <input type="text" name="lastname" class="input-form" autocomplete="off"/>
                    <div class="item-form">
                        <label class="label-form">Prénom</label>
                        <input type="text" name="firstname" class="input-form" required="false" autocomplete="off"/>
                    </div>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Sexe</label>
                        <select id="sexe" name="sexe" >
                            <option hidden value="">Choisissez un sexe...</option>
                            <option value="Femme">Femme</option>
                            <option value="Homme">Homme</option>
                            <option value="Non Binaire">Non-Binaire</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Email<strong>*</strong></label>
                        <input type="email" name="email" class="input-form" pattern=".*[@].*[.].*"  placeholder="exemple@exemple.com" required autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Adresse</label>
                        <input type="adresse" name="adresse" title="Exclu :&#10;'" class="input-form" placeholder="6 Parvis Notre-Dame" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Ville</label>
                        <input type="ville" name="ville" class="input-form" placeholder="Paris" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Code Postal</label>
                        <input type="cp" name="cp" class="input-form" placeholder="75004" pattern="[0-9]{5}" maxlength="5" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Telephone</label>
                        <input type="telephone" name="telephone" class="input-form" placeholder="FR : +33 X XX XX XX XX" pattern="(?:(?:(?:\+|00)33\D?(?:\D?\(0\)\D?)?)|0){1}[1-9]{1}(?:\D?\d{2}){4}" maxlength="12" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Date de naissance<strong>*</strong></label>
                        <input type="date" name="birthday" class="input-form" required autocomplete="off" max="2014-01-01" min="1920-01-01">
                    </div>
                    <div class="item-form">
                        <label class="label-form" id="password-form">Mot de passe<strong>*</strong><var>-6:Caractères minimum-</var></label>
                        <input type="password" title="Inclus :&#10;Chiffres / Majs / Mins&#10;Options :&#10; _*%!§:/;" name="password" class="input-form" required minlength="6" autocomplete="off"/>
                    </div>
                    <div class="item-form" id="annotations">
                        <label class="label-form"><strong>*</strong> : Champs obligatoires.</label>
                    </div>
                    <div class="item-form">
                        <input class="button-form" type="submit" value="S'inscrire"/>
                        <p>Vous aviez un compte ? <a href="./login.php" id="lien-login">Connectez-vous ici</a></p>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>

