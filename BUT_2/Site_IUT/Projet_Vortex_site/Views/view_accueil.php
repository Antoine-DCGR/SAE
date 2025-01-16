<?php
require "view_begin.php";
?>
<link rel="stylesheet" href="Contenu/css/index.css">

<title>Page D'accueil</title>
</head>

<body>
    <header class="header">
        <div class="header-row" role="navigation" aria-label="Main">
            <div class="logo">
                <a href="?Controller=authentification&&action=authentification" class="custom-mobile-logo-link"
                    rel="home" itemprop="url" role="link">
                    <img src="Contenu/im/logo-univ.png" alt="Logo">
                </a>
            </div>
            <div class="header-right">
                <ul class="main-menu">
                    <!-- Rubriques communes à tous les utilisateurs -->
                    <li class="menu-item"><a href="?controller=affichage&&action=tableDeBord" class="active">Tableau
                            de bord</a></li>


                    <li class="menu-item">
                        <a href="?controller=affichage&&action=listePersonne&&start=1">Voir les personnes</a>
                    </li>
                    <li class="menu-item mega-menu">
                        <a href="?controller=affichage&&action=listeDepartement">Départements</a>
                    </li>
                    <?php if ($_SESSION["role"] == 'Chef de département' || $_SESSION["role"] == 'Enseignant' || $_SESSION["role"] == 'Secrétaire'): ?>
                        <!-- Rubriques spécifiques au Directeur -->
                        <li class="menu-item">
                            <a href="?controller=affichage&&action=monDepartement">Mon départements</a>
                        </li>
                    <?php endif; ?>

                    <nav>
                        <ul class="sidebar">
                            <button type="button" onclick="HideSidebar()" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                            <li id="black"><a href="?controller=affichage&&action=profil">
                                    <?= $_SESSION['nom'] ?>
                                </a>
                            </li>
                            <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>
                                <li id="black"> <a href="?controller=affichage&&action=afficherLogs">Logs</a>
                                </li>
                            <?php endif ?>


                            <li class="role-enseignant" id="black"><a
                                    href="?controller=authentification&action=deconnection">Déconnexion</a>
                            </li>
                        </ul>
                        <ul class="deplace">
                            <li onclick=ShowSidebar() id="menu-btn" class="menu-item"><i class="fas fa-user"></i>
                            </li>
                        </ul>
                    </nav>
            </div>
        </div>
    </header>
    <section class="home">
        <div class="home-slider swiper">
            <div class="swiper-wrapper">
                <div class="slide swiper-slide"
                    style="background: url(https://www.univ-spn.fr/wp-content/uploads/Rentree-DAPS-Article.png) no-repeat;">
                    <div class="content">
                        <h3>Reprise du sport !</h3>
                        <SPAN>VIE DE CAMPUS</SPAN>
                    </div>
                </div>
                <div class="slide swiper-slide"
                    style="background: url(https://www.univ-spn.fr/wp-content/uploads/1.photo-pour-le-site.png) no-repeat;">
                    <div class="content">
                        <h3>Vote à l’unanimité pour le congé menstruel</h3>
                        <SPAN>VIE DE CAMPUS</SPAN>

                    </div>
                </div>
                <div class="slide swiper-slide"
                    style="background: url(https://www.univ-spn.fr/wp-content/uploads/Culture-article.png) no-repeat;">
                    <div class="content">
                        <h3>Reprise des activités au service culturel !</h3>
                        <SPAN>VIE DE CAMPUS</SPAN>
                    </div>
                </div>
                <div class="slide swiper-slide"
                    style="background: url(https://www.univ-spn.fr/wp-content/uploads/1024%EF%80%A1768.png) no-repeat;">
                    <div class="content">
                        <h3>Solidarité avec les étudiants en exil</h3>
                    </div>
                </div>
                <div class="slide swiper-slide"
                    style="background: url(https://www.univ-spn.fr/wp-content/uploads/veille-sociale-crous-24.png) no-repeat;">
                    <div class="content">
                        <h3>Fermeture hivernale : veille sociale du Crous de Créteil</h3>
                    </div>
                </div>
                <div class="slide swiper-slide"
                    style="background: url(https://www.univ-spn.fr/wp-content/uploads/EURSIEPS.png) no-repeat;">
                    <div class="content">
                        <h3>Inauguration de l’EUR Sciences infirmières en Promotion de la Santé</h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Nouvelle section avec bouton et aside -->
    <section class="portfolio" id="portfolio">
        <button type="button" class="voir">Fermer</button>
        <div class="portfolio-container">
            <div class="portfolio-box">
                <img src="https://media.istockphoto.com/id/1408387701/fr/photo/m%C3%A9dias-sociaux-marketing-image-g%C3%A9n%C3%A9r%C3%A9e-num%C3%A9riquement-engagement.jpg?s=1024x1024&w=is&k=20&c=tM8I-a1gAeONQSA7u3Cu-gLC1-IzgCieYDelIhuzNzk="
                    alt="">
                <div class="portfolio-layer">
                    <p>Onglet ouvert récemment <em>l'onglet</em></p>
                    <a href="?controller=affichage&&action=tableDeBord"><i class="fas fa-external-link-alt"></i></a>
                </div>
            </div>
            <div class="portfolio-box">
                <img src="https://media.istockphoto.com/id/1364358764/fr/photo/hand-holding-r%C3%A9seau-mondial-de-t%C3%A9l%C3%A9communications-connect%C3%A9-autour-de-la-plan%C3%A8te-terre-pour-le.jpg?s=1024x1024&w=is&k=20&c=CyiavVw6C9lShX9kZCrkW7EReJKE3Tk87USsYPccL0s="
                    alt="">
                <div class="portfolio-layer">
                    <p>Onglet ouvert récemment <em>l'onglet</em></p>
                    <a href="?controller=affichage&&action=listeDepartement"><i
                            class="fas fa-external-link-alt"></i></a>
                </div>
            </div>
            <div class="portfolio-box" id="dernier">
                <img src="https://media.istockphoto.com/id/1335295270/fr/photo/connexion-globale.jpg?s=1024x1024&w=is&k=20&c=vMhreolhTZakukv-_IWgWr1rD2jIrSdXWelScHLk2YM="
                    alt="">
                <div class="portfolio-layer">
                    <p>Onglet ouvert récemment <em>l'onglet</em></p>
                    <a href="?controller=affichage&&action=listePersonne&&start=1"><i
                            class="fas fa-external-link-alt"></i></a>
                </div>
            </div>

            <!-- <aside class="sidebar-aside">
                <h1>Aside Content</h1><br>
                <p>This is the aside content.</p><br>
                <p>This is the aside content.</p><br>
                <p>This is the aside content.</p><br>
                <p>This is the aside content.</p><br>
                <p>This is the aside content.</p><br>
            </aside> -->
        </div>
    </section>


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





    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.0/swiper-bundle.min.js"></script>
    <script src="Contenu/js/index.js"></script>


    <?php require "view_end.php"; ?>