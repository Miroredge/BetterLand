<?php 
    include_once("gestion_db.php");

    if(!isset($_SESSION)) session_start();

    $info = "";

    $p_cat = false;
    $cat = false;
    $pdt = false;

    $none = false;

    if (isset($_GET['pdt']) & isset($_GET['cat']) & isset($_GET['p_cat'])) 
    {
        $pdt = true;

        $p_cat_id = $_GET['p_cat'];
        $cat_id = $_GET['cat'];
        $pdt_id = $_GET['pdt'];

        $pdt_name = get_products_name($pdt_id);
        $cat_name = get_cats_name($cat_id);
        $p_cat_name = get_main_cats_name($p_cat_id);

        $p_cat_name_formatted = mb_convert_case(str_replace('_', ' ', $p_cat_name), MB_CASE_TITLE, "UTF-8");
        $cat_name_formatted = mb_convert_case(str_replace('_', ' ', $cat_name), MB_CASE_TITLE, "UTF-8");
        $pdt_name_formatted = mb_convert_case(str_replace('_', ' ', $pdt_name), MB_CASE_TITLE, "UTF-8");

        $_TITLE = $pdt_name_formatted;

        $subjet = $_TITLE;
    }
    else
    {
        if (isset($_GET['cat']) & isset($_GET['p_cat']))
        {
            $cat = true;
    
            $p_cat_id = $_GET['p_cat'];
            $cat_id = $_GET['cat'];
            
            $cat_name = get_cats_name($cat_id);
            $p_cat_name = get_main_cats_name($p_cat_id);

            $p_cat_name_formatted = mb_convert_case(str_replace('_', ' ', $p_cat_name), MB_CASE_TITLE, "UTF-8");
            $cat_name_formatted = mb_convert_case(str_replace('_', ' ', $cat_name), MB_CASE_TITLE, "UTF-8");
    
            $_TITLE = $cat_name_formatted;

            $subjet = $p_cat_name_formatted . " - " . $cat_name_formatted;
            $content = get_products_from_cat($cat_name);
        }
        else
        {
            if(isset($_GET['p_cat']))
            {
                $p_cat = true;
        
                $p_cat_id = $_GET['p_cat'];

                $p_cat_name = get_main_cats_name($p_cat_id);

                $p_cat_name_formatted = mb_convert_case(str_replace('_', ' ', $p_cat_name), MB_CASE_TITLE, "UTF-8");
        
                $_TITLE = $p_cat_name_formatted;

                $subjet = $p_cat_name_formatted;
                $content = get_child_categories($p_cat_name);
            }
            else
            {
                $none = true;

                $_TITLE = "Cat. Meres";
                $subjet = $_TITLE;
                $content = get_parent_categories();
            }
        }
    }
    include_once("../static/templates/base-page/header.php"); 
    
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/static/css/display.css">
    </head>
    <body>
        <header id="index-header">
            <?php if ($info != "") { ?>
                <div class=infos-display>
                    <ul>
                        <h3 id="infos">Informations :</h3>
                        <li>Message Instantané : <var id="response_err"><?= $info ?></var></li>
                    </ul>
                </div>
            <?php } ?>
            <?php if ($none == true) { ?>
                <h1 id="category-name"><?= $subjet ?></h1>
                <section id="products-list">
                    <ul>
                        <?php display_parent_categories_index($content) ?>
                    </ul>
                </section>    
            <?php } ?>
            <?php if ($p_cat == true) { ?>
                <h1 id="category-name"><?= $subjet ?></h1>
                <section id="products-list">
                    <ul>
                        <?php display_child_index($content) ?>
                    </ul>
                </section>
            <?php } ?>
            <?php if ($cat == true) { ?>
                <h1 id="category-name"><?= $subjet ?></h1>
                <div class="orga-produits">
                    <?= display_products(get_products_from_cat($cat_name), $cat_name) ?>
                </div>
            <?php } ?>
            <?php if ($pdt == true) { ?>
                <div class="product-back">  
                    <h2><?= $pdt_name_formatted ?></h2> <!-- nom du produit -->
                    <img src="<?=get_value_global_tables('PDT', 'IMG', 'ROW_IDT', $pdt_id) ?>" width=50%/>
                    <p id="product-description"><strong>Description :</strong> <?=get_value_global_tables('PDT', 'DSC', 'ROW_IDT', $pdt_id) ?></p> 
                    <p id="product-price"><?=get_value_global_tables('PDT', 'PCE', 'ROW_IDT', $pdt_id) ?> €</p>
                    <h3 id=deco>
                    <form action="/php/add_to_cart.php?pdt_id=<?= $pdt_id ?>" method="post">
                        <input type="number" name="qty" min=1 placeholder="Quantité...">
                        <input class="button-form" type="submit" value="Ajouter au panier">
                    </form>
                    </h3> 
                </div>
            <?php } ?>
        </header>
    </body>
</html>
                
