<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MesasCandidatostwoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MesasCandidatostwoTable Test Case
 */
class MesasCandidatostwoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MesasCandidatostwoTable
     */
    public $MesasCandidatostwo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MesasCandidatostwo',
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
        $config = TableRegistry::getTableLocator()->exists('MesasCandidatostwo') ? [] : ['className' => MesasCandidatostwoTable::class];
        $this->MesasCandidatostwo = TableRegistry::getTableLocator()->get('MesasCandidatostwo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MesasCandidatostwo);

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
