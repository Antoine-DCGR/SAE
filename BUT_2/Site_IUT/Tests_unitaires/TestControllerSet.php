
<?php
use PHPUnit\Framework\TestCase;

require 'Controller_set.php';

// Classe de test pour Controller_set
class ControllerSetTest extends TestCase
{

    // Teste si la méthode action_default existe et peut être appelée
    public function testaction_default()
    {
        $controller = new Controller_set();
        $this->assertTrue(method_exists($controller, 'action_default'));
    }

    // Teste si la méthode action_ajout existe et peut être appelée
    public function testaction_ajout()
    {
        $controller = new Controller_set();
        $this->assertTrue(method_exists($controller, 'action_ajout'));
    }

    // Teste si la méthode action_ajouterPersonne existe et peut être appelée
    public function testaction_ajouterPersonne()
    {
        $controller = new Controller_set();
        $this->assertTrue(method_exists($controller, 'action_ajouterPersonne'));
    }

    // Teste si la méthode action_retirerPersonne existe et peut être appelée
    public function testaction_retirerPersonne()
    {
        $controller = new Controller_set();
        $this->assertTrue(method_exists($controller, 'action_retirerPersonne'));
    }

    // Teste si la méthode action_modifier existe et peut être appelée
    public function testaction_modifier()
    {
        $controller = new Controller_set();
        $this->assertTrue(method_exists($controller, 'action_modifier'));
    }

    // Teste si la méthode action_modifierBesoin existe et peut être appelée
    public function testaction_modifierBesoin()
    {
        $controller = new Controller_set();
        $this->assertTrue(method_exists($controller, 'action_modifierBesoin'));
    }

    // Teste si la méthode action_modifierChefDep existe et peut être appelée
    public function testaction_modifierChefDep()
    {
        $controller = new Controller_set();
        $this->assertTrue(method_exists($controller, 'action_modifierChefDep'));
    }

}
