<?php
namespace App\Controller\Member;

//use App\Controller\Member\PurchaseHistoriesController;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * AdminUsers Controller
 *
 * @property \App\Model\Table\PurchaseHistoriesTable $PurchaseHistories
 * @property \App\Model\Table\PurchaseHistoryDetailsTable $PurchaseHistoryDetails
 * @property \App\Model\Table\CartsTable $Carts
 *
 * @method \App\Model\Entity\PurchaseHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseHistoriesController extends AppController
{
    /**
     * @var bool|object
     */
    public function initialize() {
        parent::initialize();
        // モデルの読み込み
        $this->loadModel('PurchaseHistories');
        $this->loadModel('PurchaseHistoryDetails');
        $this->loadModel('Carts');
        $this->loadModel('Products');
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['MemberUsers'],
        ];
        // members_user_idが$login_idと一致するもののみ表示
        $login_id = $this->Auth->user('id');
        $only_my_purchase_histories = $this->PurchaseHistories->find()->where(['member_user_id' => $login_id]);
        $purchaseHistories = $this->paginate($only_my_purchase_histories);

        $this->set(compact('purchaseHistories'));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $product_num = $this->request->getData();

            // 「purchase_histories」に入れるデータ
            $total_fee = array_shift($product_num);
            $login_id = $this->Auth->user('id');
            if ($login_id) {
                $data = array(
                    'total_fee' => $total_fee,
                    'member_user_id' => $login_id
                );
                $purchaseHistories = $this->PurchaseHistories->newEntity($data);
                $this->PurchaseHistories->save($purchaseHistories);

                // 上の処理で保存した「PurchaseHistories」テーブルのレコードのidを取得
                $result = $this->PurchaseHistories->find()->last();
                $result_id = $result['id'];

                $count = count($product_num) / 2;
                $hoge = array();
                for ($i = 1; $i <= $count; $i++) {
                    // 「purchase_history_details」に入れるデータ
                    $product_id = array_shift($product_num);
                    $product_number = array_shift($product_num);
                    $data_detail = array(
                        'product_id' => $product_id,
                        'product_num' => $product_number,
                        'purchase_history_id' => $result_id
                    );
                    $purchaseHistoryDetails = $this->PurchaseHistoryDetails->newEntity($data_detail);
                    $this->PurchaseHistoryDetails->save($purchaseHistoryDetails);
                    // 配列に入れ直す（メールのため）、idからnameとpriceを取得する
                    array_push($hoge, $product_id, $product_number);
                }

                // メール送信
                $email = new Email('default');
                $email->setFrom(['cakephp0906@gmail.com' => 'PHP Cake'])
                    ->setTo('ntmg0906@gmail.com')
                    ->setSubject('ご購入ありがとうございます')
                    ->viewVars([
                        // 合計金額、商品名、
                        'total_fee'=>$total_fee,
                    ])
                    ->send('My message');


                // カートのデータ削除　$login_idに一致するものをすべて物理削除
                $delete_data = $this->Carts->find('all');
                if ($this->Carts->deleteAll(['member_user_id' => $login_id])) {
                    $this->Flash->success(__('購入しました。'));
                } else {
                    $this->Flash->error(__('The carts could not be deleted. Please, try again.'));
                }

                // 購入しましたページに飛ばす　コントローラをadmin配下に移動する。
                return $this->redirect(['action' => 'thanks']);
            }
        }
        $this->Flash->error(__('not Saved'));
        return $this->redirect(['controller' => '../Member/Carts', 'action' => 'index']);
    }

    public function thanks()
    {
        $login_username = $this->Auth->user('name');
        $this->set(compact('login_username'));
    }



    public function isAuthorized($categories = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add','index']);
    }
}
