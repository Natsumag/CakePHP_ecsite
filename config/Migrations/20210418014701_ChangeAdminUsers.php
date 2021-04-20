<?php
use Migrations\AbstractMigration;

class ChangeAdminUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('admin_users');
        $table->addColumn('email', 'string', ['limit' => 200])
            ->addColumn('password', 'string', ['limit' => 400])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['user_name', 'email'], ['unique' => true])
            ->addColumn('username', 'string', ['limit' => 40]);
        $table->update();
    }
}
