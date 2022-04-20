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
 <!-- cahiers -->
        <div class=miniature-produit>
            <a href="/papetrie/{{product.category}}/{{product.id}}"><img src="{{product.image}}" width=100%/></a>
            <a href="/papetrie/{{product.category}}/{{product.id}}">NOM</a> <p>PRIX € </p>
        </div>
     
    </div>
    <h3 id=cat2>Imprimantes</h3>
    <div class="orga-produits">
 <!-- imprimantes -->
        <div class=miniature-produit>
            <a href="/papetrie/{{product.category}}/{{product.id}}"><img src="{{product.image}}" width=100%/></a>
            <a href="/informatique/{{product.category}}/{{product.id}}">NOM</a> <p>PRIX € </p>
        </div>

    </div>
    <h3 id=cat3>Stylos, Crayons et Feutres</h3>
    <div class="orga-produits"> <!-- ici on affiche 3 catégories de produits dans une seule catégorie d'affichage -->

        <div class=miniature-produit>
            <a href="/papetrie/{{product.category}}/{{product.id}}"><img src="{{product.image}}" width=100%/></a>
            <a href="/fournitures/{{product.category}}/{{product.id}}">NOM</a> <p>PRIX € </p>
        </div>

        <div class=miniature-produit>
            <a href="/papetrie/{{product.category}}/{{product.id}}"><img src="{{product.image}}" width=100%/></a>
            <a href="/fournitures/{{product.category}}/{{product.id}}">NOM</a> <p>PRIX € </p>
        </div>

        <div class=miniature-produit>
            <a href="/papetrie/{{product.category}}/{{product.id}}"><img src="{{product.image}}" width=100%/></a>
            <a href="/fournitures/{{product.category}}/{{product.id}}">NOM</a> <p>PRIX € </p>
        </div>

    </div>
    <h3 id=cat2>Gommes</h3>
    <div class="orga-produits">
 <!-- gommes -->
        <div class=miniature-produit>
            <a href="/papetrie/{{product.category}}/{{product.id}}"><img src="{{product.image}}" width=100%/></a>
            <a href="/informatique/{{product.category}}/{{product.id}}">NOM</a> <p>PRIX € </p>
        </div>

    </div>
</header>
