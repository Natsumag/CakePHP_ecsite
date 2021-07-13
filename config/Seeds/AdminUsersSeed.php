<?php

use Cake\Auth\DefaultPasswordHasher;
use Migrations\AbstractSeed;

/**
 * AdminUsers seed.
 */
class AdminUsersSeed extends AbstractSeed
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
                'name' => 'test01',
                'email' => 'test01@test.com',
                'password' => $this->_setPassword('password'),
                'delete_flag' => false,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'name' => 'test02',
                'email' => 'test02@test.com',
                'password' => $this->_setPassword('password'),
                'delete_flag' => false,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'name' => 'test03',
                'email' => 'test03@test.com',
                'password' => $this->_setPassword('password'),
                'delete_flag' => true,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
        ];

        $table = $this->table('admin_users');
        $table->insert($data)->save();
    }

    /**
     * ハッシュ化されたパスワードを返却する
     * @param $value
     * @return bool|string
     */
    protected function _setPassword($password) {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
