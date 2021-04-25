<?php
use Migrations\AbstractMigration;

class CreateIhCorresponds extends AbstractMigration
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
        $users = $this->table('ih_corresponds');
        $users->addColumn('type', 'text')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
