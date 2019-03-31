<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatostwoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatostwoTable Test Case
 */
class CandidatostwoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatostwoTable
     */
    public $Candidatostwo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Candidatostwo',
        'app.Funcions',
        'app.Partidos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Candidatostwo') ? [] : ['className' => CandidatostwoTable::class];
        $this->Candidatostwo = TableRegistry::getTableLocator()->get('Candidatostwo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Candidatostwo);

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
