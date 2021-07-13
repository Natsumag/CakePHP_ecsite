<?php
use Migrations\AbstractSeed;

/**
 * Materials seed.
 */
class MaterialsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $datetime = date('Y-m-d H:i:s');
        $data = [
            [
                'material' => 'ダイカストアルミニウム',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material' => 'ダイカストアルミニウム、蓋：ガラス製',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material' => 'ダイカストアルミニウム、蓋：パイレックスガラス',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material' => 'シリコン',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material' => 'ガラス',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
        ];

        $table = $this->table('materials');
        $table->insert($data)->save();
    }
}
