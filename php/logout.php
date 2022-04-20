<?php 
    // si l'utilisateur est déconnecté, alors ne rien faire, sinon, déconnecter l'utilisateur.
    if(!isset($_SESSION)) session_start();

    if (isset($_SESSION["pseudo"])) 
    {
        session_destroy();
    }
    session_start();
    $_SESSION["info"] = "Vous êtes déconnecté(e).";
    header("Location:/index.php");
    
?>