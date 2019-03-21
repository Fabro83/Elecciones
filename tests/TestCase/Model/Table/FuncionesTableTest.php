<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FuncionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FuncionesTable Test Case
 */
class FuncionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FuncionesTable
     */
    public $Funciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Funciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Funciones') ? [] : ['className' => FuncionesTable::class];
        $this->Funciones = TableRegistry::getTableLocator()->get('Funciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Funciones);

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
