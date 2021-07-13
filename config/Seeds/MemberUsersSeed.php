<?php

use Cake\Auth\DefaultPasswordHasher;
use Migrations\AbstractSeed;

/**
 * MemberUsers seed.
 */
class MemberUsersSeed extends AbstractSeed
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
                'name' => $faker->name,
                'email' => 'aaa'.$i.'@test.com',
                'password' => $this->_setPassword('password'),
                'zip_code' => $faker->postcode,
                'address' => $faker->address,
                'tel' => $faker->phoneNumber,
                'delete_flag' => false,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ];
        }

        $table = $this->table('member_users');
        $table->insert($data)->save();
    }

    protected function _setPassword($password) {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
