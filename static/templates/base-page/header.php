<?php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );
    
    include_once("php/gestion_db.php");
    
    if(!isset($_TITLE)) 
    {
        $_TITLE = "Index";
    }

    if (!isset($_SESSION)) 
    {
        session_start();
    }
    
    $connected = false;
    $admin = false;

    if(isset($_SESSION['pseudo']))
    {   
        
        $connected = true;    
        
        if(verif_role('Admin') or verif_role('SuperAdmin')) 
        {
            $admin = true;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $_TITLE ?> - PaperLand</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="/static/img/favicon.ico">
        <link rel="stylesheet" href="/static/css/headerFooter.css">
        <link rel="stylesheet" href="/static/css/profil.css">
    </head>
    <body>
        <header id="main-header">
            <div class="title-site">
                <h1 id="title">
                    <a href="/">PaperLand</a>
                </h1>
            </div>
            <div class="recherche">
                <form action="/php/search.php" id="search-bar-client" method="GET">
                    <input type="text" id="recherche-site" placeholder="Barre de recherche.." name="search_bar" autocomplete="off">
                    <button type="submit" id="recherche-site" >Rechercher</button>
                </form>
            </div>
            <div class="icone">
                <div class="icone-profil">
                    <ul class=menu>
                        <li>
                            <div id="title-profil">
                                <a href="../php/profil.php">
                                    <img src="/static/img/user.svg" alt="user icone" width="40px" id="profil">
                                </a>
                            </div>
                            <div class="contenu-deroullant-profil">
                                <?=  ($connected?"<a id=\"userpseudo\">Bonjour $_SESSION[pseudo] </a> " . "<a href=\"../php/profil.php\">Profil</a>":"") ?>
                                <?= ($admin?"<a href=\"../php/admin/administration_menu.php\">Administration</a>" :"") ?>
                                <?= ($connected?"<a href=\"../php/logout.php\">Déconnexion</a>":"") ?>
                                <?= (!$connected?"<a id=\"register\" href=\"../php/register.php\">Enregistrement</a>" . "<a id=\"connect\" href=\"php/login.php\">Connexion</a>":"") ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="icone-cart">
                    <ul class="menu">
                        <li>
                            <div id="title-profil">
                                <a href="/panier/">
                                    <img src="/static/img/shopping-cart.png" alt="cart icone" width="40px" id="cart">
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="separator"></div>
        <nav>
            <ul class=nav>
                <li>
                    <div id="title-cat">
                        <div id="accueil">
                            <a class="fill-div" href="/">Accueil</a>
                        </div>
                    </div>
                </li>
                <?php display_header() ?>
                <li>
                    <div id="title-cat" >
                        <a class="fill-div" href="/php/classement.php">Classement</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="separator"></div>
    </body>
</html>