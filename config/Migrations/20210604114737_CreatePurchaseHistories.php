<?php
use Migrations\AbstractMigration;

class CreatePurchaseHistories extends AbstractMigration
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
        $table = $this->table('purchase_histories');
        $table->create();
    }


    public function up()
    {
        $table = $this->table('purchase_histories');
        $table->addColumn('member_user_id', 'integer')
            ->addColumn('product_id', 'integer')
            ->addColumn('product_num', 'integer', ['limit' => 2])
            ->addColumn('payment_flag', 'boolean', ['null' => true])
            ->addColumn('purchase_flag', 'boolean', ['null' => true])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();

    }
    public function down()
    {

    }
}
