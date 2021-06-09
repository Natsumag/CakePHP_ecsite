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
    public function up()
    {
        $table = $this->table('purchase_histories');
        $table->addColumn('member_user_id', 'integer')
            ->addColumn('total_fee', 'integer', ['limit' => 7])
            ->addColumn('payment_flag', 'boolean', ['default' => false])
            ->addColumn('purchase_flag', 'boolean', ['default' => false])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
