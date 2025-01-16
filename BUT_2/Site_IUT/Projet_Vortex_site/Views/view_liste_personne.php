<?php
require "view_begin.php";
?>
<!-- personne.css-->
<link rel="stylesheet" href="Contenu/css/personne.css">


<title>Liste des personnes</title>
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


    <table class="styled-table">
        <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>
            <tr>
                <td colspan="5" class="action-cell">
                    <a href="?controller=affichage&action=choix">
                        <button>Ajouter</button>
                    </a>
                </td>
            </tr>
        <?php endif ?>
        <tr>
            <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>

                <th>Identifiant</th>
            <?php endif ?>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Rôle</th>
            <th>Voir</th>

            <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>
                <th class="action-cell">Modifier</th>
                <th class="action-cell">Supprimer</th>
            <?php endif ?>
        </tr>

        <?php foreach ($liste as $pn): ?>
            <tr>

                <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>
                    <td>
                        <?= e($pn['id_personne']) ?>
                    </td>
                <?php endif ?>

                <td>
                    <?= e(ucfirst($pn['nom'])) ?>
                </td>
                <td>
                    <?= e(ucfirst($pn['prenom'])) ?>
                </td>
                <td>
                    <?= e($pn['email']) ?>
                </td>
                <td>
                    <?= e($pn['role']) ?>
                </td>
                <td class="action-cell">
                    <a href="?controller=affichage&&action=profil&id=<?= e($pn['id_personne']) ?>">
                        <i class="fas fa-eye icone"></i>
                    </a>
                </td>
                <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>

                    <td class="action-cell">
                        <a href="?controller=affichage&&action=formModification&id=<?= e($pn['id_personne']) ?>">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </td>

                    <td class="action-cell">
                        <a href="?controller=set&action=retirerPersonne&id=<?= e($pn['id_personne']) ?>"
                            onclick="confirmAndDelete(<?= e($pn['id_personne']); ?>">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </td>

                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </table>

    <script src="Contenu/js/personne.js"></script>