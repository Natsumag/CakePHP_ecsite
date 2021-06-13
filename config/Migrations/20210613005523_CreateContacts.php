<?php
use Migrations\AbstractMigration;

class CreateContacts extends AbstractMigration
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
        $table = $this->table('contacts');
        $table->addColumn('admin_user_id', 'integer', ['limit' => 3, 'null' => true])
            ->addColumn('member_user_id', 'integer')
            ->addColumn('name', 'string', ['limit' => 30], ['null' => true])
            ->addColumn('email', 'string', ['limit' => 200], ['null' => true])
            ->addColumn('content', 'text')
            ->addColumn('reply_states_flag', 'boolean', ['default' => false])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
