<?php 
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    // Path: php\add_to_cart.php
    include_once('/php/gestion_db.php');
    
    if(!isset($_GET['user_id']))
    {
        $_SESSION['info'] = "Erreur lors de la récupération de l'id de l'utilisateur";
        header("Location:/index.php"); 
    }
    else
    {
        $id = $_GET['user_id'];
        $user = $_SESSION['pseudo'];

        if (user_delivery_address_exist($id))
        {
            if(validate_user_cart($id) == true)
            {
                $_SESSION['info'] = "Votre panier à bien été validé";
                header("Location:/index.php"); 
            }
            else
            {
                $_SESSION['info'] = "Erreur lors de la validation du panier";
                header("Location:/index.php"); 
            }
        }
        else
        {
            $_SESSION['info'] = "Vous devez renseigner une adresse de livraison : <a href='/php/profil.php'>Mon Profil</a>";
            header("Location:/index.php");         
        }
    }
?>