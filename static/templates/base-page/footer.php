<body>            
    <footer>
        <h3>Plan du site</h3>
        <div class=plan>
            <?= display_footer(); ?>
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