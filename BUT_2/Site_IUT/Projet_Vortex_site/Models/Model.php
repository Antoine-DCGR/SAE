<?php

class Model
{
    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        include "credentials.php";
        $this->bd = new PDO($dsn, $login, $pwd);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getNbPersonne()
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM personne');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0];
    }

    public function idExiste($id)
    {
        $req = $this->bd->prepare("SELECT COUNT(*) FROM personne WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn() > 0;
    }

    public function getCategories()
    {
        $req = $this->bd->prepare('SELECT * FROM categorie');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnseignantById($id)
    {
        $req = $this->bd->prepare("SELECT * FROM enseignant WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return false; // Retourne false si aucune catégorie n'est trouvée
        }

        return $result;
    }

// Récupère tous les enregistrements de la table 'semestre'
public function getSemestre()
{
    // Préparation de la requête SQL pour sélectionner tout de la table 'semestre'
    $req = $this->bd->prepare('SELECT * FROM semestre');
    // Exécution de la requête préparée
    $req->execute();
    // Renvoie les résultats sous forme de tableau associatif
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère tous les enregistrements de la table 'discipline'
public function getDiscipline()
{
    // Préparation de la requête SQL pour sélectionner tout de la table 'discipline'
    $req = $this->bd->prepare('SELECT * FROM discipline');
    // Exécution de la requête préparée
    $req->execute();
    // Renvoie les résultats sous forme de tableau associatif
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère tous les enregistrements de la table 'formation'
public function getFormation()
{
    // Préparation de la requête SQL pour sélectionner tout de la table 'formation'
    $req = $this->bd->prepare('SELECT * FROM formation');
    // Exécution de la requête préparée
    $req->execute();
    // Renvoie les résultats sous forme de tableau associatif
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère tous les enregistrements de la table 'Diplome'
public function getDiplome()
{
    // Préparation de la requête SQL pour sélectionner tout de la table 'Diplome'
    $req = $this->bd->prepare('SELECT * FROM Diplome');
    // Exécution de la requête préparée
    $req->execute();
    // Renvoie les résultats sous forme de tableau associatif
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère tous les enregistrements de la table 'Niveau'
public function getNiveau()
{
    // Préparation de la requête SQL pour sélectionner tout de la table 'Niveau'
    $req = $this->bd->prepare('SELECT * FROM Niveau');
    // Exécution de la requête préparée
    $req->execute();
    // Renvoie les résultats sous forme de tableau associatif
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère tous les enregistrements de la table 'enseignant'
public function getEnseignant()
{
    // Préparation de la requête SQL pour sélectionner tout de la table 'enseignant'
    $req = $this->bd->prepare('SELECT * FROM enseignant');
    // Exécution de la requête préparée
    $req->execute();
    // Renvoie les résultats sous forme de tableau associatif
    return $req->fetchAll(PDO::FETCH_ASSOC);
}



    public function getDepartement()
    {
        // Préparer la requête SQL pour sélectionner les sigleDept de la table departement
        $req = $this->bd->prepare('SELECT * FROM departement');
        $req->execute();

        // Récupérer tous les résultats sous forme d'un tableau numérique
        return $req->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getFormationIdsByNomAndNiveau($nomFormation, $niveauFormation)
    {
        // Préparation de la requête SQL avec jointure entre les tables 'formation' et 'Niveau'
        // Sélectionne idFormation des formations correspondant au nom et au niveau spécifiés
        $req = $this->bd->prepare(
            "SELECT idFormation 
            FROM formation 
            JOIN Niveau ON formation.idDiplome = Niveau.idDiplome AND formation.idNiveau = Niveau.idNiveau
            WHERE nom = :nomFormation AND Niveau.Niveau = :niveauFormation"
        );

        // Associe la valeur de $nomFormation au paramètre nommé ':nomFormation' de la requête
        // Utilise PDO::PARAM_STR pour spécifier que le paramètre est une chaîne de caractères
        $req->bindValue(':nomFormation', $nomFormation, PDO::PARAM_STR);

        // Associe la valeur de $niveauFormation au paramètre nommé ':niveauFormation' de la requête
        // Utilise PDO::PARAM_INT pour spécifier que le paramètre est un entier
        $req->bindValue(':niveauFormation', $niveauFormation, PDO::PARAM_INT);

        // Exécution de la requête préparée
        $req->execute();

        // Récupère le premier résultat de la requête, s'il existe, sous forme de colonne unique
        $result = $req->fetch(PDO::FETCH_COLUMN);

        // Si un résultat est trouvé, retourne l'idFormation, sinon retourne false
        return $result ? $result : false;
    }

public function getBesoinsByIdFormationDepartementAnneeSemestre($idFormation, $idDepartement, $annee, $semestre)
    {
        // Préparation de la requête SQL avec jointures entre les tables 'Besoin', 'discipline', 'formation' et 'departement'
        // Sélectionne des informations détaillées sur les besoins correspondant aux critères spécifiés
        $req = $this->bd->prepare(
            "SELECT B.*, D.libelleDisc, F.nom AS NomFormation, Dept.libelleDept 
            FROM Besoin B
            JOIN discipline D ON B.idDiscipline = D.idDiscipline
            JOIN formation F ON B.idFormation = F.idFormation
            JOIN departement Dept ON B.idDepartement = Dept.idDepartement
            WHERE B.idFormation = :idFormation 
              AND B.idDepartement = :idDepartement 
              AND B.AA = :annee 
              AND B.S = :semestre"
        );

        // Associe les valeurs des paramètres aux paramètres nommés de la requête
        // Utilise PDO::PARAM_INT pour spécifier que les paramètres sont des entiers
        $req->bindValue(':idFormation', $idFormation, PDO::PARAM_INT);
        $req->bindValue(':idDepartement', $idDepartement, PDO::PARAM_INT);
        $req->bindValue(':annee', $annee, PDO::PARAM_INT);
        $req->bindValue(':semestre', $semestre, PDO::PARAM_INT);

        // Exécution de la requête préparée
        $req->execute();

        // Récupère tous les résultats de la requête sous forme de tableau associatif
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        // Si un ou plusieurs résultats sont trouvés, les retourne, sinon retourne false
        return $result ? $result : false;
    }


 // Récupère les informations d'un département par son identifiant
    public function getDepartementById($id)
    {
        // Préparation de la requête SQL pour sélectionner tout de la table 'departement' où l'id correspond
        $req = $this->bd->prepare('SELECT * FROM departement WHERE idDepartement = :id');

        // Associe la valeur de $id au paramètre nommé ':id' de la requête, spécifiant que c'est un entier
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête préparée
        $req->execute();

        // Récupère le premier résultat de la requête sous forme de tableau associatif
        $result = $req->fetch(PDO::FETCH_ASSOC);

        // Vérifie si le résultat est false (aucun département trouvé) et retourne false dans ce cas
        if ($result === false) {
            return false; // Retourne false si aucun département n'est trouvé
        }

        // Retourne le résultat trouvé
        return $result;
    }

    // Récupère un besoin spécifique en fonction de l'identifiant de la discipline, du département et de la formation
    public function getBesoinByIds($idDiscipline, $idDepartement, $idFormation)
    {
        // Préparation de la requête SQL pour sélectionner tout de la table 'Besoin' selon les critères spécifiés
        $req = $this->bd->prepare(
            "SELECT * 
            FROM Besoin 
            WHERE idDiscipline = :idDiscipline 
              AND idDepartement = :idDepartement 
              AND idFormation = :idFormation"
        );

        // Associe les valeurs des paramètres aux paramètres nommés de la requête, spécifiant qu'ils sont des entiers
        $req->bindValue(':idDiscipline', $idDiscipline, PDO::PARAM_INT);
        $req->bindValue(':idDepartement', $idDepartement, PDO::PARAM_INT);
        $req->bindValue(':idFormation', $idFormation, PDO::PARAM_INT);

        // Exécution de la requête préparée
        $req->execute();

        // Récupère le premier résultat de la requête sous forme de tableau associatif et le retourne
        // Retourne false si aucun besoin correspondant n'est trouvé
        return $req->fetch(PDO::FETCH_ASSOC);
    }




    public function getDerniereAnnee()
    {
        $req = $this->bd->prepare(
            "SELECT MAX(AA) AS DerniereAnnee
            FROM semestre"
        );
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : false; // Retourne l'année la plus récente ou false si aucun enregistrement n'est trouvé
    }

    public function getPersonneParId($id)
    {
        $req = $this->bd->prepare('SELECT * FROM personne WHERE id_personne = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return false; // Retourne false si aucune personne n'est trouvée
        }

        return $result;
    }

    public function getRoleById($id)
    {
        $rolePrincipal = null;
        $importanceRole = ['directeur' => 5, 'equipedirection' => 4, 'departement' => 3, 'enseignant' => 2, 'secretaire' => 1];

        // Correspondance entre les rôles techniques et les noms à afficher
        $nomsRoles = [
            'directeur' => 'Directeur',
            'equipedirection' => 'Équipe de direction',
            'departement' => 'Chef de département',
            'enseignant' => 'Enseignant',
            'secretaire' => 'Secrétaire'
        ];

        // Parcourir chaque rôle et vérifier dans la base de données
        foreach ($importanceRole as $role => $importance) {
            $req = $this->bd->prepare("SELECT id_personne FROM $role WHERE id_personne = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();

            // Si un enregistrement est trouvé et que le rôle est plus élevé que le rôle actuel le plus élevé
            if ($req->rowCount() > 0 && ($rolePrincipal === null || $importanceRole[$role] > $importanceRole[$rolePrincipal])) {
                $rolePrincipal = $role;
            }
        }

        // Traduire le rôle technique en un nom plus descriptif
        if ($rolePrincipal !== null && array_key_exists($rolePrincipal, $nomsRoles)) {
            $rolePrincipal = $nomsRoles[$rolePrincipal];
        }

        // Retourner le rôle principal
        return $rolePrincipal;
    }

    public function getAllRolesById($id)
    {
        $rolesTrouves = [];
        $importanceRole = ['directeur' => 5, 'equipedirection' => 4, 'departement' => 3, 'enseignant' => 2, 'secretaire' => 1];

        // Correspondance entre les rôles techniques et les noms à afficher
        $nomsRoles = [
            'directeur' => 'Directeur',
            'equipedirection' => 'Équipe de direction',
            'departement' => 'Chef de département',
            'enseignant' => 'Enseignant',
            'secretaire' => 'Secrétaire'
        ];

        // Parcourir chaque rôle et vérifier dans la base de données
        foreach ($importanceRole as $role => $importance) {
            $req = $this->bd->prepare("SELECT id_personne FROM $role WHERE id_personne = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();

            // Si un enregistrement est trouvé, ajouter le rôle au tableau des rôles trouvés
            if ($req->rowCount() > 0) {
                $rolesTrouves[] = array_key_exists($role, $nomsRoles) ? $nomsRoles[$role] : $role;
            }
        }

        // Retourner le tableau des rôles trouvés
        return $rolesTrouves;
    }

    // Récupère le ou les sigles de département(s) associé(s) à une personne par son identifiant
    public function getDepartementByPersonId($id)
    {
        // Préparation de la requête SQL pour sélectionner le sigle du département associé à l'identifiant de la personne
        $req = $this->bd->prepare('SELECT departement.sigleDept FROM assigner JOIN departement ON departement.idDepartement = assigner.idDepartement WHERE assigner.id_personne = :id');
        
        // Liaison de l'identifiant de la personne à la requête
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $req->execute();

        // Retourne tous les sigles de département associés à la personne
        return $req->fetchAll(PDO::FETCH_COLUMN);
    }

    // Récupère les informations d'un département par son identifiant
    public function getDepartementInfos($id)
    {
        // Préparation de la requête SQL pour sélectionner toutes les informations du département par son identifiant
        $req = $this->bd->prepare("SELECT * FROM departement WHERE idDepartement = :id");

        // Liaison de l'identifiant du département à la requête
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $req->execute();

        // Récupération du résultat
        $result = $req->fetch(PDO::FETCH_ASSOC);

        // Vérification si un département est trouvé
        if ($result === false) {
            return false; // Retourne false si aucun département n'est trouvé
        }

        // Retourne les informations du département trouvé
        return $result;
    }

    public function getDepartementInfosChef($id)
    {
        $req = $this->bd->prepare("SELECT * FROM departement WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return false; // Retourne false si aucun département n'est trouver 
        }

        return $result;
    }

    public function getFormationById($idFormation)
    {
        $req = $this->bd->prepare("SELECT * FROM formation WHERE idFormation = :idFormation");
        $req->bindValue(':idFormation', $idFormation, PDO::PARAM_INT);
        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC); // Retourne les informations de la formation ou false si non trouvé
    }

    public function getDisciplineById($idDiscipline)
    {
        $req = $this->bd->prepare("SELECT * FROM discipline WHERE idDiscipline = :idDiscipline");
        $req->bindValue(':idDiscipline', $idDiscipline, PDO::PARAM_INT);
        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC); // Retourne les informations de la discipline ou false si non trouvé
    }

    // Récupère une liste limitée de personnes avec leurs rôles associés
    public function getAllPersonsWithRolesWithLimit($offset = 0, $limit = 25)
    {
        // Initialisation d'un tableau vide pour stocker les personnes avec leurs rôles
        $peopleWithRoles = [];

        // Préparation de la requête SQL pour sélectionner des personnes avec une limite et un décalage
        $req = $this->bd->prepare("SELECT * FROM personne ORDER BY nom DESC LIMIT :limit OFFSET :offset");

        // Liaison des paramètres :limit et :offset avec leurs valeurs respectives
        // PDO::PARAM_INT est utilisé pour s'assurer que ces valeurs sont traitées comme des entiers
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Exécution de la requête préparée
        $req->execute();

        // Parcours des résultats de la requête
        while ($person = $req->fetch(PDO::FETCH_ASSOC)) {
            // Récupération de l'identifiant de la personne
            $id_personne = $person['id_personne'];

            // Obtention du rôle de la personne en utilisant son identifiant
            $role = $this->getRoleById($id_personne);

            // Ajout du rôle à l'information de la personne
            $person['role'] = $role;

            // Ajout de la personne avec son rôle dans le tableau $peopleWithRoles
            $peopleWithRoles[] = $person;
        }

        // Retourne la liste des personnes avec leurs rôles
        return $peopleWithRoles;
    }

    public function getIdDepartementParSigle($sigleDept)
    {
        $req = $this->bd->prepare("SELECT idDepartement FROM departement WHERE sigleDept = :sigleDept");
        $req->bindValue(':sigleDept', $sigleDept, PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result['iddepartement'] ? $result['iddepartement'] : false;
    }

    public function getAllDepartementInfos()
    {
        // Prépare la requête SQL pour récupérer toutes les informations des départements
        $req = $this->bd->prepare('SELECT * FROM departement');
        $req->execute();

        // Récupère toutes les lignes de résultat sous forme d'un tableau associatif
        $departements = $req->fetchAll(PDO::FETCH_ASSOC);

        return $departements;
    }

        public function getEmail($id)
    {
        $sql = "Select email from personne Where id_personne = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAllLogs()
    {
        $req = $this->bd->prepare("SELECT * FROM logs ORDER BY timestamp DESC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEnseignantsAssignesAuDepartement($idDepartement)
    {
        // Exemple de requête SQL pour récupérer les enseignants assignés à un département
        $sql = "SELECT E.*
                FROM Enseignant E
                INNER JOIN Assigner A ON E.id_personne = A.id_personne
                WHERE A.idDepartement = :idDepartement";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':idDepartement', $idDepartement, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère des statistiques sur les heures par discipline et département
    public function getDisciplineHoursDepartmentStatistics()
    {
        // Initialisation d'un tableau vide pour stocker les résultats
        $data = [];

        // Définition de la requête SQL pour calculer le total des heures par discipline et département
        $query = "SELECT libelledisc, iddepartement, SUM(besoin_heure) AS total_hours
                  FROM Besoin
                  JOIN Discipline ON Besoin.iddiscipline = Discipline.iddiscipline
                  GROUP BY Besoin.iddiscipline, libelledisc, iddepartement";

        // Exécution de la requête
        $result = $this->bd->query($query);

        // Parcours des résultats et stockage dans le tableau $data
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = [
                'discipline' => $row['libelledisc'],       // Nom de la discipline
                'departement' => $row['iddepartement'],    // Identifiant du département
                'hours' => $row['total_hours'],            // Total des heures pour cette combinaison
            ];
        }

        // Retourne le tableau de données accumulées
        return $data;
    }

    public function getServiceStatistics()
    {
        // Initialisation d'un tableau vide pour stocker les statistiques
        $statistics = [];

        // Définition de la requête SQL pour calculer le total des services statutaires et complémentaires
        $query = "SELECT SUM(serviceStatutaire) AS totalstatutaire, SUM(serviceComplementaireEnseignement) AS totalcomplementaire
                  FROM Categorie";

        // Exécution de la requête
        $result = $this->bd->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // Vérification si les résultats contiennent les clés 'totalstatutaire' et 'totalcomplementaire'
        if ($row && array_key_exists('totalstatutaire', $row) && array_key_exists('totalcomplementaire', $row)) {
            // Calcul du total combiné des services statutaires et complémentaires
            $total = $row['totalstatutaire'] + $row['totalcomplementaire'];

            // Calcul des pourcentages
            // Si le total est supérieur à 0, calcule les pourcentages, sinon ils seront 0
            $percentageStatutaire = ($total > 0) ? ($row['totalstatutaire'] / $total) * 100 : 0;
            $percentageComplementaire = ($total > 0) ? ($row['totalcomplementaire'] / $total) * 100 : 0;

            // Stockage des pourcentages dans le tableau $statistics
            $statistics = [
                'statutaire' => $percentageStatutaire,          // Pourcentage du service statutaire
                'complementaire' => $percentageComplementaire, // Pourcentage du service complémentaire
            ];
        }

        // Retourne les statistiques calculées
        return $statistics;
    }

       // Récupère des statistiques sur les services pour un utilisateur spécifique identifié par $userId
    public function getServiceStatisticsById($userId)
    {
        // Initialisation d'un tableau vide pour stocker les statistiques
        $statistics = [];

        // Définition de la requête SQL pour calculer le total des services statutaires et complémentaires pour un utilisateur spécifique
        $query = "SELECT SUM(categorie.servicecomplementairereferentiel + categorie.servicecomplementaireenseignement) AS totalcomplementaire, 
                  SUM(servicestatutaire) AS totalstatutaire 
                  FROM enseignant 
                  JOIN categorie ON enseignant.id_categorie=categorie.id_categorie 
                  WHERE id_personne=:userId
                  GROUP BY categorie.servicestatutaire";

        // Préparation de la requête avec la variable $bd (instance PDO)
        $stmt = $this->bd->prepare($query);

        // Associe la valeur de $userId au paramètre nommé ':userId' de la requête, spécifiant que c'est un entier
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

        // Exécution de la requête préparée
        $stmt->execute();

        // Récupère le premier résultat de la requête sous forme de tableau associatif
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si les résultats contiennent les clés 'totalstatutaire' et 'totalcomplementaire'
        if ($row && array_key_exists('totalstatutaire', $row) && array_key_exists('totalcomplementaire', $row)) {
            // Calcul du total combiné des services statutaires et complémentaires
            $total = $row['totalstatutaire'] + $row['totalcomplementaire'];

            // Calcul des pourcentages
            // Si le total est supérieur à 0, calcule les pourcentages, sinon ils seront 0
            $percentageStatutaire = ($total > 0) ? ($row['totalstatutaire'] / $total) * 100 : 0;
            $percentageComplementaire = ($total > 0) ? ($row['totalcomplementaire'] / $total) * 100 : 0;

            // Stockage des pourcentages et de l'ID de l'utilisateur dans le tableau $statistics
            $statistics = [
                'statutaire' => $percentageStatutaire,
                'complementaire' => $percentageComplementaire,
                'userId' => $userId,
            ];
        }

        // Retourne les statistiques calculées
        return $statistics;
    }

        // Récupère des statistiques sur les enseignants par catégorie pour un département spécifique
    public function getTeachersStatistics()
    {
        // Initialisation d'un tableau vide pour stocker les statistiques
        $statistics = [];

        // Définition de la requête SQL pour compter les enseignants par catégorie dans le département 'INFO'
        $query = "SELECT c.siglecat, COUNT(e.id_personne) AS totalteachers
                  FROM Enseignant e
                  JOIN Categorie c ON e.id_categorie = c.id_categorie
                  JOIN Assigner s ON e.id_personne = s.id_personne
                  JOIN Departement d ON s.idDepartement = d.idDepartement
                  WHERE d.sigledept = 'INFO'
                  GROUP BY c.sigleCat;";

        // Exécution de la requête
        $result = $this->bd->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        // Calcul du total des enseignants dans toutes les catégories
        $total = array_reduce($rows, function ($carry, $row) {
            return $carry + $row['totalteachers'];
        }, 0);

        // Parcours des résultats pour calculer le pourcentage d'enseignants dans chaque catégorie
        foreach ($rows as $row) {
            // Calcul du pourcentage
            $percentage = ($total > 0) ? ($row['totalteachers'] / $total) * 100 : 0;

            // Stockage des informations dans le tableau $statistics
            $statistics[] = [
                'siglecat' => $row['siglecat'],          // Sigle de la catégorie
                'totalteachers' => $row['totalteachers'],// Total des enseignants dans la catégorie
                'percentage' => $percentage,             // Pourcentage des enseignants dans cette catégorie
            ];
        }

        // Retourne les statistiques calculées
        return $statistics;
    }


    // Récupère des statistiques sur les enseignants par catégorie pour tous les départements de l'IUT
    public function getTeachersStatisticsIUT()
    {
        // Initialisation d'un tableau vide pour stocker les statistiques
        $statistics = [];

        // Définition de la requête SQL pour compter les enseignants par catégorie dans tous les départements
        $query = "SELECT c.siglecat, COUNT(e.id_personne) AS totalteachers
                  FROM Enseignant e
                  JOIN Categorie c ON e.id_categorie = c.id_categorie
                  JOIN Assigner s ON e.id_personne = s.id_personne
                  JOIN Departement d ON s.idDepartement = d.idDepartement
                  GROUP BY c.sigleCat;";

        // Exécution de la requête
        $result = $this->bd->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        // Calcul du total des enseignants dans toutes les catégories
        $total = array_reduce($rows, function ($carry, $row) {
            return $carry + $row['totalteachers'];
        }, 0);

        // Tableau de couleurs pour la représentation graphique
        $colors = [
            "#717171", "#e5d8b0", "#ffb367", "#f98461",
            "#393f63", "#d9695f", "#a2a2a2", "#FDE200", "#E12424"
        ];

        // Parcours des résultats pour calculer le pourcentage d'enseignants dans chaque catégorie
        foreach ($rows as $key => $row) {
            // Calcul du pourcentage
            $percentage = ($total > 0) ? ($row['totalteachers'] / $total) * 100 : 0;

            // Ajout des données dans le tableau $statistics, incluant la couleur correspondante
            $statistics[] = [
                'y' => $percentage,                // Pourcentage des enseignants dans cette catégorie
                'name' => $row['siglecat'],        // Sigle de la catégorie
                'totalteachers' => $row['totalteachers'], // Total des enseignants dans la catégorie
                'color' => $colors[$key % count($colors)], // Couleur associée à la catégorie
            ];
        }

        // Retourne les statistiques calculées
        return $statistics;
    }

        // Récupère des statistiques sur le nombre de personnes par catégorie (Enseignant, Secretaire, Directeur) 
    // et le nombre de chefs de département
    public function getPersonCategoryStatistics()
    {
        // Initialisation d'un tableau vide pour stocker les données
        $data = [];

        // Définition des catégories à analyser
        $categories = ['Enseignant', 'Secretaire', 'Directeur'];

        // Récupérer le nombre d'enseignants qui sont chefs de département
        $queryChefDepartement = "SELECT COUNT(DISTINCT id_personne) AS count FROM Departement";
        $resultChefDepartement = $this->bd->query($queryChefDepartement);
        $countChefDepartement = $resultChefDepartement->fetch(PDO::FETCH_ASSOC)['count'];

        // Ajout des statistiques des chefs de département au tableau $data
        $data[] = [
            'name' => 'Chef de departement',
            'count' => $countChefDepartement,
        ];

        // Initialisation de la variable pour calculer le total
        $total = 0;

        // Parcours des différentes catégories pour récupérer le nombre de personnes dans chaque catégorie
        foreach ($categories as $category) {
            // Requête pour compter le nombre de personnes dans la catégorie courante
            $query = "SELECT COUNT(*) AS count FROM $category";
            $result = $this->bd->query($query);
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];

            // Mise à jour du total
            $total += $count;

            // Ajout des statistiques de la catégorie actuelle au tableau $data
            $data[] = [
                'name' => $category, // Nom de la catégorie
                'count' => $count,   // Nombre de personnes dans la catégorie
                'total' => $total,   // Total cumulatif jusqu'à présent
            ];
        }

        // Retourne les données accumulées
        return $data;
    }
        
    public function estChefDepartement($idPersonne)
    {
        $req = $this->bd->prepare("SELECT COUNT(*) FROM departement WHERE id_personne = :idPersonne");
        $req->bindValue(':idPersonne', $idPersonne, PDO::PARAM_INT);
        $req->execute();

        // Récupérer le nombre de départements où la personne est chef
        $nombre = $req->fetchColumn();

        // Retourner vrai (true) si la personne est chef d'au moins un département, sinon faux (false)
        return $nombre > 0;
    }

        public function updateBesoin($infos)
    {
        $req = $this->bd->prepare(
            "UPDATE Besoin 
            SET AA = :AA, S = :S, besoin_heure = :besoin_heure
            WHERE idFormation = :idFormation 
              AND idDepartement = :idDepartement 
              AND idDiscipline = :idDiscipline"
        );
        // Lier les valeurs
        $req->bindValue(':AA', $infos['AA'], PDO::PARAM_INT);
        $req->bindValue(':S', $infos['S'], PDO::PARAM_INT);
        $req->bindValue(':besoin_heure', $infos['besoin_heure'], PDO::PARAM_STR);
        $req->bindValue(':idFormation', $infos['idFormation'], PDO::PARAM_INT);
        $req->bindValue(':idDepartement', $infos['idDepartement'], PDO::PARAM_INT);
        $req->bindValue(':idDiscipline', $infos['idDiscipline'], PDO::PARAM_INT);

        return $req->execute(); // Retourne vrai (true) en cas de succès, faux (false) en cas d'échec
    }

    // Méthode pour mettre à jour le chef de département
    public function updateChefDepartement($sigleDept, $nouvelIdPersonne)
    {
        $idDepartement = $this->getIdDepartementParSigle($sigleDept);
        if ($idDepartement) {
            $req = $this->bd->prepare("UPDATE departement SET id_personne = :id_personne WHERE idDepartement = :idDepartement");
            $req->bindValue(':id_personne', $nouvelIdPersonne, PDO::PARAM_INT);
            $req->bindValue(':idDepartement', $idDepartement, PDO::PARAM_INT);
            return $req->execute();
        }
        return false;
    }

    public function updatePersonne($infos)
    {
        // Préparation de la requête de mise à jour
        $req = $this->bd->prepare("UPDATE personne SET nom = :nom, prenom = :prenom, email = :email, motdepasse = :mdp WHERE id_personne = :id");

        // Liaison des valeurs
        $marqueurs = ['id', 'nom', 'prenom', 'email', 'mdp'];
        foreach ($marqueurs as $value) {
            $req->bindValue(':' . $value, $infos[$value]);
        }

        // Exécution de la requête
        $req->execute();

        // Retourne true si la ligne a été mise à jour, false sinon
        return (bool) $req->rowCount();
    }

    public function updateCatEnseignant($id_personne, $nouvelIdCategorie)
    {
        // Préparation de la requête de mise à jour
        $req = $this->bd->prepare("UPDATE enseignant SET id_categorie = :nouvelIdCategorie WHERE id_personne = :idPersonne");

        // Liaison des valeurs
        $req->bindValue(':nouvelIdCategorie', $nouvelIdCategorie);
        $req->bindValue(':idPersonne', $id_personne);

        // Exécution de la requête
        $req->execute();

        // Retourne true si la ligne a été mise à jour, false sinon
        return (bool) $req->rowCount();
    }
    public function searchUserByName($name)
    {
        $sql = "SELECT * FROM personne WHERE nom LIKE :name";
        $stmt = $this->bd->prepare($sql);
        $name = "%$name%";
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateEmail($id, $email)
    {
        try {
            $sql = "UPDATE personne SET email = :email WHERE id_personne = :id";
            $stmt = $this->bd->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            return $rowCount > 0;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function updateMotDePasse($id_personne, $nouveauMotDePasse) {
        $req = $this->bd->prepare("UPDATE Personne SET motDePasse = :nouveauMotDePasse WHERE id_personne = :id_personne");
    
        $req->bindValue(':id_personne', $id_personne, PDO::PARAM_INT);
        $req->bindValue(':nouveauMotDePasse', $nouveauMotDePasse, PDO::PARAM_STR);
    
        return $req->execute();
    }

    public function addPersonne($infos)
    {
        $req = $this->bd->prepare("INSERT INTO personne(id_personne, nom, prenom, email, motdepasse) VALUES (:id, :nom, :prenom, :email, :mdp)");

        $marqueurs = ['id', 'nom', 'prenom', 'email', 'mdp'];
        foreach ($marqueurs as $value) {
            $req->bindValue(':' . $value, $infos[$value]);
        }

        //Exécution de la requête
        $req->execute();

        return (bool) $req->rowCount();
    }

    public function addSecretaire($infos)
    {
        // Vérifie d'abord si la personne existe déjà dans la table 'personne'
        $personneExiste = $this->getPersonneParId($infos['id']);

        $secretaireExisteDansDept = $this->secretaireExisteDansDepartement($infos['depsec'], $infos['annee'], $infos['semestre']);
        if ($secretaireExisteDansDept) {
            return false;
        }

        if (!$personneExiste) {
            // La personne n'existe pas, ajoutons-la à la table 'personne'
            $ajoutPersonne = $this->addPersonne($infos);
        }

        // Vérifier si une secrétaire existe déjà dans le département


        $this->assignerEnseignantAuDepartement($infos['id'], $infos['depsec'], $infos['annee'], $infos['semestre'], 0.9);
        // Préparer la requête pour insérer dans la table 'secretaire'
        $req = $this->bd->prepare("INSERT INTO secretaire(id_personne) VALUES (:id)");

        // Associer la valeur de l'ID de la personne
        $req->bindValue(':id', $infos['id']);

        // Exécuter la requête
        $insertionReussie = $req->execute();

        if (!$insertionReussie) {
            return false;
        }

        return true;
    }


    public function addEnseignant($infos, $departements)
    {
        // Début de la transaction
        $this->bd->beginTransaction();

        try {
            $personneExiste = $this->getPersonneParId($infos['id']);

            if (!$personneExiste) {
                // La personne n'existe pas, ajoutons-la à la table 'personne'
                $personneAjoutee = $this->addPersonne($infos);
            } else {
                // En cas d'erreur, annule la transaction et retourne false
                $this->bd->rollBack();
                return false;
            }

            if (!$personneAjoutee) {
                // En cas d'erreur, annule la transaction et retourne false
                $this->bd->rollBack();
                return false;
            }

            // Ajout de l'enseignant
            $enseignantAjoute = $this->addEnseignantDetails($infos);

            if (!$enseignantAjoute) {
                // En cas d'erreur, annule la transaction et retourne false
                $this->bd->rollBack();
                return false;
            }

            // Ajout des départements
            foreach ($departements as $departement => $quotite) {
                $assignationReussie = $this->assignerEnseignantAuDepartement($infos['id'], $departement, $infos['annee'], $infos['semestre'], $quotite);

                if (!$assignationReussie) {
                    // En cas d'erreur, annule la transaction et retourne false
                    $this->bd->rollBack();
                    return false;
                }
            }

            $enseigneMatiere = $this->enseigneMatiere($infos);

            if (!$enseigneMatiere) {
                // En cas d'erreur, annule la transaction et retourne false
                $this->bd->rollBack();
                return false;
            }

            // Toutes les étapes ont réussi, on valide la transaction
            $this->bd->commit();

            return true;
        } catch (Exception $e) {
            // En cas d'exception, annule la transaction et retourne false
            $this->bd->rollBack();
            return false;
        }
    }

    public function addEnseignantDetails($infos)
    {
        $req = $this->bd->prepare("INSERT INTO enseignant(id_personne, iddiscipline, id_categorie, aa) VALUES (:id, :discipline, :categorie, :annee)");

        $marqueurs = ['id', 'discipline', 'categorie', 'annee'];
        foreach ($marqueurs as $value) {
            $req->bindValue(':' . $value, $infos[$value]);
        }

        // Exécution de la requête
        $req->execute();

        return (bool) $req->rowCount();
    }

    // Méthode pour ajouter une personne à l'équipe de direction
    public function addEquipeDirection($idPersonne)
    {
        if ($this->isPersonneInEquipeDirection($idPersonne)) {
            return false; // La personne est déjà dans l'équipe de direction
        }

        $req = $this->bd->prepare("INSERT INTO equipedirection (id_personne) VALUES (:idPersonne)");
        $req->bindValue(':idPersonne', $idPersonne, PDO::PARAM_INT);
        return $req->execute();
    }


    // Méthode pour supprimer une personne de l'équipe de direction
    public function removeEquipeDeDirection($idPersonne)
    {
        if (!$this->isPersonneInEquipeDirection($idPersonne)) {
            return false; // La personne n'est pas dans l'équipe de direction
        }

        $req = $this->bd->prepare("DELETE FROM equipedirection WHERE id_personne = :idPersonne");
        $req->bindValue(':idPersonne', $idPersonne, PDO::PARAM_INT);
        return $req->execute();
    }

    public function removePersonne($id)
    {
        $req = $this->bd->prepare("DELETE FROM personne WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        return (bool) $req->rowCount();
    }

    public function removeEnseignant($id)
    {
        $req = $this->bd->prepare("DELETE FROM enseignant WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        return (bool) $req->rowCount();
    }

    public function removeAssigner($id)
    {
        $req = $this->bd->prepare("DELETE FROM assigner WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        return (bool) $req->rowCount();
    }

    public function removeSecretaire($id)
    {
        // Début de la transaction
        $this->bd->beginTransaction();

        // Suppression de la table secretaire
        $req = $this->bd->prepare("DELETE FROM secretaire WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        // Vérifier si la suppression a échoué dans la table secretaire
        if ($req->rowCount() == 0) {
            // Annuler la transaction et retourner false
            $this->bd->rollback();
            return false;
        }

        // Suppression dans la table assigner
        $assigner = $this->removeAssigner($id);
        if (!$assigner) {
            // Annuler la transaction et retourner false
            $this->bd->rollback();
            return false;
        }

        // Suppression dans la table personne
        $personne = $this->removePersonne($id);
        if (!$personne) {
            // Annuler la transaction et retourner false
            $this->bd->rollback();
            return false;
        }

        // Valider la transaction et retourner true
        $this->bd->commit();
        return true;
    }

    public function removeEquipeDirection($id)
    {
        $req = $this->bd->prepare("DELETE FROM equipedirection WHERE id_personne = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        if ($req->rowCount() > 0) {
            // Si oui, procéder à la suppression de l'enseignant
            return $this->removeAllEnseignantInfos($id);
        }

        // Si la suppression dans la table equipedirection n'a pas eu lieu, renvoyer false
        return false;


    }


    public function removeEnseigne($id)
    {
        // Utilisez la méthode getRoleById pour vérifier le rôle de la personne
        $role = $this->getRoleById($id);

        // Vérifiez si le rôle est 'enseignant' pour permettre la suppression
        if ($role === 'Enseignant') {
            // L'ID correspond à un enseignant, on peut supprimer les enregistrements dans "enseigne"
            $reqDeleteEnseigne = $this->bd->prepare("DELETE FROM enseigne WHERE id_personne = :id");
            $reqDeleteEnseigne->bindValue(':id', $id, PDO::PARAM_INT);
            $reqDeleteEnseigne->execute();

            return (bool) $reqDeleteEnseigne->rowCount();
        } else {
            // Le rôle n'est pas 'enseignant', renvoie false
            return false;
        }
    }

    public function removeAllEnseignantInfos($id)
    {
        // Vérifiez si la personne est un enseignant
        if ($this->getRoleById($id) !== 'Enseignant') {
            // Si ce n'est pas un enseignant, arrêtez le processus et renvoyez false
            return false;
        }

        // Supprimer des enregistrements de la table enseigne
        if (!$this->removeEnseigne($id)) {
            return false;
        }

        // Supprimer des enregistrements de la table assigner
        if (!$this->removeAssigner($id)) {
            return false;
        }

        // Supprimer de la table enseignant
        if (!$this->removeEnseignant($id)) {
            return false;
        }

        // Enfin, supprimer de la table personne
        return $this->removePersonne($id);
    }

    public function secretaireExisteDansDepartement($idDepartement, $annee, $semestre)
    {
        // Préparer la requête pour vérifier si un secrétaire est déjà assigné à un département donné pour une année et un semestre spécifiques
        $req = $this->bd->prepare("
            SELECT COUNT(*) 
            FROM assigner 
            JOIN secretaire ON assigner.id_personne = secretaire.id_personne 
            WHERE assigner.idDepartement = :idDepartement 
            AND assigner.AA = :annee 
            AND assigner.S = :semestre"
        );

        // Associer les valeurs des paramètres
        $req->bindValue(':idDepartement', $idDepartement, PDO::PARAM_INT);
        $req->bindValue(':annee', $annee, PDO::PARAM_INT);
        $req->bindValue(':semestre', $semestre, PDO::PARAM_INT);

        // Exécuter la requête
        $req->execute();

        // Récupérer le résultat (nombre de secrétaires assignés trouvés)
        $count = $req->fetchColumn();

        // Si le nombre est supérieur à zéro, un secrétaire est déjà assigné au département pour l'année et le semestre spécifiés
        return $count > 0;
    }

    public function enseigneMatiere($infos)
    {
        // Préparer la requête pour insérer dans la table 'enseigne'
        $req = $this->bd->prepare("INSERT INTO enseigne(id_personne, idDiscipline, AA, S, nbHeureEns) VALUES (:id, :discipline, :annee, :semestre, :nbheure)");

        // Associer les valeurs aux marqueurs de la requête
        $marqueurs = ['id', 'discipline', 'annee', 'semestre', 'nbheure'];
        foreach ($marqueurs as $value) {
            $req->bindValue(':' . $value, $infos[$value]);
        }
        // Exécuter la requête
        $req->execute();

        // Retourner true si l'insertion a réussi, sinon false
        return (bool) $req->rowCount();
    }

    public function assignerEnseignantAuDepartement($idPersonne, $departement, $annee, $semestre, $quotite)
    {
        $req = $this->bd->prepare("INSERT INTO assigner(id_personne, iddepartement, aa, s, quotite) VALUES (:id, :departement, :annee, :semestre, :quotite)");

        $req->bindValue(':id', $idPersonne, PDO::PARAM_INT);
        $req->bindValue(':departement', $departement, PDO::PARAM_INT);
        $req->bindValue(':annee', $annee);
        $req->bindValue(':semestre', $semestre);
        $req->bindValue(':quotite', $quotite, PDO::PARAM_INT);

        // Exécution de la requête
        $req->execute();

        return (bool) $req->rowCount();
    }

    private function isPersonneInEquipeDirection($idPersonne)
    {
        $req = $this->bd->prepare("SELECT COUNT(*) FROM equipedirection WHERE id_personne = :idPersonne");
        $req->bindValue(':idPersonne', $idPersonne, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchColumn() > 0;
    }

    public function insertLog($userId, $actionType, $description)
    {
        $req = $this->bd->prepare("INSERT INTO logs (user_id, action_type, action_description) VALUES (:userId, :actionType, :description)");
        $req->bindValue(':userId', $userId, PDO::PARAM_INT);
        $req->bindValue(':actionType', $actionType, PDO::PARAM_STR);
        $req->bindValue(':description', $description, PDO::PARAM_STR);
        return $req->execute();
    }

}