
<?php
use PHPUnit\Framework\TestCase;

require 'Model.php';

// Classe de test pour Model
class ModelTest extends TestCase
{
    private $model;

    // Méthode appelée avant chaque test
    protected function setUp(): void
    {
        // Initialisation du modèle
        $this->model = new Model();
    }

    // Teste si la méthode getNbPersonne existe et peut être appelée
    public function testgetNbPersonne()
    {
        $this->assertTrue(method_exists($this->model, 'getNbPersonne'));
    }

    // Teste si la méthode idExiste existe et peut être appelée
    public function testidExiste()
    {
        $this->assertTrue(method_exists($this->model, 'idExiste'));
    }

    // Teste si la méthode getCategories existe et peut être appelée
    public function testgetCategories()
    {
        $this->assertTrue(method_exists($this->model, 'getCategories'));
    }

    // Teste si la méthode getEnseignantById existe et peut être appelée
    public function testgetEnseignantById()
    {
        $this->assertTrue(method_exists($this->model, 'getEnseignantById'));
    }

    // Teste si la méthode getSemestre existe et peut être appelée
    public function testgetSemestre()
    {
        $this->assertTrue(method_exists($this->model, 'getSemestre'));
    }

    // Teste si la méthode getDiscipline existe et peut être appelée
    public function testgetDiscipline()
    {
        $this->assertTrue(method_exists($this->model, 'getDiscipline'));
    }

    // Teste si la méthode getFormation existe et peut être appelée
    public function testgetFormation()
    {
        $this->assertTrue(method_exists($this->model, 'getFormation'));
    }

    // Teste si la méthode getDiplome existe et peut être appelée
    public function testgetDiplome()
    {
        $this->assertTrue(method_exists($this->model, 'getDiplome'));
    }

    // Teste si la méthode getNiveau existe et peut être appelée
    public function testgetNiveau()
    {
        $this->assertTrue(method_exists($this->model, 'getNiveau'));
    }

    // Teste si la méthode getEnseignant existe et peut être appelée
    public function testgetEnseignant()
    {
        $this->assertTrue(method_exists($this->model, 'getEnseignant'));
    }

    // Teste si la méthode getDepartement existe et peut être appelée
    public function testgetDepartement()
    {
        $this->assertTrue(method_exists($this->model, 'getDepartement'));
    }

    // Teste si la méthode getFormationIdsByNomAndNiveau existe et peut être appelée
    public function testgetFormationIdsByNomAndNiveau()
    {
        $this->assertTrue(method_exists($this->model, 'getFormationIdsByNomAndNiveau'));
    }

    // Teste si la méthode getBesoinsByIdFormationDepartementAnneeSemestre existe et peut être appelée
    public function testgetBesoinsByIdFormationDepartementAnneeSemestre()
    {
        $this->assertTrue(method_exists($this->model, 'getBesoinsByIdFormationDepartementAnneeSemestre'));
    }

    // Teste si la méthode getDepartementById existe et peut être appelée
    public function testgetDepartementById()
    {
        $this->assertTrue(method_exists($this->model, 'getDepartementById'));
    }

    // Teste si la méthode getBesoinByIds existe et peut être appelée
    public function testgetBesoinByIds()
    {
        $this->assertTrue(method_exists($this->model, 'getBesoinByIds'));
    }

    // Teste si la méthode getDerniereAnnee existe et peut être appelée
    public function testgetDerniereAnnee()
    {
        $this->assertTrue(method_exists($this->model, 'getDerniereAnnee'));
    }

    // Teste si la méthode getPersonneParId existe et peut être appelée
    public function testgetPersonneParId()
    {
        $this->assertTrue(method_exists($this->model, 'getPersonneParId'));
    }

    // Teste si la méthode getRoleById existe et peut être appelée
    public function testgetRoleById()
    {
        $this->assertTrue(method_exists($this->model, 'getRoleById'));
    }

    // Teste si la méthode getAllRolesById existe et peut être appelée
    public function testgetAllRolesById()
    {
        $this->assertTrue(method_exists($this->model, 'getAllRolesById'));
    }

    // Teste si la méthode getDepartementByPersonId existe et peut être appelée
    public function testgetDepartementByPersonId()
    {
        $this->assertTrue(method_exists($this->model, 'getDepartementByPersonId'));
    }

