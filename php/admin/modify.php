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
        if ($id == 'ids')
        {
            header("Location:/php/admin/modif_by_id.php?table=" . $table);
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
    }

    if (isset($_POST['rol_name'])) 
    {
        if ($roles == true)
        {
            $id = (isset($_GET['id']))?$_GET['id']:0;
            $rol_name = get_value_global_tables('rol', 'NAM', 'ROW_IDT', $id);
            $to_update = get_modified_infos($_POST);

            if (!empty($to_update))
            {
                if (update_role($to_update, $id))
                {
                    $_SESSION["info"] = "Le role : " . $rol_name . " a bien été modifié.";
                    header("Location:/php/admin/display.php?table=roles");
                }
                else
                {
                    $errmsg = "Une erreur est survenue lors de la modification du rôle.";
                }
            }
            else
            {
                $_SESSION["info"] = "Aucune modification à enregistrer sur le role : " . $rol_name . ".";
                header("Location:/php/admin/display.php?table=roles");
                exit();
            }
        }
    }
    if (isset($_POST['pry_cat_name'])) 
    {
        if ($p_cats == true)
        {
            $id = (isset($_GET['id']))?$_GET['id']:0; 
            $pry_cat_name = get_value_global_tables('pry_cat', 'NAM', 'ROW_IDT', $id);
            $to_update = get_modified_infos($_POST);

            if (!empty($to_update))
            {
                if (update_p_cat($to_update, $id))
                {
                    $_SESSION["info"] = "La catégorie mère : " . $pry_cat_name . " a bien été modifiée.";
                    header("Location:/php/admin/display.php?table=primary_cats");
                }
                else
                {
                    $errmsg = "Une erreur est survenue lors de la modification de la catégorie mère.";
                }
            }
            else
            {
                $_SESSION["info"] = "Aucune modification à enregistrer sur la catégorie mère : " . $pry_cat_name . ".";
                header("Location:/php/admin/display.php?table=primary_cats");
                exit();
            }
        }
    }
    if (isset($_POST['cat_name'])) 
    {
        if ($categories == true)
        {
            $id = (isset($_GET['id']))?$_GET['id']:0; 
            $cat_name = get_value_global_tables('cat', 'NAM', 'ROW_IDT', $id);
            $to_update = get_modified_infos($_POST);

            if (!empty($to_update))
            {
                if (update_cat($to_update, $id))
                {
                    $_SESSION["info"] = "La catégorie : " . $cat_name . " a bien été modifiée.";
                    header("Location:/php/admin/display.php?table=categories");
                }
                else
                {
                    $errmsg = "Une erreur est survenue lors de la modification de la catégorie.";
                }
            }
            else
            {
                $_SESSION["info"] = "Aucune modification à enregistrer sur la catégorie : " . $cat_name . ".";
                header("Location:/php/admin/display.php?table=categories");
                exit();
            }
        }
    }
    if (isset($_POST['product_name'])) 
    {
        if ($products == true)
        {
            $id = (isset($_GET['id']))?$_GET['id']:0; 
            $product_name = get_value_global_tables('pdt', 'NAM', 'ROW_IDT', $id);
            $to_update = get_modified_infos($_POST);

            if (!empty($to_update))
            {
                if (update_product($to_update, $id))
                {
                    $_SESSION["info"] = "Le produit : " . $product_name . " a bien été modifié.";
                    header("Location:/php/admin/display.php?table=products");
                }
                else
                {
                    $errmsg = "Une erreur est survenue lors de la modification du produit.";
                }
            }
            else
            {
                $_SESSION["info"] = "Aucune modification à enregistrer sur le produit : " . $product_name . ".";
                header("Location:/php/admin/display.php?table=products");
                exit();
            }
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
                            <input type="email" name="email" class="input-form" pattern=".*[@].*[.].*"  placeholder="" autocomplete="off"/>
                        </div>
                        <div class="item-form">
                            <label class="label-form">Adresse<strong>*</strong></label>
                            <input type="adresse" name="adresse" title="Exclu :&#10;'" class="input-form" placeholder="" autocomplete="off"/>
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
                            <input type="telephone" name="telephone" class="input-form" placeholder="" pattern="(?:(?:(?:\+|00)33\D?(?:\D?\(0\)\D?)?)|0){1}[1-9]{1}(?:\D?\d{2}){4}" maxlength="12" autocomplete="off"/>
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
                            <p>Menu : <a href="../admin/display.php?table=users" id="lien-profil">Afficher les utilisateurs</a>.</p>
                            <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                        </div>
                    <?php } ?>
                    <?php if($roles) { ?>
                        <?php echo '<form action="../admin/modify.php?table=roles&id=' . $id . '" method="POST" class="form">' ?> 
                            <div class="item-form">
                                <div class="flashes">
                                    <a class="error"><?= $errmsg ?></a>
                                </div>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Nom<strong>*</strong><var>-20:Caractères maximum-</var></label>
                                <input type="text" name="rol_name" class="input-form"  minlength="3" maxlength="20" autocomplete="off" title="Compris entre 3 et 20 caractères sans espaces"/>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Droits<strong>*</strong><var>-Nombre [0-49] : 50 = User-</var></label>
                                <input type="text" name="rol_rights" class="input-form" pattern="([0-4][0-9]|[0-9]|)" minlength="1" maxlength="2" autocomplete="off" title="Compris entre 0 et 49"/>
                            </div>
                            <div class="item-form" id="annotations">
                                <label class="label-form"><strong>*</strong> : Tout les champs laissés vide ne seront pas modifiés.</label>
                            </div>
                            <div class="item-form">
                                <input class="button-form" type="submit" value="Modifier"/>
                                <p>Menu : <a href="../admin/display.php?table=roles" id="lien-profil">Afficher les rôles</a>.</p>
                                <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                            </div>
                        </form>
                    <?php } ?>
                    <?php if($p_cats) { ?>
                        <?php echo '<form action="../admin/modify.php?table=primary_cats&id=' . $id . '" method="POST" class="form">' ?> 
                            <div class="item-form">
                                <div class="flashes">
                                    <a class="error"><?= $errmsg ?></a>
                                </div>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Nom<strong>*</strong><var>-20 : Caractères maximum-</var></label>
                                <input type="text" name="pry_cat_name" class="input-form" minlength="3" maxlength="20" autocomplete="off" title="Compris entre 3 et 20 caractères sans espaces"/>
                            </div>
                            <div class="item-form" id="annotations">
                                <label class="label-form"><strong>*</strong> : Tout les champs laissés vide ne seront pas modifiés.</label>
                            </div>
                            <div class="item-form">
                                <input class="button-form" type="submit" value="Modifier"/>
                                <p>Menu : <a href="../admin/display.php?table=primary_cats" id="lien-profil">Afficher les catégories mères</a>.</p>
                                <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                            </div>
                        </form>  
                    <?php } ?>
                    <?php if($categories) { ?>
                        <?php echo '<form action="../admin/modify.php?table=categories&id=' . $id . '" method="POST" class="form">' ?>
                            <div class="item-form">
                                <div class="flashes">
                                    <a class="error"><?= $errmsg ?></a>
                                </div>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Nom<strong>*</strong><var>-20 : Caractères maximum-</var></label>
                                <input type="text" name="cat_name" class="input-form"  minlength="3" maxlength="20" autocomplete="off" title="Compris entre 3 et 20 caractères sans espaces"/>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Catégorie Mère<strong>*</strong></label>
                                <select id="pry_cat" name="name_pry_cat">
                                    <option hidden value="">Sélectionnez une catégorie mère...</option>
                                    <?php display_form(get_primary_cats_availaible()) ?>
                                </select>
                            </div>
                            <div class="item-form" id="annotations">
                                <label class="label-form"><strong>*</strong> : Tout les champs laissés vide ne seront pas modifiés.</label>
                            </div>
                            <div class="item-form">
                                <input class="button-form" type="submit" value="Modifier"/>
                                <p>Menu : <a href="../admin/display.php?table=categories" id="lien-profil">Afficher les catégories</a>.</p>
                                <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                            </div>
                        </form>
                    <?php } ?>
                    <?php if($products) { ?>
                        <?php echo '<form action="../admin/modify.php?table=products&id=' . $id . '" method="POST" class="form">' ?>
                            <div class="item-form">
                                <div class="flashes">
                                    <a class="error"><?= $errmsg ?></a>
                                </div>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Nom<strong>*</strong><var>-100 : Caractères maximum-</var></label>
                                <input type="text" name="product_name" class="input-form" minlength="3" maxlength="100" autocomplete="off" title="Compris entre 3 et 100 caractères sans espaces, ni accents"/>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Catégorie<strong>*</strong></label>
                                <select id="cat" name="name_cat">
                                    <option hidden value="">Sélectionnez une catégorie ...</option>
                                    <?php display_form(get_categories_availaible()) ?>
                                </select>
                            </div>
                            <div class="item-form">
                                <label class="label-form">Prix<strong>*</strong></label>
                                <input class="input-form" name="price" id="price" type="text" pattern="([0-9]{1,8}[,][0-9]{1,2})|([0-9]{1,8})" placeholder="XXXXXXXX,XX" autocomplete="off" />
                            </div>
                            <div class="item-form">
                                <label class="label-form">Image (url)<strong>*</strong></label>
                                <input class="input-form" name="image" id="image" type="url" autocomplete="off" />
                            </div>
                            <div class="item-form">
                                <label class="label-form">Description<strong>*</strong></label>
                                <input class="input-form" name="description" id="description" autocomplete="off" type="text"/>
                            </div>
                            <div class="item-form" id="annotations">
                                <label class="label-form"><strong>*</strong> : Tout les champs laissés vide ne seront pas modifiés.</label>
                            </div>
                            <div class="item-form">
                                <input class="button-form" type="submit" value="Modifier"/>
                                <p>Menu : <a href="../admin/display.php?table=products" id="lien-profil">Afficher les produits</a>.</p>
                                <p>Fausse manip ? <a href="../admin/administration_menu.php" id="lien-profil">Retourner à la page d'administration</a>.</p>
                            </div>
                        </form>
                    <?php } ?>        
                </form>
            </div>
        </section>
    </body>
</html>