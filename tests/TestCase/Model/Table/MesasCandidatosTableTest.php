<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MesasCandidatosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MesasCandidatosTable Test Case
 */
class MesasCandidatosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MesasCandidatosTable
     */
    public $MesasCandidatos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MesasCandidatos',
        'app.Candidatos',
        'app.Mesas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MesasCandidatos') ? [] : ['className' => MesasCandidatosTable::class];
        $this->MesasCandidatos = TableRegistry::getTableLocator()->get('MesasCandidatos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MesasCandidatos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
