<header id="index-header">
    <div class=infos-accueil>
        <?php if ($info != "") { ?>
                <ul>
                    <h3 id="infos">Informations :</h3>
                    <li>Message Instantané : <var id="response_err"><?= $info ?></var></li>
                </ul>
        <?php } ?>
    </div>
    <h1 id=accueil-titre>Accueil</h1>
    <h3 id=cat1>Cahiers</h3>
    <div class="orga-produits"> <!-- Affichage des produits en fonction de leur catégorie -->
        <?= display_products(get_products_from_cat('cahiers'), 'Cahiers') ?>    
    </div>
    <h3 id=cat2>Imprimantes</h3>
    <div class="orga-produits">
        <?= display_products(get_products_from_cat('imprimantes'), 'Imprimantes') ?>  
    </div>
    <h3 id=cat3>Stylos, Crayons et Feutres</h3>
    <div class="orga-produits">
        <?= display_products(get_products_from_cat('stylos'), 'Stylos') ?>  
        <?= display_products(get_products_from_cat('crayons_couleur'), 'Crayons') ?>
        <?= display_products(get_products_from_cat('feutres'), 'Feutres') ?>  
    </div>
    <h3 id=cat2>Gommes</h3>
    <div class="orga-produits">
        <?= display_products(get_products_from_cat('gommes'), 'Gommes') ?>
    </div>
</header>