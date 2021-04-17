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
        $users->addColumn('user_name', 'string', ['limit' => 30])
              ->addColumn('email', 'string', ['limit' => 200])      
              ->addColumn('password', 'string', ['limit' => 40])
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->addIndex(['user_name', 'email'], ['unique' => true])
              ->save();
    }
    public function down()
    {

    }
}
