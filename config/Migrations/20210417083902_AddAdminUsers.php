<?php
use Migrations\AbstractMigration;

class AddAdminUsers extends AbstractMigration
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
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 40,
        ]);
        $table->update();
    }
}
