<?php
use Migrations\AbstractMigration;

class CreateAdminUsers extends AbstractMigration
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
        $users = $this->table('admin_users');
        $users->addColumn('name', 'string', ['limit' => 30])
            ->addColumn('email', 'string', ['limit' => 200])
            ->addColumn('password', 'string', ['limit' => 400])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('delete_flag', 'boolean', ['default' => false])
            ->addIndex(['name', 'email'], ['unique' => true])
            ->save();
    }
    public function down()
    {

    }
}
