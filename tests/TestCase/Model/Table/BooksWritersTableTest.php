<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BooksWritersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BooksWritersTable Test Case
 */
class BooksWritersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BooksWritersTable
     */
    public $BooksWriters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.books_writers',
        'app.books',
        'app.categories',
        'app.comments',
        'app.writers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BooksWriters') ? [] : ['className' => 'App\Model\Table\BooksWritersTable'];
        $this->BooksWriters = TableRegistry::get('BooksWriters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BooksWriters);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
