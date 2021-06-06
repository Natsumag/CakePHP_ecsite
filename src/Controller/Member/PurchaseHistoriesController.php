<?php
namespace App\Controller\Member;

use Cake\Event\Event;

/**
 * AdminUsers Controller
 *
 * @property \App\Model\Table\PurchaseHistoriesTable $PurchaseHistories
 *
 * @method \App\Model\Entity\PurchaseHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseHistoriesController extends AppController
{
    public function index()
    {
        $purchaseHistories = $this->paginate($this->PurchaseHistories);

        $this->set(compact('purchaseHistories'));
    }

    public function add()
    {
        $product_num = $this->request->getData();
        debug($product_num);
        exit();

        $purchaseHistories = $this->PurchaseHistories->newEntity();
        if ($this->request->is('post')) {
            $memberUser = $this->MemberUsers->patchEntity($memberUser, $this->request->getData());
            if ($this->MemberUsers->save($memberUser)) {
                $this->Flash->success(__('Saved'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('not Saved'));
        }
        $this->set(compact('memberUser'));
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
