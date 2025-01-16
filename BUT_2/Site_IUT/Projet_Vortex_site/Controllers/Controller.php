<?php


abstract class Controller
{
    public function __construct()
    {
        if (isset($_GET['action']) && method_exists($this, "action_" . $_GET["action"])) {
            $action = "action_" . $_GET["action"];
            $this->$action();
        } else {
            $this->action_default();
        }
    }

    abstract public function action_default();

    protected function render($vue, $data = [])
    {
        if(!isset($_SESSION['connexion']) or !$_SESSION["connexion"] ) { 
            // Si la session "connexion" n'existe pas OU si elle est fausse, on vérifie si la vue en paramètre est différente de la vue message 

            if($vue != "motDePasseOublier" && $vue != "messageAuthentification") {
                //si la vue en paramètre est différente de la vue message, on affiche la vue authentification 
                include "Views/view_authentification.php";  
                die(); 
            } 
        }
            extract($data);      
            $file_name = "Views/view_" . $vue . '.php';
            if (file_exists($file_name)) {
            //Si oui, on l'affiche
            include $file_name;
            } else {
            //Sinon, on affiche la page d'->action_error
            $this->action_error("La vue n'existe pas !");
            }
        // Pour terminer le script
            die();
    }

    protected function action_error($message = '')
    {
        $data = [
            'title' => "Error",
            'message' => $message,
        ];
        $this->render("message", $data);
    }
}
?>