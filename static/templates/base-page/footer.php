<body>            
    <footer>
        <h3>Plan du site</h3>
        <div class=plan>
            <h4 href="/papetrie">Papeterie</h4>
            <p><a href="/papetrie/feuilles_blanches">Feuilles blanches</a> - <a href="/papetrie/fiches_cartonnees">Fiches cartonnées</a> - <a href="/papetrie/cahiers">Cahiers</a> - <a href="/papetrie/enveloppes">Enveloppes</a></p>
            <h4 href="/informatique">Informatique</h4>
            <p><a href="/informatique/imprimantes">Imprimantes</a> - <a href="/informatique/scanners">Scanners</a> - <a href="/informatique/cartouches">Cartouches d'encre</a> - <a href="/informatique/tablettes">Tablettes graphiques</a></p>
            <h4 href="/fournitures">Fournitures</h4>
            <p><a href="/fournitures/trousses">Trousses</a> - <a href="/fournitures/effaceurs">Effaceurs</a> - <a href="/fournitures/surligneurs">Surligneurs</a> - <a href="/fournitures/stylos">Stylos</a> - <a href="/fournitures/gommes">Gommes</a> - <a href="/papetrie/crayons_couleur">Crayon de couleur</a> - <a href="/fournitures/feutres">Feutres</a></p>
        </div>
        <h3>Nous contacter</h3>
        <div class=contact>
            <p>Par mail : <a href="mailto:contacter.paperland@gmail.com?subject=Objet :&body= Bonjour/Bonsoir">contacter.paperland@gmail.com</a></p>
            <p>Par téléphone : <a href="tel:08 36 65 65 65">08 36 65 65 65</a></p>
        </div>
        <h3>CGV / RGPD</h3>
        <div class=contact>
            <p><a href="/php/cgv.php">Conditions générales de vente</a></p>
            <p><a href="/php/rgpd.php">Reglementation Genarale sur la Protection des Donnees</a></p>
        </div>
    </footer>
</body>

<?php 
include_once("php/gestion_db.php");
// déconnexion de la base de données.
db_disconnect(); 
?>