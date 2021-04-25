<?php
use Migrations\AbstractMigration;

class CreateProductCategories extends AbstractMigration
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
        $users = $this->table('product_categories');
        $users->addColumn('name', 'text')
            ->addColumn('description', 'text')
            ->addColumn('filename', 'text')
            ->addColumn('filetype', 'text')
            ->addColumn('filepath', 'text')
            ->addColumn('filesize', 'integer', ['limit' => 11])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }
    public function down()
    {

    }
}
