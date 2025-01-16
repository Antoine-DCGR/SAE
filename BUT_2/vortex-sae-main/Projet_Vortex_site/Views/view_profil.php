<?php
require "view_begin.php";
?>
<title>Profil</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.0/swiper-bundle.css">
<script src="https://kit.fontawesome.com/4d894e31d1.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Contenu/css/profil.css">
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
    <section id="espace">
        <div class="container2">
            <div class="main-body">

                <nav1 aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="?Controller=authentification&&action=authentification">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Votre profil</li>
                    </ol>
                </nav1>

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                        class="rounded-circle" width="150" class="image">
                                    <div class="mt-3">
                                        <h4>
                                            <?= e($personne['nom']) ?>
                                            <?= e($personne['prenom']) ?>
                                        </h4>
                                        <p class="text-secondary mb-1">
                                            <?php foreach ($roles as $pn): ?>
                                                <small>
                                                    <?= e(ucfirst($pn)) ?>
                                                </small>
                                            </p>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <form action="?Controller=authentification&&action=udatEmail" method="POST">
                                            <h6 class="mb-0">Nom complet</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" id="fullName" class="form-control"
                                            value="<?= $personne['prenom'] . " " . $personne['nom'] ?>">
                                        <input type="hidden" name="id" value="<?= $personne['id_personne'] ?>">
                                    </div>

                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>


                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" id="email" class="form-control" name="email"
                                            value="<?= $personne['email'] ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">

                                        <button type="submit" class="btn btn-primary px-4"
                                            id="saveButton">Sauvegarder</button>

                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <?php if ($dep): ?>
                            <div class="row gutters-sm">
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="d-flex align-items-center mb-3"> Département affecté</h6>
                                            <?php foreach ($dep as $pn): ?>
                                                <small>
                                                    <?= e(ucfirst($pn)) ?>
                                                </small>

                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%"
                                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
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
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.0/swiper-bundle.min.js"></script>
    <script src="Contenu/js/profil.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let userRole = "<?php echo $_SESSION['role']; ?>";
            updateLinksBasedOnRole(userRole);

        });

    </script>
</body>

</html>