<?php
use Migrations\AbstractSeed;

/**
 * PurchaseHistories seed.
 */
class PurchaseHistoriesSeed extends AbstractSeed
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
        // fakerインスタンスを生成する
        $faker = Faker\Factory::create('ja_JP');

        // ダミーデータ生成
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'member_user_id' => $faker->numberBetween($min = 1, $max = 10),
                'total_fee' => $faker->numberBetween($min = 3000, $max = 30000),
                'payment_flag' => false,
                'sending_flag' => false,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ];
        }

        $table = $this->table('purchase_histories');
        $table->insert($data)->save();
    }
}
