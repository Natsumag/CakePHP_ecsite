<?php
use Migrations\AbstractSeed;

/**
 * Contacts seed.
 */
class ContactsSeed extends AbstractSeed
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
                'member_user_id' => $faker->numberBetween($min = 1, $max = 5),
                'name' => null,
                'email' => null,
                'contact' => $faker->realText,
                'reply_states_flag' => false,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ];
        }

        $table = $this->table('contacts');
        $table->insert($data)->save();
    }
}
