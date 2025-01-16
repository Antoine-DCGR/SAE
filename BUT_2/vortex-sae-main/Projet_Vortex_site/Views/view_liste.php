<?php require "view_begin.php"; ?>
<style>
    .pagination-link img {
        width: 20px;
        /* Ajustez la largeur */
        height: 20px;
        /* Ajustez la hauteur */
        vertical-align: middle;
        /* Alignement vertical au centre */
    }
</style>
<div>
    <div>
    </div>

    <?php require 'view_liste_personne.php'; ?>

    <div class="listePages">
        <p> Pages: </p>
        <?php if ($active > 1): ?>
            <a class="pagination-link" href="?controller=affichage&&action=listePersonne&start=<?= e($active) - 1 ?>">
                <img class="icone" src="Contenu/im/previous-icon.png" alt="Previous" />
            </a>
        <?php endif ?>

        <?php for ($p = $debut; $p <= $fin; $p++): ?>
            <a class="pagination-link<?= ($p == $active) ? ' active' : '' ?>"
                href="?controller=affichage&&action=listePersonne&start=<?= $p ?>">
                <?= $p ?>
            </a>
        <?php endfor ?>

        <?php if ($active < $nb_total_pages): ?>
            <a class="pagination-link next" href="?controller=affichage&&action=listePersonne&start=<?= e($active) + 1 ?>">
                <img class="icone" src="Contenu/im/next-icon.png" alt="Next" />
            </a>
        <?php endif ?>
    </div>
</div>
<section class="footer">
    <div class="box-container">

        <div class="box">
            <h3>Liens rapides</h3>
            <a href="?Controller=authentification&&action=authentification"><i
                    class="fas fa-angle-right    "></i>Accueil </a>
            <a href="?controller=affichage&&action=profil"><i class="fas fa-angle-right    "></i>A
                propos </a>
            <a href="#"><i class="fas fa-angle-right    "></i>Paquets </a>
        </div>
        <div class="box">
            <h3>Liens extra</h3>
            <a href="#"><i class="fas fa-angle-right    "></i>Posez questions </a>
            <a href="#"><i class="fas fa-angle-right    "></i>A propos de nous </a>
            <a href="#"><i class="fas fa-angle-right    "></i>Politique de confidentialité </a>
            <a href="#"><i class="fas fa-angle-right    "></i>Nos termes </a>
        </div>

        <div class="box">
            <h3>info contact</h3>
            <a href="#"><i class="fas fa-phone    "></i>+33 06324564</a>
            <a href="#"><i class="fas fa-phone    "></i>+33 07121315</a>
            <a href="#"><i class="fas fa-envelope    "></i>vortext.topaze@gmail.com</a>
            <a href="#"><i class="fas fa-envelope    "></i>Responsablevortex@yahoo.fr</a>
            <a
                href="https://www.bing.com/search?q=51+Rue+de+Bercy%2C+75012+Paris&form=ANNTH1&refig=e566bfebc6634877b03b0bf7667338fb"><i
                    class="fas fa-map    "></i>VORTEX - TEAM </a>
        </div>
        <div class="box">
            <h3>suivez nous</h3>
            <a href="#"><i class="fab fa-facebook    "></i>facebook </a>
            <a href="#"><i class="fab fa-twitter    "></i>twitter </a>
            <a href="#"><i class="fab fa-instagram    "></i>instagram </a>
            <a href="#"><i class="fab fa-linkedin    "></i>linkedIn </a>
        </div>
    </div>
    <div class="home-right">
        Créé par <span>Vortex</span> | Tous les droits sont réservés.
    </div>
</section>

<?php require "view_end.php"; ?>