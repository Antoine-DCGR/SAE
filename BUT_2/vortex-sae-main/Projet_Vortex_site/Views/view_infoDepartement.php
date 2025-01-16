<?php require "view_begin.php"; ?>


<?php require "view_begin.php"; ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Information des Départements</title>
<!-- stylesheets -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.0/swiper-bundle.css">
<script src="https://kit.fontawesome.com/4d894e31d1.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Contenu/css/header.css">
<link rel="stylesheet" href="Contenu/css/footer.css">

</head>

<body>

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

        <div class="container">

            <h1><strong>Département
                    <?= e($departement['libelledept']) ?>
                </strong></h1>


            <div class="department-info">
                <p><strong>Identifiant du département :</strong>
                    <?= e($departement['iddepartement']) ?>
                </p>
                <p><strong>Abréviation :</strong>
                    <?= e($departement['sigledept']) ?>
                </p>
                <p><strong>Chef de ce département :</strong>
                    <?= e($personne['prenom']) ?>
                    <?= e($personne['nom']) ?>
                </p>

                <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>
                    <form action="?controller=set&&action=modifierChefDep" method="POST">
                        <input type="hidden" name="id" value="<?= e($departement['id_personne']) ?>">
                        <input type="hidden" name="departement" value="<?= e($departement['sigledept']) ?>">
                        <p>identifiant de la personne : <select name="idEns">
                                <option value="<?= e($personne["id_personne"]) ?>">
                                    <?= e($personne["id_personne"]) ?>
                                </option>
                                <?php foreach ($allEnseignant as $info): ?>
                                    <?php if ($info["id_personne"] != $personne["id_personne"]): ?>
                                        <option value="<?= e($info["id_personne"]) ?>">
                                            <?= e($info["id_personne"]) ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">changer</button>
                    </form>
                <?php endif ?>
            </div>
        </div>

        <style>
            .container {
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .department-info {
                margin-top: 80px;
            }

            select {
                padding: 5px;
            }

            button {
                padding: 5px 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            button:hover {
                background-color: #0056b3;
            }

            h1 {
                text-align: center;
            }
        </style>
        <script src="Contenu/js/personne.js"></script>

        <?php require "view_end.php"; ?>