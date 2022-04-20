<?php 
    include_once("verif_admin.php");
    include_once("./gestion_db_admin.php");

    if(!isset($_SESSION)) session_start();

    if (isset($_GET['table']))
    { 
        $table = $_GET['table'];
        $id = $_GET['id'];

        verif_admin();

        if ($table == "users" | $table == "roles" | $table == "primary_cats" | $table == "categories" | $table == "products") 
        {
            if ($table == "users" | $table == "roles") 
            {
                verif_s_admin();

                if ($table == 'users') delete_by_admin($table, $id);
                if ($table == 'roles') delete_by_admin($table, $id);

            }
            if ($table == 'primary_cats') delete_by_admin($table, $id);
            if ($table == 'categories') delete_by_admin($table, $id);
            if ($table == 'products') delete_by_admin($table, $id);
            header("Location:/php/admin/display.php?table=$table");
        }
        else
        {
            $_SESSION["info"] = "La table demandée n'existe pas.";
            header("Location:/php/admin/administration_menu.php");    
        }
    }
    else
    {
        verif_admin();

        $_SESSION["info"] = "Aucune table n'a été demandé";
        header("Location:/php/admin/administration_menu.php");    
    }
?>