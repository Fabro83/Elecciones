<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartidosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartidosTable Test Case
 */
class PartidosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PartidosTable
     */
    public $Partidos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Partidos',
        'app.Candidatos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Partidos') ? [] : ['className' => PartidosTable::class];
        $this->Partidos = TableRegistry::getTableLocator()->get('Partidos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Partidos);

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
