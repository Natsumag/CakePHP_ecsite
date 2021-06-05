<?php
namespace App\Controller\Member;

use Cake\Event\Event;

/**
 * AdminUsers Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 *
 * @method \App\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
{
    public function index()
    {
        $carts = $this->paginate($this->Carts);

        $this->set(compact('carts'));
    }

    public function add()
    {
        $cart = $this->Carts->newEntity();
        if ($this->request->is('post')) {
            // ログインしていない場合
            if (!($this->Auth->user('id'))) {
                $this->Flash->error(__('ログインしてください'));
                return $this->redirect(['controller' => '../generalCategories', 'action' => 'index']);
            }
            // 同じproduct_idがあるか検索し、あった場合、そこにnumを追加する
            $data = array(
                'member_user_id' => $this->Auth->user('id'),
                'product_id' => $this->request->getData('product_id'),
                'product_num' => $this->request->getData('product_num')
            );

            $cart = $this->Carts->patchEntity($cart, $data);
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit()
    {
        $carts = $this->paginate($this->Carts);

        $this->set(compact('carts'));
    }

    public function delete()
    {
        $carts = $this->paginate($this->Carts);

        $this->set(compact('carts'));
    }

    public function isAuthorized($categories = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'edit', 'delete', 'index']);
    }
}
