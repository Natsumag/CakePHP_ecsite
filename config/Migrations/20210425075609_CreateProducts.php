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
            ->addColumn('name', 'text')
            ->addColumn('price', 'integer', ['limit' => 7])
            ->addColumn('units_in_stock', 'integer', ['limit' => 4])
            ->addColumn('number_of_units_sold', 'integer', ['limit' => 5])
            ->addColumn('description', 'text')
            ->addColumn('size', 'integer', ['limit' => 4])
            ->addColumn('thickness', 'integer', ['limit' => 3, 'null' => true])
            ->addColumn('file_name', 'text')
            ->addColumn('file_type', 'text')
            ->addColumn('file_path', 'text')
            ->addColumn('file_size', 'integer', ['limit' => 11])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
