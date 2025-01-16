<?php
require "view_begin.php";
?>
<link rel="stylesheet" href="Contenu/css/asupp.css">

<title>Page D'ajout</title>

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
    <form action="?controller=set&&action=ajouterPersonne" method="POST" class="ajout">
        <h1>Ajouter un / une
            <?= e($poste) . '(e)' ?>
        </h1><br>

        <!-- <div class="wrapper"> -->
        <div class="">
            <label>Identifiant de la personne :</label>
            <input name="id" type="number" value="<?= $idUnique ?>" readonly /> <br />
            <div class="underline"></div>

        </div>

        <?php if ($poste == "Secrétaire"): ?>
            <div class="with">
                <div class="wrapper">
                    <div class="input-data">
                        <input name="nom" type="text" required>
                        <div class="underline"></div>
                        <label>Nom</label>
                    </div>
                </div>
                <div class="with">
                    <div class="wrapper">
                        <div class="input-data">
                            <input name="prenom" type="text" required>
                            <div class="underline"></div>
                            <label>Prénom</label>
                        </div>
                    </div>
                    <div class="with">
                        <div class="wrapper">
                            <div class="input-data">
                                <input name="email" type="text" required>
                                <div class="underline"></div>
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="with">
                            <div class="wrapper">
                                <div class="input-data">
                                    <input name="mdp" type="text" required>
                                    <div class="underline"></div>
                                    <label>Mot de passe</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style=><strong>Département auquel elle est affecté :</strong></p>
                    <div class="checkbox-group">
                        <?php foreach ($dep as $val): ?>
                            <label>
                                <input type="radio" name="depsec" value="<?= e($val["iddepartement"]) ?>" />
                                <?= e($val["sigledept"]) ?>
                            </label>
                        <?php endforeach ?>
                    </div>
                    <p><strong>Pour quel semestre :</strong> <br>
                    <div class="semestre">
                        <label> <input name="semestre" type="radio" value="1" /> 1
                            <input name="semestre" type="radio" value="2" /> 2</label> <br>
                    </div>
                    </p>
                    <p><strong>Pour l'année :</strong> <select name="annee">

                            <?php $anneesUniques = array_unique(array_column($sem, 'aa')); ?>
                            <?php foreach ($anneesUniques as $annee): ?>
                                <option value="<?= e($annee) ?>">
                                    <?= e($annee) ?>
                                </option>
                            <?php endforeach; ?>
                        </select></p>
                <?php endif; ?>

                <?php if ($poste == "Enseignant"): ?>
                    <div class="with">
                        <div class="wrapper">
                            <div class="input-data">
                                <input name="nom" type="text" required>
                                <div class="underline"></div>
                                <label>Nom</label>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <input name="prenom" type="text" required>
                                <div class="underline"></div>
                                <label>Prénom</label>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <input name="email" type="text" required>
                                <div class="underline"></div>
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="input-data">
                                <input name="mdp" type="text" required>
                                <div class="underline"></div>
                                <label>Mot de passe</label>
                            </div>
                        </div>
                    </div>
                </div>
                <p><strong>Catégorie :</strong></p>
                <div class="radio-group">
                    <?php foreach ($cat as $val): ?>
                        <label>
                            <input name="categorie" type="radio" value="<?= e($val["id_categorie"]) ?>" />
                            <?= e($val["siglecat"]) ?>
                        </label>
                    <?php endforeach ?>
                </div>

                <p><strong>Discipline :</strong></p>
                <div class="radio-group1">
                    <?php foreach ($dis as $val): ?>
                        <label>
                            <input name="discipline" type="radio" value="<?= e($val["iddiscipline"]) ?>" />
                            <?= e($val["libelledisc"]) ?>
                        </label>
                    <?php endforeach ?>
                </div>

                <p><strong>Nombre d'heure :</strong> <input type="number" name="nbheure"><br></p>

                <p><strong>Département auquel elle est affecté :</strong></p>
                <div class="checkbox-group">
                    <?php foreach ($dep as $val): ?>
                        <label>
                            <input type="checkbox" name="departement[]" value="<?= e($val["iddepartement"]) ?>" />
                            <?= e($val["sigledept"]) ?>
                            <input type="number" step="0.1" min="0" max="1" name="pourcentage[<?= e($val["iddepartement"]) ?>]">
                        </label>
                    <?php endforeach ?>
                </div>

                <p><strong>Pour quel semestre :</strong> <br>
                <div class="semestre">
                    <label> <input name="semestre" type="radio" value="1" /> 1
                        <input name="semestre" type="radio" value="2" /> 2</label> <br>
                </div>
                </p>
                <p><strong>Pour l'année : </strong><select name="annee">
                        <?php $anneesUniques = array_unique(array_column($sem, 'aa')); ?>
                        <?php foreach ($anneesUniques as $annee): ?>
                            <option value="<?= e($annee) ?>">
                                <?= e($annee) ?>
                            </option>
                        <?php endforeach; ?>
                    </select></p>

            <?php endif; ?>

            <p><button type="submit"><i class="icon fas fa-plus"></i>Ajouter</button></p>
    </form>
    <script src="Contenu/js/personne.js"></script>
</body>

</html>