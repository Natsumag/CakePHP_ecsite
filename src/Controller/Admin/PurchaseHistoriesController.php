<?php
namespace App\Controller\Admin;

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
    }

    public function index()
    {
        $this->paginate = ['contain' => ['MemberUsers'],];
        $purchaseHistories = $this->paginate($this->PurchaseHistories);
        $this->set(compact('purchaseHistories'));
    }
}
