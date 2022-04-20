<?php
    if(!isset($_SESSION)) session_start();

    // Get user pseudo
    $user = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null); 

    if ($user == null) 
    {
        $_SESSION["info"] = "Vous devez être connecté pour accéder à cette page";
        // Redirect to index page
        header("Location:/index.php");
    }

    if (isset($_POST['delete-account']))
    {
        if ($_POST['delete-account'] == "Oui") 
        {
            include("gestion_db.php");
            
            delete_user($_SESSION['pseudo']);
        }
        else
        {
            header("Location:../php/profil.php");
        }
    }

    $errmsg = (isset($_SESSION["error"])?$_SESSION["error"]:"");

    $_TITLE = "Supprimmer : " . $user; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $_TITLE ?> - PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>
    <body>
        <section id="section-login" class="section-form">
            <div class="div-form">
                <h2>Voulez vous vraiment supprimer votre compte ?</h2> 
                <form action="../php/delete_account.php" method='POST' class="form">
                    <div class="item-from">
                        <label class="label-form">Choix</label>
                        <select id="delete-account" name="delete-account" required>
                            <option hidden >Choisissez une option...</option>
                            <option value="Oui">Oui</option>
                            <option value="Non">Non</option>
                        </select>
                    </div>
                    <div class="item-form">
                        <input class="button-form" type="submit" value="Valider le choix"/>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>