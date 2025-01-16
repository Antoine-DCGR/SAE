
<?php
use PHPUnit\Framework\TestCase;

require 'Controller_affichage.php';

class ControllerAffichageTest extends TestCase
{

    public function testaction_profil()
    {
        // Vérifie si la méthode action_profil existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_profil'));
    }
    
    public function testaction_listePersonne()
    {
        // Vérifie si la méthode action_listePersonne existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_listePersonne'));
    }
    
    public function testaction_choix()
    {
        // Vérifie si la méthode action_choix existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_choix'));
    }
    
    public function testaction_listeDepartement()
    {
        // Vérifie si la méthode action_listeDepartement existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_listeDepartement'));
    }
    
    public function testaction_tableDeBord()
    {
        // Vérifie si la méthode action_tableDeBord existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_tableDeBord'));
    }
    
    public function testaction_formModification()
    {
        // Vérifie si la méthode action_formModification existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_formModification'));
    }
    
    public function testaction_infoDepartement()
    {
        // Vérifie si la méthode action_infoDepartement existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_infoDepartement'));
    }
    
    public function testaction_choixFormation()
    {
        // Vérifie si la méthode action_choixFormation existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_choixFormation'));
    }
    
    public function testaction_listeBesoins()
    {
        // Vérifie si la méthode action_listeBesoins existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_listeBesoins'));
    }
    
    public function testaction_formModificationBesoins()
    {
        // Vérifie si la méthode action_formModificationBesoins existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_formModificationBesoins'));
    }
    
    public function testaction_modifierBesoin()
    {
        // Vérifie si la méthode action_modifierBesoin existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_modifierBesoin'));
    }
    
    public function testaction_monDepartement()
    {
        // Vérifie si la méthode action_monDepartement existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_monDepartement'));
    }
    
    public function testaction_afficherLogs()
    {
        // Vérifie si la méthode action_afficherLogs existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_afficherLogs'));
    }
    
    public function testaction_listeEns()
    {
        // Vérifie si la méthode action_listeEns existe et peut être appelée
        $controller = new Controller_affichage();
        $this->assertTrue(method_exists($controller, 'action_listeEns'));
    }
}
