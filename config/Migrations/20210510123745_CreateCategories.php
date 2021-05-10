<?php
use Migrations\AbstractMigration;

class CreateCategories extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $users = $this->table('categories');
        $users->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('description', 'text')
            ->addColumn('file_name1', 'text')
            ->addColumn('file_name2', 'text')
            ->addColumn('file_name3', 'text')
            ->addColumn('file_name4', 'text')
            ->addColumn('file_name5', 'text')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
