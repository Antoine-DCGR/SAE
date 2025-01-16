<?php

class Controller_affichage extends Controller
{

    public function action_default()
    {
        $this->action_listePersonne();
    }

    function action_profil()
    {
        // Vérifie si l'ID de la personne est présent dans la session ou en tant que paramètre GET.
        if (isset($_SESSION["id"]) || isset($_GET["id"])) {
            $m = Model::getModel();
            // Récupère les informations de la personne en fonction de l'ID.
            if (isset($_GET["id"])) {
                // Si l'ID est passé via GET, utilise cet ID.
                $roles = $m->getAllRolesById($_GET["id"]);
                $personne = $m->getPersonneParId($_GET["id"]);
                $dep = $m->getDepartementByPersonId($_GET["id"]);
            } else {
                // Sinon, utilise l'ID de la session.
                $roles = $m->getAllRolesById($_SESSION["id"]);
                $personne = $m->getPersonneParId($_SESSION["id"]);
                $dep = $m->getDepartementByPersonId($_SESSION["id"]);
            }
        } else {
            // Si aucun ID n'est disponible, affiche une erreur.
            $this->action_error("Cette personne n'existe pas !");
        }
        if ($roles and $personne) {
            // Prépare les données pour la vue du profil.
            $data = [
                "roles" => $roles,
                "personne" => $personne,
            ];
            // Ajoute les informations du département si disponibles.
            if ($dep) {
                $data["dep"] = $dep;
            } else {
                $data["dep"] = [];
            }
            $this->render("profil", $data);
        } else {
            // Affiche une erreur si les informations ne sont pas complètes.
            $this->action_error("IL y a un problèmes sur les informations de la personne");
        }
    }
    
    public function action_listePersonne()
    {
        // Initialise la page de départ pour la pagination.
        $start = 1;
        if (isset($_GET["start"]) and preg_match("/^\d+$/", $_GET["start"]) and $_GET["start"] > 0) {
            $start = $_GET["start"];
        }
    
        $m = Model::getModel();
    
        // Récupère le nombre total de personnes et calcule le nombre total de pages.
        $nb_personne = $m->getNbPersonne();
        $nb_total_pages = ceil($nb_personne / 25);
    
        // Gère les cas d'erreur de pagination.
        if ($nb_total_pages < $start) {
            $this->action_error("La page n'exsite pas !");
        }
    
        // Calcule l'offset pour la requête SQL.
        $offset = ($start - 1) * 25;
    
        // Détermine la plage de numéros de page à afficher.
        $debut = $start - 5 <= 0 ? 1 : $start - 5;
        $fin = $debut + 9 > $nb_total_pages ? $nb_total_pages : $debut + 9;
    
        // Prépare les données pour la vue.
        $data = [
            'role' => $_SESSION['role'],
            'nb_total_pages' => $nb_total_pages,
            'active' => $start,
            'liste' => $m->getAllPersonsWithRolesWithLimit($offset, 25),
            'debut' => $debut,
            'fin' => $fin
        ];
    
        // Affiche la vue de la liste des personnes.
        $this->render("liste", $data);
    }
    

    public function action_choix()
    {
        $this->render("choix");
    }

    public function action_listeDepartement()
    {
        $m = Model::getModel();
    
        // Récupère toutes les informations des départements.
        $data = [
            "listedep" => $m->getAllDepartementInfos()
        ];
    
        // Affiche la vue de la liste des départements avec les données récupérées.
        $this->render('listeDepartement', $data);
    }
    


    function action_tableDeBord()
    {
        $m = Model::getModel();
    
        // Récupère différentes statistiques pour l'affichage sur le tableau de bord.
        $serviceStatistics = $m->getServiceStatistics();
        $personCategoryStatistics = $m->getPersonCategoryStatistics();
        $teacherStatistics = $m->getTeachersStatistics();
        $teacherStatisticsIUT = $m->getTeachersStatisticsIUT();
    
        // Prépare les données pour le graphique.
        $graphData = [];
        $totalPersons = 0;
        foreach ($personCategoryStatistics as $categoryStat) {
            $totalPersons += $categoryStat['count'];
        }
    
        foreach ($personCategoryStatistics as $categoryStat) {
            $percentage = $totalPersons > 0 ? ($categoryStat['count'] / $totalPersons) * 100 : 0;
            $graphData[] = [
                'y' => $percentage,
                'name' => $categoryStat['name'],
                'total' => $totalPersons,
            ];
        }
    
        // Prépare les données pour la vue.
        $data = [
            'graphData' => $graphData,
            'serviceStatistics' => $serviceStatistics,
            'teacherStatistics' => $teacherStatistics,
            'teacherStatisticsIUT' => $teacherStatisticsIUT,
        ];
    
        // Affiche la vue du tableau de bord avec les données statistiques.
        $this->render("tableDeBord", $data);
    }
    

