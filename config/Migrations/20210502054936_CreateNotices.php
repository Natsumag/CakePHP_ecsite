<?php
use Migrations\AbstractMigration;

class CreateNotices extends AbstractMigration
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
        $table = $this->table('notices');
        $table->addColumn('admin_user_id', 'integer', ['limit' => 2])
            ->addColumn('event_date', 'datetime', ['null' => true])
            ->addColumn('content', 'text')
            ->addColumn('detail', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();

    }

    public function down()
    {

    }
}
