<?php
use Migrations\AbstractMigration;

class CreateMemberUsers extends AbstractMigration
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
        $users = $this->table('member_users');
        $users->addColumn('name', 'string', ['limit' => 30])
            ->addColumn('email', 'string', ['limit' => 200])
            ->addColumn('password', 'string', ['limit' => 400])
            ->addColumn('zip_code', 'integer', ['limit' => 8])
            ->addColumn('address', 'string', ['limit' => 200])
            ->addColumn('tel', 'string', ['limit' => 21])
            ->addColumn('delete_flag', 'boolean', ['default' => false])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
