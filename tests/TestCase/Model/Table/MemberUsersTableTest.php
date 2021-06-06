<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MemberUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MemberUsersTable Test Case
 */
class MemberUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MemberUsersTable
     */
    public $MemberUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MemberUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MemberUsers') ? [] : ['className' => MemberUsersTable::class];
        $this->MemberUsers = TableRegistry::getTableLocator()->get('MemberUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MemberUsers);

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
