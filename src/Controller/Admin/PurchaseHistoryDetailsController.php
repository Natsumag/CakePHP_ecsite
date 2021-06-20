<?php
namespace App\Controller\Admin;

use Cake\Event\Event;
/**
 * AdminUsers Controller
 *
 * @property \App\Model\Table\PurchaseHistoryDetailsTable $PurchaseHistoryDetails
 * @property \App\Model\Table\PurchaseHistoriesTable $PurchaseHistories
 *
 * @method \App\Model\Entity\PurchaseHistoryDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseHistoryDetailsController extends AppController
{
    /**
     * @var bool|object
     */
    public function initialize()
    {
        parent::initialize();
//        $this->loadModel('PurchaseHistoryDetails');
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'PurchaseHistories'],
        ];
        $purchaseHistoryDetails = $this->paginate($this->PurchaseHistoryDetails);
        $this->set(compact('purchaseHistoryDetails'));
    }

    public function isAuthorized($user = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add','index']);
    }
}