    // Teste si la méthode getDepartementInfos existe et peut être appelée
    public function testgetDepartementInfos()
    {
        $this->assertTrue(method_exists($this->model, 'getDepartementInfos'));
    }

    // Teste si la méthode getDepartementInfosChef existe et peut être appelée
    public function testgetDepartementInfosChef()
    {
        $this->assertTrue(method_exists($this->model, 'getDepartementInfosChef'));
    }

    // Teste si la méthode getFormationById existe et peut être appelée
    public function testgetFormationById()
    {
        $this->assertTrue(method_exists($this->model, 'getFormationById'));
    }

    // Teste si la méthode getDisciplineById existe et peut être appelée
    public function testgetDisciplineById()
    {
        $this->assertTrue(method_exists($this->model, 'getDisciplineById'));
    }

    // Teste si la méthode getAllPersonsWithRolesWithLimit existe et peut être appelée
    public function testgetAllPersonsWithRolesWithLimit()
    {
        $this->assertTrue(method_exists($this->model, 'getAllPersonsWithRolesWithLimit'));
    }

    // Teste si la méthode getIdDepartementParSigle existe et peut être appelée
    public function testgetIdDepartementParSigle()
    {
        $this->assertTrue(method_exists($this->model, 'getIdDepartementParSigle'));
    }

    // Teste si la méthode getAllDepartementInfos existe et peut être appelée
    public function testgetAllDepartementInfos()
    {
        $this->assertTrue(method_exists($this->model, 'getAllDepartementInfos'));
    }

    // Teste si la méthode getEmail existe et peut être appelée
    public function testgetEmail()
    {
        $this->assertTrue(method_exists($this->model, 'getEmail'));
    }

    // Teste si la méthode getAllLogs existe et peut être appelée
    public function testgetAllLogs()
    {
        $this->assertTrue(method_exists($this->model, 'getAllLogs'));
    }

    // Teste si la méthode getEnseignantsAssignesAuDepartement existe et peut être appelée
    public function testgetEnseignantsAssignesAuDepartement()
    {
        $this->assertTrue(method_exists($this->model, 'getEnseignantsAssignesAuDepartement'));
    }

    // Teste si la méthode getDisciplineHoursDepartmentStatistics existe et peut être appelée
    public function testgetDisciplineHoursDepartmentStatistics()
    {
        $this->assertTrue(method_exists($this->model, 'getDisciplineHoursDepartmentStatistics'));
    }

    // Teste si la méthode getServiceStatistics existe et peut être appelée
    public function testgetServiceStatistics()
    {
        $this->assertTrue(method_exists($this->model, 'getServiceStatistics'));
    }

    // Teste si la méthode getServiceStatisticsById existe et peut être appelée
    public function testgetServiceStatisticsById()
    {
        $this->assertTrue(method_exists($this->model, 'getServiceStatisticsById'));
    }

    // Teste si la méthode getTeachersStatistics existe et peut être appelée
    public function testgetTeachersStatistics()
    {
        $this->assertTrue(method_exists($this->model, 'getTeachersStatistics'));
    }

    // Teste si la méthode getTeachersStatisticsIUT existe et peut être appelée
    public function testgetTeachersStatisticsIUT()
    {
        $this->assertTrue(method_exists($this->model, 'getTeachersStatisticsIUT'));
    }

    // Teste si la méthode getPersonCategoryStatistics existe et peut être appelée
    public function testgetPersonCategoryStatistics()
    {
        $this->assertTrue(method_exists($this->model, 'getPersonCategoryStatistics'));
    }

    // Teste si la méthode estChefDepartement existe et peut être appelée
    public function testestChefDepartement()
    {
        $this->assertTrue(method_exists($this->model, 'estChefDepartement'));
    }

    // Teste si la méthode updateBesoin existe et peut être appelée
    public function testupdateBesoin()
    {
        $this->assertTrue(method_exists($this->model, 'updateBesoin'));
    }

    // Teste si la méthode updateChefDepartement existe et peut être appelée
    public function testupdateChefDepartement()
    {
        $this->assertTrue(method_exists($this->model, 'updateChefDepartement'));
    }

    // Teste si la méthode updatePersonne existe et peut être appelée
    public function testupdatePersonne()
    {
        $this->assertTrue(method_exists($this->model, 'updatePersonne'));
    }

