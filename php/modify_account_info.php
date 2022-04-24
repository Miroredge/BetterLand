<?php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );
    
    include_once("gestion_db.php");

    if(!isset($_SESSION)) session_start(); 
    
    if(isset($_POST)) 
    {  
        $values = get_modified_user_infos($_POST);
        if (!empty($_POST)) 
        {
            if (empty($values)) 
            {
                $_SESSION["info_updated"] = "Les champs de modification sont vides, aucune modification n'a été effectuée";
                header("Location:../php/profil.php");
            }
            if(modify_user_infos($values) and $inadmin == null) header("Location:../php/profil.php");
    
        }
    }

    $user = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);

    // If user is not connected
    if ($user == null) 
    {
        $_SESSION["info"] = "Vous devez être connecté pour accéder à cette page";
        // Redirect to index page
        header("Location:/index.php"); 
    }
    
    // Base error message
    $errmsg = (isset($_SESSION["error"]))?$_SESSION["error"]:"";
    unset($_SESSION["error"]);


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifier : <?= $user ?> - PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>
    <body>
    <h1><a href="/" id="title-page">PaperLand</a></h1>
        <section id="section-modifier" class="section-form">
            <div class="div-form">
                <h2>Modifier Vos Informations</h2>
                    <form action="../php/modify_account_info.php" method="POST" class="form">
                    <div class="item-form">  
                        <div class="flashes">
                        <a class="error"><?= $errmsg ?></a>
                        </div>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Nom<strong>*</strong></label>
                        <input type="text" name="lastname" class="input-form" autocomplete="off"/>
                    <div class="item-form">
                        <label class="label-form">Prénom<strong>*</strong></label>
                        <input type="text" name="firstname" class="input-form" autocomplete="off"/>
                    </div>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Sexe<strong>*</strong></label>
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
                        <input type="email" name="email" class="input-form" pattern=".*[@].*[.].*"  placeholder="exemple@exemple.com" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Adresse<strong>*</strong></label>
                        <input type="adresse" name="adresse" title="Exclu :&#10;'" class="input-form" placeholder="6 Parvis Notre-Dame" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Ville<strong>*</strong></label>
                        <input type="ville" name="ville" class="input-form" placeholder="Paris" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Code Postal<strong>*</strong></label>
                        <input type="cp" name="cp" class="input-form" placeholder="75004" pattern="[0-9]{5}" maxlength="5" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Telephone<strong>*</strong></label>
                        <input type="telephone" name="telephone" class="input-form" placeholder="FR : +33 X XX XX XX XX" pattern="(?:(?:(?:\+|00)33\D?(?:\D?\(0\)\D?)?)|0){1}[1-9]{1}(?:\D?\d{2}){4}" maxlength="12" autocomplete="off"/>
                    </div>
                    <div class="item-form">
                        <label class="label-form">Date de naissance<strong>*</strong></label>
                        <input type="date" name="birthday" class="input-form" autocomplete="off"  max="2015-01-01" min="1920-01-01"/>
                    </div>
                    <div class="item-form" id="annotations">
                        <label class="label-form"><strong>*</strong> : Tout les champs laissés vide ne seront pas modifiés.</label>
                    </div>
                    <div class="item-form">
                        <input class="button-form" type="submit" value="Modifier"/>    
                        <p>Fausse manip ? <a href="../php/profil.php" id="lien-profil">Retourner à la page de profil</a></p>
                    </div>
                    
                        
                </form>
            </div>
        </section>
    </body>
</html>