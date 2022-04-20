<?php 
    include_once("verif_admin.php");
    include_once("./gestion_db_admin.php");
    include_once("/php/gestion_db.php");

    if(!isset($_SESSION)) session_start();
    
    // Base error message
    $errmsg = (isset($_SESSION["error"]))?$_SESSION["error"]:"";
    unset($_SESSION["error"]);

    $users = false;
    $roles = false;
    $products = false;
    $categories = false;
    $p_cats = false;
    
    if (isset($_GET['table']))
    {
        $table = $_GET['table'];
        $id = (isset($_GET['id']))?$_GET['id']:0;
        
        if ($id == 0) 
        {
            $_SESSION["info"] = "Aucun id n'a été demandé";
            header("Location:/php/admin/administration_menu.php");    
        }

        verif_admin();

        if ($table == "users" | $table == "roles" | $table == "primary_cats" | $table == "categories" | $table == "products") 
        {
            if ($table == "users" | $table == "roles") 
            {
                verif_s_admin();

                if ($table == 'users') 
                {
                    $users = true;
                    $subject = "Utilisateur : " . get_user_pseudo($id);
                }
                if ($table == 'roles') 
                {
                    $roles = true;
                    $subject = "Rôle : " . get_roles_name($id);
                }
            }

            if ($table == 'products')
            {
                $products = true;
                $subject = "Produit : " . get_products_name($id);
            }
            if ($table == 'categories')
            {
                $categories = true;
                $subject = "Catégorie : " . get_cats_name($id);
            }
            if ($table == 'primary_cats')
            {
                $p_cats = true;
                $subject = "Cat. mère : " . get_main_cats_name($id);
            }
        }
        else
        {
            $_SESSION["info"] = "La modification de la table demandée n'existe pas.";
            header("Location:/php/admin/administration_menu.php");    
        }
    }
    else
    {
        exit(var_dump($_POST));
        verif_admin();

        $_SESSION["info"] = "Aucune table n'a été demandé";
        header("Location:/php/admin/administration_menu.php");    
    }
    if (isset($_POST['lastname']))
    {
        $table = $_GET['table'];
        $id = (isset($_GET['id']))?$_GET['id']:0;
        $pseudo = get_user_pseudo($id);

        $subject = "Utilisateur : " . get_user_pseudo($id);

        if ($users == true)
        {
            $to_update = get_modified_infos($_POST);

            if (!empty($to_update))
            {
                if (update_user($to_update, $id))
                {
                    $_SESSION["info"] = "L'utilisateur ayant le pseudo : " . $pseudo . " a bien été modifié.";
                    header("Location:/php/admin/display.php?table=users");
                }
                else
                {
                    $errmsg = "Une erreur est survenue lors de la modification de l'utilisateur.";
                }
            }
            else
            {
                $_SESSION["info"] = "Aucune modification à enregistrer sur l'utilisateur : " . $pseudo . ".";
                header("Location:/php/admin/display.php?table=users");
                exit();
            }

        }
        if ($roles == true)
        {
            get_modified_infos($_POST);

        }
        if ($products == true)
        {
            get_modified_infos($_POST);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifier : <?= $subject ?> - PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>
    <body>
    <h1><a href="/" id="title-page">PaperLand</a></h1>
        <section id="section-modifier" class="section-form">
            <div class="div-form">
                <h2>Modifier <?= $subject ?></h2>
                    <?php if($users) { ?>
                        <?php echo '<form action="../admin/modify.php?table=users&id=' . $id . '" method="POST" class="form">' ?>
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
                    <?php } ?>
                    <?php if($roles) { ?>
                        TODO
                    <?php } ?>
                    <?php if($products) { ?>
                        TODO
                    <?php } ?>
                    <div class="item-form" id="annotations">
                        <label class="label-form"><strong>*</strong> : Tout les champs laissés vide ne seront pas modifiés.</label>
                    </div>
                    <div class="item-form">
                        <input class="button-form" type="submit" value="Modifier"/>
                        <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                    </div>
                    
                        
                </form>
            </div>
        </section>
    </body>
</html>