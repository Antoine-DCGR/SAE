
<?php
use PHPUnit\Framework\TestCase;

require 'Controller_authentification.php';

class ControllerAuthentificationTest extends TestCase
{

    public function testaction_authentification()
    {
        // Vérifie si la méthode action_authentification existe et peut être appelée
        $controller = new Controller_authentification();
        $this->assertTrue(method_exists($controller, 'action_authentification'));
    }
    
    public function testaction_connexion()
    {
        // Vérifie si la méthode action_connexion existe et peut être appelée
        $controller = new Controller_authentification();
        $this->assertTrue(method_exists($controller, 'action_connexion'));
    }
    
    public function testaction_mdpOublier()
    {
        // Vérifie si la méthode action_mdpOublier existe et peut être appelée
        $controller = new Controller_authentification();
        $this->assertTrue(method_exists($controller, 'action_mdpOublier'));
    }
    
    public function testaction_udatEmail()
    {
        // Vérifie si la méthode action_udatEmail existe et peut être appelée
        $controller = new Controller_authentification();
        $this->assertTrue(method_exists($controller, 'action_udatEmail'));
    }
    
    public function testaction_deconnection()
    {
        // Vérifie si la méthode action_deconnection existe et peut être appelée
        $controller = new Controller_authentification();
        $this->assertTrue(method_exists($controller, 'action_deconnection'));
    }

}
