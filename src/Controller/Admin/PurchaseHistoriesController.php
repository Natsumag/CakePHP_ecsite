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
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $purchaseHistories = $this->paginate($this->PurchaseHistories->find('PurchaseHistoryIndex'));
        $this->set(compact('purchaseHistories'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase History id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('PurchaseHistoryDetails');
        $related_purchase_history_details = $this->PurchaseHistoryDetails->find('RelatedPurchaseHistoryDetailIndex', [
            'id' => $id
        ]);
        $purchaseHistory = $this->PurchaseHistories->find('PurchaseHistoryView', [
            'id' => $id
        ]);
        $this->set(compact('related_purchase_history_details'));
        $this->set(compact('purchaseHistory'));
    }
}
