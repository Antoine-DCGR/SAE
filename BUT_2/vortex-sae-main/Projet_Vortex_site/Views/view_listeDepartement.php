<?php require "view_begin.php"; ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Départements</title>
<!-- stylesheets -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Contenu/css/personne.css">
<link rel="stylesheet" href="Contenu/css/header.css">
<link rel="stylesheet" href="Contenu/css/footer.css">

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
    <h2>Liste des départements</h2>
    <ul class="department-list">
        <?php foreach ($listedep as $pn): ?>
            <li class="survol">
                <a href="?controller=affichage&&action=infoDepartement&id=<?= e($pn['iddepartement']) ?>">
                    <?= e($pn['libelledept']) ?>
                </a>
                <ul class="sub-menu">
                    <li><a href="?controller=affichage&&action=choixFormation&id=<?= e($pn['iddepartement']) ?>">Besoins</a>
                    </li>
                </ul>
                <ul class="sub-menu">
                    <li><a href="?controller=affichage&&action=listeEns&id=<?= e($pn['iddepartement']) ?>">Effectif</a>
                    </li>
                </ul>
            </li>
        <?php endforeach ?>
    </ul>
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
    <script src="Contenu/js/personne.js"></script>

    <?php require "view_end.php"; ?>