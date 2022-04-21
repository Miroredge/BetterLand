<?php 
    include_once("verif_admin.php");
    include_once("gestion_db_admin.php");

    $table = $_GET['table'];

    if ($table == "users" | $table == "roles" | $table == "primary_cats" | $table == "categories" | $table == "products" & $table != "") 
    {
        if ($table == "users" | $table == "roles") 
        {
            verif_s_admin();
        }
        
        verif_admin();
    }

    if(!isset($_SESSION)) session_start();

    if (isset($_POST['pseudo'])) 
    {
        add_user_by_admin($_POST);
    }
    if (isset($_POST['rol_name'])) 
    {
        add_role_by_admin($_POST);
    }
    if (isset($_POST['pry_cat_name'])) 
    {
        add_primary_by_admin($_POST);
    }
    if (isset($_POST['cat_name'])) 
    {
        add_category_by_admin($_POST);
    }
    if (isset($_POST['product_name'])) 
    {
        add_product_by_admin($_POST);
    }

    $errmsg = (isset($_SESSION["error"])?$_SESSION["error"]:"");
    unset($_SESSION["error"]);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter à la BD - PaperLand</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/form.css">
        <link rel="stylesheet" href="/static/css/formColorLinks.css">
        
    </head>

    <body>
        
        <h1><a href="/" id="title-page">PaperLand</a></h1>
        <section id="section-register" class="section-form">
            <div class="div-form">
                <?php if($table == "users") { ?>
                    <h2>Ajouter un Utilisateur</h2>
                    <form action="/php/admin/add.php?table=users" method="POST" class="form"> 
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
                            <label class="label-form">Rôle<strong>*</strong><var>-User Par Défault-</var></label>
                            <select id="rol" name="role">
                                <?php display_roles_form(get_roles_availaible()) ?>
                            </select>
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
                            <input class="button-form" type="submit" value="Inscrire l'utilisateur"/>
                            <p>Menu : <a href="../admin/display.php?table=users" id="lien-profil">Afficher les utilisateurs</a>.</p>
                            <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                        </div>
                    </form>                   
                <?php } ?>
                <?php if($table == "roles") { ?>
                    <h2>Ajouter un Rôle</h2>
                    <form action="/php/admin/add.php?table=roles" method="POST" class="form"> 
                        <div class="item-form">
                            <div class="flashes">
                                <a class="error"><?= $errmsg ?></a>
                            </div>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Nom<strong>*</strong><var>-20:Caractères maximum-</var></label>
                            <input type="text" name="rol_name" class="input-form" pattern="([A-Z]|[a-z])\S+" required minlength="3" maxlength="20" autocomplete="off" title="Compris entre 3 et 20 caractères sans espaces"/>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Droits<strong>*</strong><var>-Nombre [0-49] : 50 = User-</var></label>
                            <input type="text" name="rol_rights" class="input-form" pattern="([0-4][0-9]|[0-9]|)" required minlength="1" maxlength="2" autocomplete="off" title="Compris entre 0 et 49"/>
                        </div>
                        <div class="item-form" id="annotations">
                            <label class="label-form"><strong>*</strong> : Champs obligatoires.</label>
                        </div>
                        <div class="item-form">
                            <input class="button-form" type="submit" value="Enregistrer le rôle"/>
                            <p>Menu : <a href="../admin/display.php?table=roles" id="lien-profil">Afficher les rôles</a>.</p>
                            <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                        </div>
                    </form>  
                <?php } ?>
                <?php if($table == "primary_cats") { ?>
                    <h2>Ajouter une catégorie mère</h2>
                    <form action="/php/admin/add.php?table=primary_cats" method="POST" class="form"> 
                        <div class="item-form">
                            <div class="flashes">
                                <a class="error"><?= $errmsg ?></a>
                            </div>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Nom<strong>*</strong><var>-20 : Caractères maximum-</var></label>
                            <input type="text" name="pry_cat_name" class="input-form" pattern="([A-Z]|[a-z])\S+" required minlength="3" maxlength="20" autocomplete="off" title="Compris entre 3 et 20 caractères sans espaces"/>
                        </div>
                        <div class="item-form" id="annotations">
                            <label class="label-form"><strong>*</strong> : Champs obligatoires.</label>
                        </div>
                        <div class="item-form">
                            <input class="button-form" type="submit" value="Enregistrer la catégorie mère"/>
                            <p>Menu : <a href="../admin/display.php?table=primary_cats" id="lien-profil">Afficher les catégories mères</a>.</p>
                            <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                        </div>
                    </form>  
                <?php } ?>
                <?php if($table == "categories") { ?>
                    <h2>Ajouter une catégorie </h2>
                    <form action="/php/admin/add.php?table=categories" method="POST" class="form"> 
                        <div class="item-form">
                            <div class="flashes">
                                <a class="error"><?= $errmsg ?></a>
                            </div>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Nom<strong>*</strong><var>-20 : Caractères maximum-</var></label>
                            <input type="text" name="cat_name" class="input-form" pattern="([A-Z]|[a-z])\S+" required minlength="3" maxlength="20" autocomplete="off" title="Compris entre 3 et 20 caractères sans espaces"/>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Catégorie Mère<strong>*</strong></label>
                            <select id="pry_cat" name="name_pry_cat">
                                <option hidden value="">Sélectionnez une catégorie mère...</option>
                                <?php display_form(get_primary_cats_availaible()) ?>
                            </select>
                        </div>
                        <div class="item-form" id="annotations">
                            <label class="label-form"><strong>*</strong> : Champs obligatoires.</label>
                        </div>
                        <div class="item-form">
                            <input class="button-form" type="submit" value="Enregistrer la catégorie"/>
                            <p>Menu : <a href="../admin/display.php?table=categories" id="lien-profil">Afficher les catégories</a>.</p>
                            <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                        </div>
                    </form>
                <?php } ?>
                <?php if($table == "products") { ?>
                    <h2>Ajouter un produit </h2>
                    <form action="/php/admin/add.php?table=products" method="POST" class="form"> 
                        <div class="item-form">
                            <div class="flashes">
                                <a class="error"><?= $errmsg ?></a>
                            </div>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Nom<strong>*</strong><var>-100 : Caractères maximum-</var></label>
                            <input type="text" name="product_name" class="input-form" pattern="([a-z]|[A-Z]|\s)+\w" required minlength="3" maxlength="100" autocomplete="off" title="Compris entre 3 et 100 caractères sans espaces, ni accents"/>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Catégorie<strong>*</strong></label>
                            <select id="cat" name="name_cat">
                                <option hidden value="">Sélectionnez une catégorie ...</option>
                                <?php display_form(get_categories_availaible()) ?>
                            </select>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Prix</label>
                            <input class="input-form" name="price" id="price" type="text" pattern="([0-9]{1,8}[,][0-9]{1,2})|([0-9]{1,8})" autocomplete="off" required/>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Image (url)</label>
                            <input class="input-form" name="image" id="image" type="url" autocomplete="off" required/>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Description</label>
                            <input class="input-form" name="description" id="description" autocomplete="off" required type="text"/>
                        </div>
                        <div class="item-form" id="annotations">
                            <label class="label-form"><strong>*</strong> : Champs obligatoires.</label>
                        </div>
                        <div class="item-form">
                            <input class="button-form" type="submit" value="Ajouter le produit"/>
                            <p>Menu : <a href="../admin/display.php?table=products" id="lien-profil">Afficher les produits</a>.</p>
                            <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </section>
    </body>
</html>

