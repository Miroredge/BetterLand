<?php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    // Start session if not started
    if(!isset($_SESSION)) session_start(); 
    
    // Get user pseudo
    if(!isset($_GET['user_psd'])) $user = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null); 
    else $user = $_GET['user_psd'];

    // If user is not connected
    if ($user == null) 
    {
        $_SESSION["info"] = "Vous devez être connecté pour accéder à cette page";
        // Redirect to index page
        header("Location:/index.php"); 
    }

    // Set page title
    $_TITLE = "Profil : " . $user; 
    
    // Include header / gestion_db / utils
    include_once ("../static/templates/base-page/header.php"); 
    include_once("../php/gestion_db.php");
    include_once("../php/utils.php");

    // Base error message
    $errmsg = "";
    // Base info message
    $info = "";
    // Base updated message
    $updated = (isset($_SESSION["info_updated"])?$_SESSION["info_updated"]:"");

    if(isset($_SESSION["info_updated"])) unset($_SESSION["info_updated"]);

    // If form is submitted
    if (isset($_POST['password']) & !isset($_GET['user_id'])) 
    {
        // Change password of the user.
        change_password($_SESSION['pseudo'], $_POST['password']);

        // Get info message if exists
        $info = (isset($_SESSION['info'])?$_SESSION['info']:"");
        // Get error message if exists
        $errmsg = (isset($_SESSION['error'])?$_SESSION['error']:"");    
        
        unset($_SESSION['error']);
        unset($_SESSION['info']);

    }

    // For "Not Only User"
    $no_user = false;
    if(isset($_GET['user_psd']))
    {
        $user_req_roles = get_user_roles($_GET['user_psd']);

        if(implode(',', $user_req_roles) != "User")
        {
            $no_user = true;
            $user_roles = implode(", ", $user_req_roles);
        }
    }
    else
    {
        if (implode(',', $_SESSION['roles']) != "User") 
        {
            $no_user = true;
            // Get user roles
            $user_roles = implode(", ", $_SESSION['roles']);
        }
    }
    // Get user infos
    if(!isset($_GET['user_psd'])) $user_infos = get_user_infos($_SESSION['pseudo']);
    else $user_infos = get_user_infos($_GET['user_psd']);

    // Format birthdate
    foreach ($user_infos as $key => $value)
    {
        $user_infos[$key] = replace_if_unknown($value);
    }
    
    $user_infos['birthdate'] =  IntlDateFormatter::formatObject(new DateTime($user_infos['birthdate']), "dd MMMM yyyy", 'fr_FR');
?>

<h1 id=titre-profil>Mon compte</h1>

<div class=infos>

    <?php if ($updated != "") { ?>
        <h3>Informations et Modification</h3>
        <ul id=updated>
            <li>Message Instantané : <var id="response_err"><?= $updated ?></var></li>
        </ul>
    <?php } ?>

    <h3>Informations relatives au site</h3>
    
    <ul class=info-site>
        <?= ($no_user?"<li>Statut du compte : <var id=\"response\"> " . $user_roles . "</var></li>":"");?>
        <li id="display_email">Email : <var id="response"><?= $user_infos['email'] ?></var></li>
        <li>Pseudo : <var id="response"><?= $user_infos['pseudo'] ?></var></li>
        
        <?php if ($no_user == true & (verif_role('Admin') or verif_role('SuperAdmin'))) { ?>
            <div class='admin-menu'>
                <li id="admin-row">Administration : <var id="response"><a id='menuadmin' href='../php/admin/administration_menu.php'>Menu Administrateur</a></var></li>
            </div>
        <?php } ?>

        <li id="mdp">
            <form action="profil.php" method="post" class="form" id="profil-change-password">
                <div class="item-form">
                    <label class="label-form">Mot de passe : </label>
                    <input id="change_mdp" type="password" name="password" class="input-form" title="Inclus :&#10;Chiffres / Majs / Mins&#10;Options :&#10; _*%!§:/;" required minlength="6" id="password"/>
                    <input id="mdp_submit" type="submit" value="Changer votre mot de passe"/>       
                </div> 
                <div class="item-form">  
                    <div class="flashes">
                        <a class="error"><?= $errmsg ?></a>
                        <a class="info"><?= $info ?></a>
                    </div>
                </div>
            </form>
        </li>
    </ul>

    <h3>Informations personnelles</h3>

    <ul class=info-perso> <!-- Les infos personnelles -->
        <li>Prénom : <var id="response"><?= $user_infos['firstname'] ?></var></li>
        <li>Nom : <var id="response"><?= $user_infos['lastname'] ?></var></li>
        <li>Date de naissance : <var id="response"><?= $user_infos['birthdate'] ?></var></li>
        <li>Sexe : <var id="response"><?= $user_infos['sex'] ?></var></li>
        <li>Numéro de téléphone : <var id="response"><?= $user_infos['phone_number'] ?></var></li>
    </ul>

    <h3>Informations de livraison</h3>

    <ul class=adresse> <!-- Ses informations sur son adresse pour le livrer -->
        <li>Adresse : <var id="response"><?= $user_infos['address'] ?></var></li>
        <li>Code postal : <var id="response"><?= $user_infos['postal_code'] ?></var></li>
        <li>Ville : <var id="response"><?= $user_infos['city'] ?></var></li>
    </ul>

    <div class=boutons-deco-modif-delete>
        <div>
            <h3 id=deco><a href='../php/logout.php'>Déconnexion</a></h3> <!-- se déconnecter -->
        </div>
        <div>
            <h3 id=modif><a href='../php/modify_account_info.php'>Modifier mes informations</a></h3> <!-- modifier les informations (hors mot de passe qui se fait au dessus) -->
        </div>
        <div>
            <h3 id=delete><a href='../php/delete_account.php'>Supprimer le compte</a></h3> <!-- supprimer le compte -->
        </div>
    </div>

</div>