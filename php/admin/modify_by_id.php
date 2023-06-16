<?php 
    include_once("./verif_admin.php");
    include_once("./gestion_db_admin.php");
    include_once("../gestion_db.php");

    if(!isset($_SESSION)) session_start();
    
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

        verif_admin();

        if ($table == "users" | $table == "roles" | $table == "primary_cats" | $table == "categories" | $table == "products") 
        {
            if ($table == "users" | $table == "roles") 
            {
                verif_s_admin();

                if ($table == 'users') 
                {
                    $users = true;
                    // $subject = "un Utilisateur : " . get_user_pseudo($id);
                    $subject = "un Utilisateur : ";
                }
                if ($table == 'roles') 
                {
                    $roles = true;
                    // $subject = "un Rôle : " . get_roles_name($id);
                    $subject = "un Rôle : ";
                }
            }

            if ($table == 'products')
            {
                $products = true;
                // $subject = "un Produit : " . get_products_name($id);
                $subject = "un Produit : ";
            }
            if ($table == 'categories')
            {
                $categories = true;
                // $subject = "une Catégorie : " . get_cats_name($id);
                $subject = "une Catégorie : ";
            }
            if ($table == 'primary_cats')
            {
                $p_cats = true;
                // $subject = "une Cat. mère : " . get_main_cats_name($id);
                $subject = "une Cat. mère : ";
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
        verif_admin();

        $_SESSION["info"] = "Aucune table n'a été demandé";
        header("Location:/php/admin/administration_menu.php");    
    }
    
    if(isset($_POST['user_id']))
    {
        $id = $_POST['user_id'];

        if ($id != "")
        {
            header("Location:/php/admin/modify.php?table=users&id=" . $id);
        }
        else
        {
            $_SESSION["error"] = "L'id de l'utilisateur n'a pas été renseigné.";
            header("Location:/php/admin/modify_by_id.php?table=users");
        }
    }
    if(isset($_POST['role_id']))
    {
        $id = $_POST['role_id'];

        if ($id != "")
        {
            header("Location:/php/admin/modify.php?table=roles&id=" . $id);
        }
        else
        {
            $_SESSION["error"] = "L'id du rôle n'a pas été renseigné.";
            header("Location:/php/admin/modify_by_id.php?table=roles");
        }
    }
    if(isset($_POST['p_cat_id']))
    {
        $id = $_POST['p_cat_id'];

        if ($id != "")
        {
            header("Location:/php/admin/modify.php?table=primary_cats&id=" . $id);
        }
        else
        {
            $_SESSION["error"] = "L'id de la catégorie primaire n'a pas été renseigné.";
            header("Location:/php/admin/modify_by_id.php?table=primary_cats");
        }
    }
    if(isset($_POST['category_id']))
    {
        $id = $_POST['category_id'];

        if ($id != "")
        {
            header("Location:/php/admin/modify.php?table=categories&id=" . $id);
        }
        else
        {
            $_SESSION["error"] = "L'id de la catégorie n'a pas été renseigné.";
            header("Location:/php/admin/modify_by_id.php?table=categories");
        }
    }
    if(isset($_POST['product_id']))
    {
        $id = $_POST['product_id'];

        if ($id != "")
        {
            header("Location:/php/admin/modify.php?table=products&id=" . $id);
        }
        else
        {
            $_SESSION["error"] = "L'id du produit n'a pas été renseigné.";
            header("Location:/php/admin/modify_by_id.php?table=products");
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
                <?php echo '<form action="../admin/modify_by_id.php?table=' . $table . '" method="POST" class="form">' ?> 
                    <div class="item-form">
                        <div class="flashes">
                            <a class="error"><?= $errmsg ?></a>
                        </div>
                    </div>
                    <div class="item-form">
                        <label class="label-form">ID :<strong>*</strong><var>- SELECTIONNEZ -</var></label>
                        <?php if ($users) { ?>
                        <select id="cat" name="user_id">
                            <option hidden value="">Sélectionnez un utilisateur...</option>
                            <?php display_form(get_users_availaible()) ?>
                        </select>
                        <?php } ?>
                        <?php if ($roles) { ?>
                        <select id="cat" name="role_id">
                            <option hidden value="">Sélectionnez un rôle...</option>
                            <?php display_form(get_roles_availaible()) ?>
                        </select>
                        <?php } ?>
                        <?php if ($p_cats) { ?>
                        <select id="cat" name="p_cat_id">
                            <option hidden value="">Sélectionnez une catégorie mère...</option>
                            <?php display_form(get_primary_cats_availaible()) ?>
                        </select>
                        <?php } ?>
                        <?php if ($categories) { ?>
                        <select id="cat" name="category_id">
                            <option hidden value="">Sélectionnez une catégorie...</option>
                            <?php display_form(get_categories_availaible()) ?>
                        </select>
                        <?php } ?>
                        <?php if ($products) { ?>
                        <select id="cat" name="product_id">
                            <option hidden value="">Sélectionnez un produit...</option>
                            <?php display_form(get_products_availaible()) ?>
                        </select>
                        <?php } ?>
                    </div>
                    <div class="item-form" id="annotations">
                        <label class="label-form"><strong>*</strong> : Champs obligatoires.</label>
                    </div>
                    <div class="item-form">
                        <input class="button-form" type="submit" value="Modifier"/>
                        <?php echo '<p>Menu : <a href="../admin/display.php?table=' . $table . '" id="lien-profil">Afficher ' . french_translate($table, true) . '</a>.</p>' ?>
                        <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                    </div>
                </form>  
            </div>
        </section>
    </body>
</html>