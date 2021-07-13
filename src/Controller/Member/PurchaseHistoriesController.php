<?php
namespace App\Controller\Member;

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
        $this->loadModel('PurchaseHistoryDetails');
        $this->loadModel('Carts');
        $this->loadModel('Products');
    }

    public function index()
    {
        $login_id = $this->Auth->user('id');
        $purchase_histories = $this->PurchaseHistories->find('MemberPurchaseHistoryIndex', [
            'login_id' => $login_id
        ]);
        $this->set(compact('purchase_histories'));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $product_num = $this->request->getData();

            // 「purchase_histories」に入れるデータ
            $total_fee = array_shift($product_num);
            $login_user = $this->Auth->user();
            if ($login_user['id']) {
                $data = array(
                    'total_fee' => $total_fee,
                    'member_user_id' => $login_user['id']
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
                    ->setTo($login_user['email'])
                    ->setSubject('ご購入ありがとうございます')
                    ->viewBuilder()
                        ->setTemplate('purchase_thanks')
                        ->setVar('total_fee', $total_fee)
                        ->setVar('username', $login_user['name'])
                ;

                // カートのデータ削除　$login_idに一致するものをすべて物理削除
                $delete_data = $this->Carts->find('all');
                if ($this->Carts->deleteAll(['member_user_id' => $login_user['id']])) {
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
}
