<?php
use Migrations\AbstractSeed;

/**
 * Notices seed.
 */
class NoticesSeed extends AbstractSeed
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
                'admin_user_id' => $faker->numberBetween($min = 1, $max = 3),
                'event_date' => $datetime,
                'content' => $faker->realText,
                'detail' => $faker->domainName,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ];
        }

        $table = $this->table('notices');
        $table->insert($data)->save();
    }
}
