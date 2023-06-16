<?php 
    
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );


        if (!isset($_SESSION)) 
    {
        session_start();
    }
    
    function verif_admin(){
        if(isset($_SESSION['pseudo'])) 
        {   
            include_once("../gestion_db.php");

            if(verif_role('Admin') or verif_role('SuperAdmin')) 
            {}
            else
            {
                $_SESSION["info"] = "Vous devez être au moins administrateur pour accéder à cette page.";
                header("Location:/index.php");
            }
        }
        else
        {
            $_SESSION["info"] = "Vous devez être connecté(e) pour accéder à cette page.";
            header("Location:/index.php");
        }
    }

    function verif_s_admin(){
        if(isset($_SESSION['pseudo'])) 
        {   
            include_once("../gestion_db.php");

            if(verif_role('SuperAdmin')) 
            {}
            else
            {
                $_SESSION["info"] = "Vous devez être au moins SuperAdministrateur pour accéder à cette page.";
                header("Location:./administration_menu.php");
            }
        }
        else
        {
            $_SESSION["info"] = "Vous devez être connecté(e) pour accéder à cette page.";
            header("Location:/index.php");
        }
    }
?>