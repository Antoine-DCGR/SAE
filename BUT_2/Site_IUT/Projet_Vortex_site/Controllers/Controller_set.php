<?php

class Controller_set extends Controller
{

    public function action_default()
    {
        $this->action_ajout();
    }


    function action_ajout()
    {
        // Vérifie si le poste a été soumis via le formulaire POST.
        if (isset($_POST['poste'])) {
            $m = Model::getModel(); // Obtient une instance du modèle pour interagir avec la base de données.
    
            // Stocke le poste sélectionné dans la session.
            $_SESSION['poste'] = $_POST['poste'];
    
            // Génère un ID unique à 4 chiffres pour le nouveau poste.
            do {
                $uniqueId = rand(1000, 9999); // Génère un ID aléatoire entre 1000 et 9999.
            } while ($m->idExiste($uniqueId)); // Vérifie si l'ID généré existe déjà dans la base de données.
    
            // Prépare les données à envoyer à la vue.
            $data = [
                "idUnique" => $uniqueId, // L'ID unique généré.
                "poste" => $_SESSION['poste'], // Le poste sélectionné.
                "cat" => $m->getCategories(), // Récupère les catégories depuis la base de données.
                "dep" => $m->getDepartement(), // Récupère les départements.
                "dis" => $m->getDiscipline(), // Récupère les disciplines.
                "form" => $m->getFormation(), // Récupère les formations.
                "dipl" => $m->getDiplome(), // Récupère les diplômes.
                "sem" => $m->getSemestre() // Récupère les semestres.
            ];
    
            // Affiche la vue 'ajout' avec les données préparées.
            $this->render("ajout", $data);
        } else {
            // Si aucun poste n'a été sélectionné, renvoie un message d'erreur.
            $mes = "Erreur ! Vous n'avez pas choisi de role !";
            $this->action_error($mes);
        }
    }
    


