<?php
use Migrations\AbstractSeed;

/**
 * Categories seed.
 */
class CategoriesSeed extends AbstractSeed
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
                'material_id' => 2,
                'ih_correspond_id' => 2,
                'name' => 'フライパン',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。ガス火専用商品です。',
                'file_name1' => 'sample1_1.jpeg',
                'file_name2' => 'sample1_2.jpeg',
                'file_name3' => 'sample1_3.jpeg',
                'file_name4' => 'sample1_4.jpeg',
                'file_name5' => 'sample1_5.jpeg',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 1,
                'name' => 'フライパン（IH対応）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。ガス火/IH　どちらにも利用いただけます。',
                'file_name1' => 'sample2_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 2,
                'name' => 'ディープパン（深型フライパン）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火専用商品です。',
                'file_name1' => 'sample3_1.jpeg',
                'file_name2' => 'sample3_2.jpeg',
                'file_name3' => 'sample3_3.jpeg',
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 1,
                'name' => 'ディープパン（深型フライパン、IH対応）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火/IH　どちらにも利用いただけます。',
                'file_name1' => 'sample4_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 2,
                'name' => 'シチューポット（深型両手鍋）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火専用商品です。',
                'file_name1' => 'sample5_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 1,
                'name' => 'シチューポット（深型両手鍋、IH対応）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火/IH　どちらにも利用いただけます。',
                'file_name1' => 'sample6_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 2,
                'name' => 'シチューパン（浅型両手鍋）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火専用商品です。',
                'file_name1' => 'sample7_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 1,
                'name' => 'シチューパン（浅型両手鍋、IH対応）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火/IH　どちらにも利用いただけます。',
                'file_name1' => 'sample8_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 1,
                'ih_correspond_id' => 2,
                'name' => 'グリル',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。ガス火専用商品です。',
                'file_name1' => 'sample9_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 1,
                'ih_correspond_id' => 1,
                'name' => 'グリル（IH対応）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。ガス火/IH　どちらにも利用いただけます',
                'file_name1' => 'sample10_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 2,
                'name' => 'ソースポット（片手鍋）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火専用商品です。',
                'file_name1' => 'sample11_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 2,
                'ih_correspond_id' => 1,
                'name' => 'ソースポット（片手鍋、IH対応）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火/IH　どちらにも利用いただけます。',
                'file_name1' => 'sample12_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 1,
                'ih_correspond_id' => 2,
                'name' => 'プレートグリル',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。ガス火専用商品です。',
                'file_name1' => 'sample13_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 3,
                'ih_correspond_id' => 2,
                'name' => 'オーバルローストパン（楕円形深型鍋）',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。蓋つき。ガス火専用商品です。',
                'file_name1' => 'sample14_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 1,
                'ih_correspond_id' => 2,
                'name' => 'エッグ＆スイート',
                'description' => '100％イタリア製　長持ちするノンスティックコーティングでお手入れがとても簡単です。アルミ製で、作られているため軽くて、熱の伝わりもよく調理時間も短く短縮できます。ガス火専用商品です。',
                'file_name1' => 'sample15_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 4,
                'ih_correspond_id' => 4,
                'name' => 'プロテクター',
                'description' => '100％イタリア製品　鍋やフライパンを置く台としてはもちろん、鍋を重ねて保管する際にも、製品そものに傷をつけずに保管することができます。',
                'file_name1' => 'sample16_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'material_id' => 5,
                'ih_correspond_id' => 4,
                'name' => 'ガラス蓋',
                'description' => '100％イタリア製品　丈夫で熱を逃がさない構造です。取手はシリコンで傷みにくい商品です。',
                'file_name1' => 'sample17_1.jpeg',
                'file_name2' => null,
                'file_name3' => null,
                'file_name4' => null,
                'file_name5' => null,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
        ];

        $table = $this->table('categories');
        $table->insert($data)->save();
    }
}
