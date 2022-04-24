<?php 
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    // Path: php\add_to_cart.php
    include_once('/php/gestion_db.php');
    
    if(!isset($_GET['id']))
    {
        $_SESSION['info'] = "Suppression de l'article impossible";
        header("Location:/index.php"); 
    }
    else
    {
        $id = $_GET['id'];
        $user = $_SESSION['pseudo'];

        if(remove_from_cart($user, $id) == true)
        {
            $_SESSION['info_cart'] = "Suppression de l'article effectuée";
            header("Location:/php/cart.php"); 
        }
        else
        {
            $_SESSION['info_cart'] = "Suppression de l'article impossible";
            header("Location:/php/cart.php"); 
        }
    }
?>