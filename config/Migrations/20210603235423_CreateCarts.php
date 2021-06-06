<?php
use Migrations\AbstractMigration;

class CreateCarts extends AbstractMigration
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
        $table = $this->table('carts');
        $table->addColumn('member_user_id', 'integer')
            ->addColumn('product_id', 'integer')
            ->addColumn('product_num', 'integer', ['limit' => 2])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
