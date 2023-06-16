<?php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    // Path: php\add_to_cart.php
    include_once('./gestion_db.php');
    
    $err_add_to_cart = "";
    $info_add_to_cart = "";

    if(!isset($_SESSION['pseudo']))
    {
        $_SESSION['info'] = "Vous devez être connecté pour prétendre ajouter un produit à votre panier";
        header("Location:/index.php");
    }
    else
    {
        if(!isset($_GET['pdt_id']) or ($_POST['qty'] == ""))
        {
            $_SESSION['info'] = "Erreur: produit non spécifié ou quantité manquante.";
            header("Location:/index.php");
        }
        else
        {
            $user_psd = $_SESSION['pseudo'];
            $pdt_id = $_GET['pdt_id'];
            $qty = $_POST['qty'];

            if (add_product_to_cart($user_psd, $pdt_id, $qty))
            {
                $_SESSION['info_cart'] =  $qty . " produit" . (($qty==1)?"":"s") . " : '" . get_value_global_tables('PDT', 'NAM', 'ROW_IDT', $pdt_id) . "' " . (($qty==1)?"a été ajouté":"ont été ajoutés") . " au panier.";
                header("Location:/php/cart.php");
            }
            else
            {
                $_SESSION['info'] = "Erreur: produit non ajouté au panier.";
                header("Location:/index.php");
            }
            
        }
    }
?>