    public function action_formModification()
    {
        // Vérifie le rôle de l'utilisateur pour autoriser la modification.
        if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant" || $_SESSION["role"] == "Chef de département") {
            $this->render("accueil");
        }
    
        // Vérifie la présence et la validité de l'identifiant.
        if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
            $id = $_GET["id"];
            $m = Model::getModel();
    
            // Récupère le rôle et prépare les données pour le formulaire de modification.
            $role = $m->getRoleById($id);
            $data = [
                "cat" => $m->getCategories(),
                "dep" => $m->getDepartement(),
                "dis" => $m->getDiscipline(),
                "sem" => $m->getSemestre(),
                "role" => $role,
            ];
    
            // Ajoute des informations supplémentaires en fonction du rôle.
            if ($role == "Enseignant" || $role == "Chef de département" || $role == "Équipe de direction") {
                $data["personne"] = $m->getPersonneParId($id);
                $data["categorie"] = $m->getEnseignantById($id);
            }
            if ($role == "Secrétaire") {
                $data["personne"] = $m->getPersonneParId($id);
            }
        } else {
            // Si l'identifiant n'est pas valide, renvoie une erreur.
            $message = "Il n'y a pas d'id !";
            $this->action_error($message);
        }
        $this->render("modification", $data);
    }
    

    function action_infoDepartement()
    {
        // Vérifie la présence et la validité de l'identifiant du département.
        if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
            $m = Model::getModel();
            $id = $_GET["id"];
    
            // Récupère les informations du département.
            $infoDep = $m->getDepartementInfos($id);
            $personne = $m->getPersonneParId($infoDep['id_personne']);
        } else {
            // Si l'identifiant n'est pas valide, renvoie une erreur.
            $this->action_error("Il n'y a pas d'identifiant !");
        }
    
        // Si les informations sont disponibles, prépare les données pour l'affichage.
        if ($infoDep and $personne) {
            $data = [
                "departement" => $infoDep,
                "personne" => $personne,
                "allEnseignant" => $m->getEnseignant()
            ];
            $this->render("infoDepartement", $data);
        } else {
            // Si les informations ne sont pas disponibles, renvoie une erreur.
            $this->action_error("Ce département n'existe pas !");
        }
    }
    


    function action_choixFormation()
    {
        // Vérifie la présence et la validité de l'identifiant du département.
        if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
            $m = Model::getModel();
            $id = $_GET["id"];
    
            // Récupère les informations du département.
            $dep = $m->getDepartementById($id);
        } else {
            // Si l'identifiant n'est pas valide, renvoie une erreur.
            $this->action_error("Il n'y a pas d'identifiant !");
        }
    
        // Si les informations du département sont disponibles, prépare les données pour l'affichage.
        if ($dep) {
            $data = ["id" => $id];
            $this->render("choixFormation", $data);
        } else {
            // Si le département n'existe pas, renvoie une erreur.
            $this->action_error("Ce département n'éxiste pas !");
        }
    }
    

    function action_listeBesoins()
    {
        // Vérifie si les critères pour lister les besoins sont définis.
        if ((isset($_POST["formation"]) && $_POST["formation"] == "BUT") || (isset($_POST["formation"]) && $_POST["formation"] == "LP") || (isset($_POST["niveau"]) && isset($_POST["annee"]) && isset($_POST["semestre"]))) {
            $m = Model::getModel();
    
            // Récupère l'ID du département et les informations associées.
            $idDepartement = $_POST['departement'];
            $inf = $m->getDepartementInfos($idDepartement);
    
            // Détermine l'ID de la formation en fonction des critères.
            if (!isset($_POST["niveau"])) {
                $formation = $_POST["formation"] ." ". $inf["libelledept"];
                $idFormation = $m->getFormationIdsByNomAndNiveau($formation, 1);
            } else {
                $idFormation = $m->getFormationIdsByNomAndNiveau($_POST["formation"], $_POST["niveau"]);
            }
    
            // Récupère les besoins pour la formation et le département spécifiés.
            if (!isset($_POST["annee"]) and !isset($_POST["semestre"])) {
                $annee = $m->getDerniereAnnee();
                $besoins = $m->getBesoinsByIdFormationDepartementAnneeSemestre($idFormation, $idDepartement, $annee['derniereannee'], 1);
            } else {
                $besoins = $m->getBesoinsByIdFormationDepartementAnneeSemestre($idFormation, $idDepartement, $_POST["annee"], $_POST["semestre"]);
            }
        } else {
            // Si les critères nécessaires ne sont pas définis, renvoie une erreur.
            $this->action_error("Vous n'avez pas choisi de formation !");
        }
    
        // Si des besoins sont trouvés, prépare les données pour l'affichage.
        if ($besoins) {
            $data = [
                "besoins" => $besoins,
                "sem" => $m->getSemestre(),
                "dep" => $idDepartement,
                "nomDep" => $m->getDepartementById($idDepartement),
                "inf" => $inf
            ];
            if (!isset($_POST["niveau"])) {
                $data["form"] = $formation;
            } else {
                $data["form"] = $_POST["formation"];
            }
            $this->render("besoins", $data);
        } else {
            // Si aucun besoin n'est trouvé, renvoie une autre erreur.
            $this->action_error("Il n'y a pas de besoins !");
        }
    }
    

    function action_formModificationBesoins()
    {
        // Vérifie le rôle de l'utilisateur pour autoriser la modification des besoins.
        if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant" ) {
            $this->render("accueil");
        }
    
        // Vérifie la présence et la validité des identifiants nécessaires dans l'URL.
        if (
            isset($_GET["idformation"]) and preg_match("/^[1-9]\d*$/", $_GET["idformation"]) &&
            isset($_GET["iddiscipline"]) and preg_match("/^[1-9]\d*$/", $_GET["iddiscipline"]) &&
            isset($_GET["iddepartement"]) and preg_match("/^[1-9]\d*$/", $_GET["iddepartement"])
        ) {
            $m = Model::getModel();
            $data = [
                "bes" => $m->getBesoinByIds($_GET["iddiscipline"], $_GET["iddepartement"], $_GET["idformation"])
            ];
        } else {
            // Si les identifiants ne sont pas corrects, renvoie une erreur.
            $this->action_error("Les id ne sont pas tous correcte !");
        }
        $this->render("modificationBesoins", $data);
    }
    

    function action_modifierBesoin()
    {
        // Vérifier les rôles autorisés avant de procéder
        if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant" || $_SESSION["role"] == "Chef de département") {
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
            isset($_POST["besoin_heure"]) && preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', $_POST["besoin_heure"])
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
    

    function action_monDepartement()
    {
        // Vérifie si l'ID de l'utilisateur est défini dans la session.
        if (isset($_SESSION["id"])) {
            $m = Model::getModel(); // Obtient une instance du modèle pour interagir avec la base de données.
    
            // Récupère les informations du département pour le chef de département actuellement connecté.
            $monDep = $m->getDepartementInfosChef($_SESSION["id"]);
        } else {
            // Si l'utilisateur n'est pas connecté ou n'est pas chef de département, renvoie une erreur.
            $this->action_error("Vous n'êtes pas chef de département !");
        }
    
        // Prépare les données du département pour l'affichage.
        $data = ["monDep" => $monDep];
        // Affiche la vue du département avec les données.
        $this->render("monDepartement", $data);
    }
    

    function action_afficherLogs()
    {
        $m = Model::getModel(); // Obtient une instance du modèle pour interagir avec la base de données.
    
        // Récupère tous les logs enregistrés.
        $logs = $m->getAllLogs();
    
        // Prépare les logs pour l'affichage.
        $data = ["logs" => $logs];
        // Affiche la vue des logs avec les données.
        $this->render("log", $data);
    }

    
function action_listeEns()
{
    // Vérifie le rôle de l'utilisateur connecté.
    if ($_SESSION["role"] == "Secrétaire" || $_SESSION["role"] == "Enseignant") {
        // Si l'utilisateur est un secrétaire ou un enseignant, redirige vers la page d'accueil.
        $this->render("accueil");
        return;
    }

    // Vérifie si un ID de département est passé dans l'URL.
    if (isset($_GET['id'])) {
        $m = Model::getModel(); // Obtient une instance du modèle.

        // Récupère la liste des enseignants assignés au département spécifié.
        $listeEns = $m->getEnseignantsAssignesAuDepartement($_GET['id']);
        $infos = [];

        // Pour chaque enseignant dans la liste, récupère ses informations.
        foreach ($listeEns as $val) {
            $infos[] = $m->getPersonneParId($val["id_personne"]);
        }
    } else {
        // Si aucun ID de département n'est fourni, renvoie une erreur.
        $this->action_error("Il n'y a pas de département !");
    }

    // Vérifie si des informations sur les enseignants sont disponibles.
    if ($infos) {
        // Prépare les données des enseignants pour l'affichage.
        $data = ["liste" => $infos];
        // Affiche la vue de la liste des enseignants avec les données.
        $this->render("listeEns", $data);
    } else {
        // Si aucune information n'est disponible, affiche la vue de la liste des départements.
        $this->render("listeDepartement");
    }
}


}


