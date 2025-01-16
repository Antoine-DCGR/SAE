<?php require "view_begin.php"; ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Départements</title>
<!-- stylesheets -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Contenu/css/header.css">
<link rel="stylesheet" href="Contenu/css/formulaire.css">
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

    <body>
        <form action="?controller=set&&action=modifierBesoin" method="POST" class="mod">
            <h1>Modification de besoins</h1><br />
            <label for="aa">Année :</label>
            <input name="aa" type="number" value="<?= e($bes['aa']) ?>" required><br />

            <label for="s">Semestre:</label>
            <input name="s" type="text" value="<?= e($bes['s']) ?>" required><br />

            <label for="idformation">Identifiant de la formation :</label>
            <input name="idformation" type="text" value="<?= e($bes['idformation']) ?>" required><br />

            <label for="iddiscipline">Identifiant de la discipline :</label>
            <input name="iddiscipline" type="text" value="<?= e($bes['iddiscipline']) ?>" required><br />

            <label for="iddepartement">Identifiant du département :</label>
            <input name="iddepartement" type="text" value="<?= e($bes['iddepartement']) ?>" required><br />

            <label for="besoin_heure">Besoin en heure :</label>
            <input name="besoin_heure" type="text" value="<?= e($bes['besoin_heure']) ?>" required><br />

            <input type="submit" />
        </form>

        <?php require "view_end.php"; ?>
        <script src="Contenu/js/personne.js"></script>

    </body>

    </html>