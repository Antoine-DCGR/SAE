<?php

class Controller_authentification extends Controller
{

    public function action_default()
    {
        $this->action_authentification();
    }



    public function action_authentification()
    {
        $m = Model::getModel();
        // Vérifie si la session 'connexion' est définie et vraie
        if (isset($_SESSION['connexion']) and $_SESSION['connexion']) {

            // Appelle la méthode render pour afficher la vue 'accueil', en passant le tableau $data
            $this->render("accueil");

        } else {
            $this->render("authentification"); // Affiche la page d'authentification dans le cas contraire
        }

    }



    function action_connexion()
    {
        $m = Model::getModel();
        $error_messages = [];

        // Vérifier les conditions pour l'identification
        if (
            isset($_POST["id"]) && !empty($_POST["id"]) && preg_match('/^\d+$/', $_POST["id"]) &&
            isset($_POST["password"]) && !empty($_POST["password"])
        ) {
            $ident = $m->getPersonneParId($_POST["id"]);

            if ($ident && password_verify($_POST["password"], $ident["motdepasse"])) {
                $_SESSION['connexion'] = true;

                // Récupérer les informations de l'utilisateur
                $_SESSION["id"] = $_POST["id"];
                $_SESSION['nom'] = $ident['nom'];
                $_SESSION['prenom'] = $ident['prenom'];
                $_SESSION['email'] = $ident['email'];

                // Récupérer le sigleDept de l'utilisateur
                $departementInfo = $m->getDepartementByPersonId($_POST["id"]);
                $departments = ($departementInfo !== null) ? explode(',', implode(',', $departementInfo)) : [];
                $departments = array_map('trim', $departments);
                $_SESSION['sigledept'] = $departments;

                // Déterminer et définir le rôle dans la session
                $_SESSION['role'] = $m->getRoleById($_POST["id"]);
                // Rediriger vers la page d'accueil
                $data = [
                    'role' => $_SESSION['role'],
                    "listedep" => $m->getAllDepartementInfos()
                ];
                $this->render("accueil", $data);

                return;
            } else {
                if($ident){
                    $mdpHache = password_hash($ident["motdepasse"], PASSWORD_DEFAULT);
                    if ($ident && password_verify($_POST["password"], $mdpHache)) {
                        $_SESSION['connexion'] = true;
                        $m->updateMotDePasse($_POST["id"], $mdpHache);
                        // Récupérer les informations de l'utilisateur
                        $_SESSION["id"] = $_POST["id"];
                        $_SESSION['nom'] = $ident['nom'];
                        $_SESSION['prenom'] = $ident['prenom'];
                        $_SESSION['email'] = $ident['email'];
        
                        // Récupérer le sigleDept de l'utilisateur
                        $departementInfo = $m->getDepartementByPersonId($_POST["id"]);
                        $departments = ($departementInfo !== null) ? explode(',', implode(',', $departementInfo)) : [];
                        $departments = array_map('trim', $departments);
                        $_SESSION['sigledept'] = $departments;
        
                        // Déterminer et définir le rôle dans la session
                        $_SESSION['role'] = $m->getRoleById($_POST["id"]);
                        // Rediriger vers la page d'accueil
                        $data = [
                            'role' => $_SESSION['role'],
                            "listedep" => $m->getAllDepartementInfos()
                        ];
                        $this->render("accueil", $data);
        
                        return;

                    }else {$error_messages[] = "Erreur ! Le mot de passe est incorrect !";}

                }else {
                    $error_messages[] = "Erreur ! La personne n'existe pas !";
                }
            }
        } else {
            $error_messages[] = "Erreur ! Veuillez fournir un identifiant et un mot de passe valides.";
        }

        // Passer les messages d'erreur à la vue sans conversion JSON
        $data = ['errorMessages' => $error_messages];
        $this->render("authentification", $data);
    }




    function action_mdpOublier()
    {
        $this->render("motDePasseOublier");
    }


    function action_udatEmail()
{
    $m = Model::getModel(); 

    // Vérifie si l'email et l'identifiant sont présents dans les données POST.
    if (isset($_POST["email"]) && isset($_POST["id"])) {
        $id = $_SESSION["id"]; // Récupère l'ID de l'utilisateur actuellement connecté à partir de la session.

        $newEmail = $_POST["email"]; // Récupère le nouvel email à partir des données POST.

        $valide = $m->updateEmail($id, $newEmail); // Met à jour l'email dans la base de données.

        if ($valide) {
            // Si la mise à jour est réussie, met à jour l'email dans la session.
            $_SESSION["email"] = $m->getEmail($id)["email"];

            // Récupère les rôles et les informations de l'utilisateur pour les afficher dans le profil.
            $roles = $m->getAllRolesById($_POST["id"]);
            $personne = $m->getPersonneParId($_POST["id"]);
            $dep = $m->getDepartementByPersonId($_POST["id"]);

            // Prépare les données à passer à la vue.
            $data = [
                "roles" => $roles,
                "personne" => $personne,
            ];

            // Ajoute les informations du département à la vue, ou un tableau vide si non disponibles.
            if ($dep) {
                $data["dep"] = $dep;
            } else {
                $data["dep"] = [];
            }

            // Affiche la vue du profil de l'utilisateur avec les données mises à jour.
            $this->render("profil", $data);
        } else {
            // Si la mise à jour échoue, envoie un message d'erreur.
            $mes = "l'email n'a pas été modifier";
            $this->action_error($mes);
        }
    } else {
        // Si les données nécessaires ne sont pas présentes dans POST, envoie un message d'erreur.
        $mes = "l'email n'a pas été modifier";
        $this->action_error($mes);
    }
}


    function action_deconnection()
    {
        $_SESSION['connexion'] = false;
        $this->render("authentification");
    }



}