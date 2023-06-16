<?php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    include_once("./verif_admin.php");

    if(!isset($_SESSION)) session_start();
    
    $info = (isset($_SESSION["info"])?$_SESSION["info"]:"");
    unset($_SESSION["info"]);

    verif_admin();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administration - PaperLand</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/admin.css">
        
    </head>
    <body>
        <section>        
            <div class="menu">
                <h1><a href="/" id="title-page">PaperLand</a></h1>
                <h3>Menu d'Administration :</h3>
                <div class=infos-admin>
                <?php if ($info != "") { ?>
                    <ul>
                        <h3 id="infos">Informations :</h3>
                        <li>Message Instantané : <var id="response_err"><?= $info ?></var></li>
                    </ul>
                <?php } ?>
                </div>
                <article>
                    <h2 id="title-cat">Produits</h2> <!-- menu d'administration pour les produits et les fonction d'administateur -->
                    
                        <ul class="menu-products">
                            <div>
                                <li><a id="view-products" href="/php/admin/display.php?table=products">Voir table des produits</a></li>
                                <li><a id="add-product" href="/php/admin/add.php?table=products">Ajouter un produit</a></li>
                                <li><a id="modify-product" href="/php/admin/modify_by_id.php?table=products">Modifier un produit (ID)</a></li>
                                <li><a id="delete-product" href="/php/admin/delete_by_id.php?table=products">Supprimer un produit (ID)</a></li>
                            </div>
                        </ul>
                </article>
                <article>
                    <h2 id="title-cat">Catégories</h2>

                    <ul class="menu-categories">
                        <div>
                            <li><a id="view-categories" href="/php/admin/display.php?table=categories">Voir la liste des catégories</a></li>
                            <li><a id="add-category" href="/php/admin/add.php?table=categories">Ajouter une catégorie</a></li>
                            <li><a id="modify-category" href="/php/admin/modify_by_id.php?table=categories">Modifier une catégorie (ID)</a></li>
                            <li><a id="delete-category" href="/php/admin/delete_by_id.php?table=categories">Supprimer une catégorie (ID)</a></li>
                        </div>
                    </ul>
                </article>
                <article>
                    <h2 id="title-cat">Catégories Mères</h2>

                    <ul class="menu-parent-categories">
                        <div>
                            <li><a id="view-parent-categories" href="/php/admin/display.php?table=primary_cats">Voir la liste des catégories mères</a></li>
                            <li><a id="add-parent-category" href="/php/admin/add.php?table=primary_cats">Ajouter une catégorie mère</a></li>
                            <li><a id="modify-parent-category" href="/php/admin/modify_by_id.php?table=primary_cats">Modifier une catégorie mère (ID)</a></li>
                            <li><a id="delete-parent-category" href="/php/admin/delete_by_id.php?table=primary_cats">Supprimer une catégorie mère (ID)</a></li>
                        </div>
                    </ul>
                </article>
                <?php if (verif_role('SuperAdmin')) { ?>
                <article>
                    <h2 id="title-cat">Gestion des Rôles</h2>

                    <ul class="menu-roles">
                        <div>
                            <li><a id="view-roles" href="/php/admin/display.php?table=roles">Voir la liste des rôles</a></li>
                            <li><a id="add-role" href="/php/admin/add.php?table=roles">Ajouter un rôle</a></li>
                            <li><a id="modify-role" href="/php/admin/modify_by_id.php?table=roles">Modifier un rôle (ID)</a></li>
                            <li><a id="delete-role" href="/php/admin/delete_by_id.php?table=roles">Supprimer un rôle (ID)</a></li>
                        </div>
                    </ul>
                </article>
                <article>
                    <h2 id="title-cat">Gestion des Utilisateurs</h2>

                    <ul class="menu-users">
                        <div>
                            <li><a id="view-users" href="/php/admin/display.php?table=users">Voir la liste des utilisateurs</a></li>
                            <li><a id="add-user" href="/php/admin/add.php?table=users">Ajouter un utilisateur</a></li>
                            <li><a id="modify-user" href="/php/admin/modify_by_id.php?table=users">Modifier un utilisateur (ID)</a></li>
                            <li><a id="delete-user" href="/php/admin/delete_by_id.php?table=users">Supprimer un utilisateur (ID)</a></li>
                        </div>
                    </ul>
                </article>
                <?php } ?>
                <div class=bouton-leave-404-classement>
                    <h3 id=leave><a href='/'>Quitter le menu d'Administration</a></h3>
                    <h3 id=button_404><a href='/404.html'>404 Index</a></h3>
                    <h3 id=button_404_admin><a href='/404-admin.html'>404 Admin</a></h3>
                    <?php if (verif_role('SuperAdmin')) { ?>
                        <h3 id=classement><a href='/php/admin/classement.php'>Classement Utilisateur</a></h3>
                        <?php } ?>
                </div>
            </div>
        </section>
    </body>
</html>