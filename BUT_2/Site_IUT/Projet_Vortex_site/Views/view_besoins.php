<?php require "view_begin.php"; ?>
<title>Liste des Départements</title>
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

    <div class="container">
    <form action="?controller=affichage&&action=listeBesoins" method="POST">
            <input type="hidden" name="formation" value="<?= e($form) ?>">
            <input type="hidden" name="departement" value="<?= e($dep) ?>">

            <label for="annee">Année :
                <select name="annee" id="annee">
                    <?php $anneesUniques = array_unique(array_column($sem, 'aa')); ?>
                    <?php foreach ($anneesUniques as $annee): ?>
                        <option value="<?= e($annee) ?>">
                            <?= e($annee) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label for="semestre">Semestre :
                <select name="semestre" id="semestre">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </label>

            <label for="niveau">Niveau :
                <select name="niveau" id="niveau">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </label>

            <button type="submit">Rechercher</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Année Académique</th>
                    <th>Semestre</th>
                    <th>Formation</th>
                    <th>Discipline</th>
                    <th>Département</th>
                    <th>Besoin en heures</th>
                    <?php if (
                        $_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction' || $_SESSION['id'] == $inf['id_personne']
                    ): ?>
                        <th>Action</th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($besoins as $pn): ?>
                    <tr>
                        <td>
                            <?= e($pn['aa']) ?>
                        </td>
                        <td>
                            <?= e($pn['s']) ?>
                        </td>
                        <td>
                            <?= e($pn['nomformation']) ?>
                            <?= e($nomDep['libelledept']) ?>
                        </td>
                        <td>
                            <?= e($pn['libelledisc']) ?>
                        </td>
                        <td>
                            <?= e($pn['libelledept']) ?>
                        </td>
                        <td>
                            <?= e($pn['besoin_heure']) ?>
                        </td>
                        <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction' || $_SESSION['id'] == $inf['id_personne']): ?>
                            <td>
                                <a
                                    href="?controller=affichage&action=formModificationBesoins&idformation=<?= e($pn['idformation']) ?>&iddiscipline=<?= e($pn['iddiscipline']) ?>&iddepartement=<?= e($pn['iddepartement']) ?>">
                                    <img class="icone" src="Contenu/im/edit-icon.png" alt="modifier" />
                                </a>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script src="Contenu/js/personne.js"></script>


    <?php require "view_end.php"; ?>