    function action_ajouterPersonne()
    {
        $ajout = false;

        //Test si les informations nécessaires sont fournies
        if (isset($_POST["id"]) and preg_match('/^\d+$/', $_POST["id"])) {
            $m = Model::getModel();
             // Traite différemment selon le poste stocké dans la session.
            if ($_SESSION['poste'] == 'Équipe de direction') {
                // Si le poste est 'Équipe de direction', tente d'ajouter la personne.
                $ajout = $m->addEquipeDirection($_POST['id']);
            } else {
                // Traite les cas pour 'Secrétaire' et 'Enseignant'.
                if (
                    isset($_POST["nom"]) and preg_match('/^[a-zA-Z]+$/u', $_POST["nom"]) and
                    isset($_POST["prenom"]) and preg_match('/^[a-zA-Z]+$/u', $_POST["prenom"]) and
                    isset($_POST["email"]) and preg_match('/^[\w\.-]+@[\w\.-]+\.\w{2,}$/', $_POST["email"]) and
                    isset($_POST["mdp"]) and !empty($_POST["mdp"])
                ) {
                    // Hash le mot de passe.
                    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
                    // Collecte les informations de base.
                    $infos = [];
                    $noms = ['id', 'nom', 'prenom', 'email'];
                    foreach ($noms as $v) {
                        if (isset($_POST[$v]) and !preg_match("/^ *$/", $_POST[$v])) {
                            $infos[$v] = $_POST[$v];
                        } else {
                            $infos[$v] = null;
                        }
                    }
                    $infos['mdp'] = $mdp;
                    // Traite le cas pour 'Secrétaire'.
                    if ($_SESSION['poste'] == 'Secrétaire') {
                        if (
                            isset($_POST['depsec']) and !empty($_POST["depsec"])
                            and isset($_POST["annee"]) and !empty($_POST["annee"])
                            and isset($_POST["semestre"]) and !empty($_POST["semestre"])
                        ) {
                            $inf = ['depsec', 'annee', 'semestre'];
                            foreach ($inf as $v) {
                                if (isset($_POST[$v]) and !preg_match("/^ *$/", $_POST[$v])) {
                                    $infos[$v] = $_POST[$v];
                                } else {
                                    $infos[$v] = null;
                                }
                            }
                            $ajout = $m->addSecretaire($infos);

                        }
                    }
                    // Traite le cas pour 'Enseignant'.
                    if ($_SESSION['poste'] == 'Enseignant') {

                        if (
                            isset($_POST["categorie"]) and !empty($_POST["categorie"])
                            and isset($_POST["discipline"]) and !empty($_POST["discipline"])
                            and isset($_POST["annee"]) and !empty($_POST["annee"])
                            and isset($_POST["semestre"]) and !empty($_POST["semestre"])
                            and isset($_POST["nbheure"]) and preg_match('/^\d+$/', $_POST["nbheure"])
                        ) {
                            $inf = ['categorie', 'discipline', 'annee', 'semestre', 'nbheure'];
                            foreach ($inf as $v) {
                                if (isset($_POST[$v]) and !preg_match("/^ *$/", $_POST[$v])) {
                                    $infos[$v] = $_POST[$v];
                                } else {
                                    $infos[$v] = null;
                                }
                            }
                            if (isset($_POST["pourcentage"]) and !empty($_POST["pourcentage"]) and isset($_POST["departement"]) and !empty($_POST["departement"])) {
                                $tab = $_POST['departement'];
                                foreach ($tab as $val) {
                                    $dep[$val] = $_POST['pourcentage'][$val];
                                }

                            }
                            if (array_sum($dep) == 1) {
                                $ajout = $m->addEnseignant($infos, $dep);
                            }
                        }
                    }
                }
            }

        }
        // Prépare les données pour la vue.
        $data = [
            "title" => "Ajout d'un/une " . $_SESSION['poste']
        ];
        if ($ajout) {
            $m->insertLog($_POST["id"], 'Ajout', "Ajout de la personne avec ID:" . $_POST["id"]);
            // Si l'ajout a réussi, log l'action et prépare un message de succès.
            $data["message"] = "Le ou la " . $_SESSION['poste'] . " a bien été ajouté !";
        } else {
            // Si l'ajout a échoué, prépare un message d'erreur.
            if ($_SESSION['poste'] == 'Équipe de direction') {
                $data["message"] = "Il y a un problème ! La personne que vous essayer d'ajouter n'est pas enseignant ou n'existe pas !";

            } else {
                $data["message"] = "Il y a un problème ! Nous n'avons pas pu ajouter le ou la " . $_SESSION['poste'] . " dans la base de données, la personne existe déjà ou vérifier les données saisies.";
            }
        }
        // Affiche la vue 'message' avec les données préparées.
        $this->render("message", $data);

    }