    // Teste si la méthode updateCatEnseignant existe et peut être appelée
    public function testupdateCatEnseignant()
    {
        $this->assertTrue(method_exists($this->model, 'updateCatEnseignant'));
    }

    // Teste si la méthode searchUserByName existe et peut être appelée
    public function testsearchUserByName()
    {
        $this->assertTrue(method_exists($this->model, 'searchUserByName'));
    }

    // Teste si la méthode updateEmail existe et peut être appelée
    public function testupdateEmail()
    {
        $this->assertTrue(method_exists($this->model, 'updateEmail'));
    }

    // Teste si la méthode updateMotDePasse existe et peut être appelée
    public function testupdateMotDePasse()
    {
        $this->assertTrue(method_exists($this->model, 'updateMotDePasse'));
    }

    // Teste si la méthode addPersonne existe et peut être appelée
    public function testaddPersonne()
    {
        $this->assertTrue(method_exists($this->model, 'addPersonne'));
    }

    // Teste si la méthode addSecretaire existe et peut être appelée
    public function testaddSecretaire()
    {
        $this->assertTrue(method_exists($this->model, 'addSecretaire'));
    }

    // Teste si la méthode addEnseignant existe et peut être appelée
    public function testaddEnseignant()
    {
        $this->assertTrue(method_exists($this->model, 'addEnseignant'));
    }

    // Teste si la méthode addEnseignantDetails existe et peut être appelée
    public function testaddEnseignantDetails()
    {
        $this->assertTrue(method_exists($this->model, 'addEnseignantDetails'));
    }

    // Teste si la méthode addEquipeDirection existe et peut être appelée
    public function testaddEquipeDirection()
    {
        $this->assertTrue(method_exists($this->model, 'addEquipeDirection'));
    }

    // Teste si la méthode removeEquipeDeDirection existe et peut être appelée
    public function testremoveEquipeDeDirection()
    {
        $this->assertTrue(method_exists($this->model, 'removeEquipeDeDirection'));
    }

    // Teste si la méthode removePersonne existe et peut être appelée
    public function testremovePersonne()
    {
        $this->assertTrue(method_exists($this->model, 'removePersonne'));
    }

    // Teste si la méthode removeEnseignant existe et peut être appelée
    public function testremoveEnseignant()
    {
        $this->assertTrue(method_exists($this->model, 'removeEnseignant'));
    }

    // Teste si la méthode removeAssigner existe et peut être appelée
    public function testremoveAssigner()
    {
        $this->assertTrue(method_exists($this->model, 'removeAssigner'));
    }

    // Teste si la méthode removeSecretaire existe et peut être appelée
    public function testremoveSecretaire()
    {
        $this->assertTrue(method_exists($this->model, 'removeSecretaire'));
    }

    // Teste si la méthode removeEquipeDirection existe et peut être appelée
    public function testremoveEquipeDirection()
    {
        $this->assertTrue(method_exists($this->model, 'removeEquipeDirection'));
    }

    // Teste si la méthode removeEnseigne existe et peut être appelée
    public function testremoveEnseigne()
    {
        $this->assertTrue(method_exists($this->model, 'removeEnseigne'));
    }

    // Teste si la méthode removeAllEnseignantInfos existe et peut être appelée
    public function testremoveAllEnseignantInfos()
    {
        $this->assertTrue(method_exists($this->model, 'removeAllEnseignantInfos'));
    }

    // Teste si la méthode secretaireExisteDansDepartement existe et peut être appelée
    public function testsecretaireExisteDansDepartement()
    {
        $this->assertTrue(method_exists($this->model, 'secretaireExisteDansDepartement'));
    }

    // Teste si la méthode enseigneMatiere existe et peut être appelée
    public function testenseigneMatiere()
    {
        $this->assertTrue(method_exists($this->model, 'enseigneMatiere'));
    }

    // Teste si la méthode assignerEnseignantAuDepartement existe et peut être appelée
    public function testassignerEnseignantAuDepartement()
    {
        $this->assertTrue(method_exists($this->model, 'assignerEnseignantAuDepartement'));
    }

    // Teste si la méthode insertLog existe et peut être appelée
    public function testinsertLog()
    {
        $this->assertTrue(method_exists($this->model, 'insertLog'));
    }

}
