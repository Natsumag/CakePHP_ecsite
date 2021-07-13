<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IhCorrespondsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IhCorrespondsTable Test Case
 */
class IhCorrespondsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IhCorrespondsTable
     */
    public $IhCorresponds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.IhCorresponds',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('IhCorresponds') ? [] : ['className' => IhCorrespondsTable::class];
        $this->IhCorresponds = TableRegistry::getTableLocator()->get('IhCorresponds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->IhCorresponds);

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