    function action_retirerPersonne()
    {
        if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant" || $_SESSION["role"] == "Chef de département") {
            $this->render("accueil");
        }
        if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
            $id = $_GET["id"];
            $m = Model::getModel();
            $role = $m->getRoleById($id);
            $mes = "Il n'existe pas de personne avec l'id : " . $id . "!";
            if ($role !== null) {
                if ($role == "Enseignant") {
                    $suppression = $m->removeAllEnseignantInfos($id);
                    if ($suppression) {
                        $m->insertLog($id, 'Suppression', "Suppression de la personne avec ID: $id");
                        $message = "L'enseignant à bien été supprimer.";
                        
                    } else {
                        $message = $mes;
                    }
                }
                if ($role == "Équipe de direction") {
                    $suppression = $m->removeEquipeDirection($id);
                    if ($suppression) {
                        $m->insertLog($id, 'Suppression', "Suppression de la personne avec ID: $id");
                        $message = "L'enseignant à bien été supprimer.";
                        
                    } else {
                        $message = $mes;
                    }
                }
                if ($role == "Chef de département") {
                    $message = "Vous ne pouvez pas supprimer un chef de département !";
                }
                if ($role == "Secrétaire") {
                    $suppression = $m->removeSecretaire($id);
                    if ($suppression) {
                        $m->insertLog($id, 'Suppression', "Suppression de la personne avec ID: $id");
                        $message = "Le ou la secrétaire à bien été supprimer.";
                    } else {
                        $message = $mes;
                    }
                }
            } else {
                $message = "La personne n'a pas de rôle !";
            }

        } else {
            $message = "Il n'y a pas d'id dans l'URL !";
        }
        $data = [
            "title" => "Suppression d'un/une" . $role,
            "message" => $message
        ];
        $this->render("message", $data);
    }

    function action_modifier()
    {
        if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant" || $_SESSION["role"] == "Chef de département") {
            $this->render("accueil");
        }
        $modif = false;
        $aucuneModification = true; // Pour suivre si une modification a été faite

        // Vérifier si les champs nécessaires sont présents et valides
        if (
            isset($_POST["id"]) and preg_match('/^\d+$/', $_POST["id"]) and
            isset($_POST["nom"]) and preg_match('/^[a-zA-Z]+$/u', $_POST["nom"]) and
            isset($_POST["prenom"]) and preg_match('/^[a-zA-Z]+$/u', $_POST["prenom"]) and
            isset($_POST["email"]) and preg_match('/^[\w\.-]+@[\w\.-]+\.\w{2,}$/', $_POST["email"]) and
            isset($_POST["mdp"]) and !empty($_POST["mdp"])
        ) {
            $m = Model::getModel();
            $id = $_POST["id"];
            $role = $m->getRoleById($id);
            $personne = $m->getPersonneParId($id);

            // Vérifier si des modifications ont été faites
            if (
                $personne["nom"] != $_POST["nom"] ||
                $personne["prenom"] != $_POST["prenom"] ||
                $personne["email"] != $_POST["email"] ||
                $personne["motdepasse"] != $_POST["mdp"]
            ) {
                $aucuneModification = false;
            }

            // Traitement spécifique pour les rôles particuliers
            if ($role == "Enseignant" || $role == "Chef de département" || $role == "Équipe de direction") {
                $ens = $m->getEnseignantById($id);
                if (isset($_POST["categorie"]) && !empty($_POST["categorie"]) && $ens["id_categorie"] != $_POST["categorie"]) {
                    $aucuneModification = false;
                }
            }

            if ($role == "Enseignant" || $role == "Équipe de direction") {
                if (isset($_POST["choixEquipe"]) and $_POST["choixEquipe"] == "oui") {
                    $modif = $m->addEquipeDirection($id);
                    if ($modif) {
                        $aucuneModification = false;
                    }
                } else {
                    $modif = $m->removeEquipeDeDirection($id);
                    if ($modif) {
                        $aucuneModification = false;
                    }
                }

            }

            // Si des modifications ont été détectées
            if (!$aucuneModification) {
                // Mise à jour des informations de la personne
                $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
                $infos = [
                    'id' => $id,
                    'nom' => $_POST["nom"],
                    'prenom' => $_POST["prenom"],
                    'email' => $_POST["email"],
                    'mdp' => $mdp
                ];
                $modif = $m->updatePersonne($infos);

                // Mise à jour spécifique pour les enseignants et rôles similaires
                if ($role == "Enseignant" || $role == "Chef de département" || $role == "Équipe de direction") {
                    $modif = $m->updateCatEnseignant($id, $_POST["categorie"]);
                }
            } else {
                // Aucune modification n'a été détectée
                $this->action_error("Il n'y a rien qui a été modifié !");
            }
        } else {
            // Les données du formulaire sont invalides ou incomplètes
            $this->action_error("Les données fournies sont invalides ou incomplètes.");
        }

        // Préparation des données pour la vue
        $data = ["title" => "Modification"];
        if ($modif) {
            $m->insertLog($id, 'Modification', "Modification des informations de la personne avec ID: $id");
            $data["message"] = "Les informations que vous avez modifiées ont bien été prises en compte.";
        } else {
            if ($aucuneModification) {
                // Si aucune modification n'a été apportée
                $data["message"] = "Aucune modification n'a été apportée.";
            } else {
                // Si la mise à jour a échoué
                $data["message"] = "Il y a un problème ! Les informations n'ont pas été modifiés !";
            }
        }
        $this->render("message", $data);
    }

    function action_modifierBesoin()
    {
        // Vérifier les rôles autorisés avant de procéder
        if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant") {
            $this->render("accueil");
            return;
        }

        $modif = false;
        $aucuneModification = true; // Pour suivre si une modification a été faite

        // Vérifier si les champs nécessaires sont présents et valides
        if (
            isset($_POST["aa"]) && preg_match('/^\d{4}$/', $_POST["aa"]) &&
            isset($_POST["s"]) && preg_match('/^[1-2]$/', $_POST["s"]) &&
            isset($_POST["idformation"]) && preg_match('/^\d+$/', $_POST["idformation"]) &&
            isset($_POST["iddiscipline"]) && preg_match('/^\d+$/', $_POST["iddiscipline"]) &&
            isset($_POST["iddepartement"]) && preg_match('/^\d+$/', $_POST["iddepartement"]) &&
            isset($_POST["besoin_heure"]) && preg_match('/^\d+(\.\d+)?$/', $_POST["besoin_heure"])
        ) {

            $m = Model::getModel();
            $besoinActuel = $m->getBesoinByIds($_POST["iddiscipline"], $_POST["iddepartement"], $_POST["idformation"]);

            // Vérifier si des modifications ont été faites
            if (
                !$besoinActuel ||
                $besoinActuel["aa"] != $_POST["aa"] ||
                $besoinActuel["s"] != $_POST["s"] ||
                $besoinActuel["besoin_heure"] != $_POST["besoin_heure"]
            ) {
                $aucuneModification = false;
            }

            // Si des modifications ont été détectées
            if (!$aucuneModification) {
                $infos = [
                    'AA' => $_POST["aa"],
                    'S' => $_POST["s"],
                    'idFormation' => $_POST["idformation"],
                    'idDiscipline' => $_POST["iddiscipline"],
                    'idDepartement' => $_POST["iddepartement"],
                    'besoin_heure' => $_POST["besoin_heure"]
                ];
                $modif = $m->updateBesoin($infos);
            }
        } else {
            $this->action_error("Les données fournies sont invalides ou incomplètes.");

        }

        // Préparation des données pour la vue
        $data = ["title" => "Modification de besoin"];
        if ($modif) {
            $data["message"] = "Le besoin a été modifié avec succès.";
        } else {
            $data["message"] = $aucuneModification ? "Aucune modification n'a été apportée." : "La modification a échoué.";
        }
        $this->render("message", $data);
    }

    function action_modifierChefDep()
    {
        if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant" || $_SESSION["role"] == "Chef de département") {
            $this->render("accueil");
            return;
        }
        if (isset($_POST["idEns"]) and isset($_POST["departement"]) and isset($_POST["id"])) {

            if ($_POST["idEns"] == $_POST["id"]) {
                $this->action_error("Vous d'avez rien changer");
            } else {

                $m = Model::getModel();
                if ($m->estChefDepartement($_POST["idEns"])) {

                    $this->action_error("Cette personne est déjà chef d'un département !");
                } else {
                    $changement = $m->updateChefDepartement($_POST["departement"], $_POST["idEns"]);
                }
            }
        } else {
            $this->action_error("Cette enseignant n'existe pas !");
        }
        $data = ["title" => "Modification du chef de département"];
        if ($changement) {
            $data["message"] = "Le chef de département a été modifié avec succès.";
        } else {
            $data["message"] = "Il y a eu une erreur lors de la modification, veuillez réessayer";
        }
        $this->render("message", $data);

    }


}
