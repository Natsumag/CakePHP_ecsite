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
            ->addColumn('ih_correspond_id', 'integer', ['limit' => 2])
            ->addColumn('material_id', 'integer', ['limit' => 3])
            ->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('price', 'integer', ['limit' => 7])
            ->addColumn('units_in_stock', 'integer', ['limit' => 4])
            ->addColumn('number_of_units_sold', 'integer', ['limit' => 5])
            ->addColumn('description', 'text')
            ->addColumn('size', 'string', ['limit' => 10])
            ->addColumn('thickness', 'integer', ['limit' => 3, 'null' => true])
            ->addColumn('file_name1', 'text', ['null' => true])
            ->addColumn('file_name2', 'text', ['null' => true])
            ->addColumn('file_name3', 'text', ['null' => true])
            ->addColumn('file_name4', 'text', ['null' => true])
            ->addColumn('file_name5', 'text', ['null' => true])
            ->addColumn('file_name6', 'text', ['null' => true])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
