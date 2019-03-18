<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatosTable Test Case
 */
class CandidatosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatosTable
     */
    public $Candidatos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Candidatos') ? [] : ['className' => CandidatosTable::class];
        $this->Candidatos = TableRegistry::getTableLocator()->get('Candidatos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Candidatos);

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
}
