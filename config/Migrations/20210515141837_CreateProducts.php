<?php
use Migrations\AbstractMigration;

class CreateProducts extends AbstractMigration
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
        $users = $this->table('products');
        $users->addColumn('category_id', 'integer', ['limit' => 3])
            ->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('price', 'integer', ['limit' => 7])
            ->addColumn('units_in_stock', 'integer', ['limit' => 4])
            ->addColumn('number_of_units_sold', 'integer', ['limit' => 5])
            ->addColumn('size_circle', 'string', ['limit' => 5, 'null' => true])
            ->addColumn('size_rectangle', 'string', ['limit' => 10, 'null' => true])
            ->addColumn('thickness', 'integer', ['limit' => 3, 'null' => true])
            ->addColumn('height', 'integer', ['limit' => 5, 'null' => true])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
