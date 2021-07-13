<?php
namespace App\Controller\Member;

use App\Utils\AppUtility;
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
        $login_id = $this->Auth->user('id');
        $carts = $this->Carts->find('CartIndex', [
            'login_id' => $login_id
        ]);
        $this->set(compact('carts'));
        $this->set('total');
    }

    public function add()
    {
        $cart = $this->Carts->newEntity();
        if ($this->request->is('post')) {
            $login_id = $this->Auth->user('id');
            $data = $this->request->getData();
            // ログインしていない場合
            if (!($login_id)) {
                return $this->redirect(['controller' => 'memberUsers', 'action' => 'login']);
            }
            // 同じproduct_idがあるか検索し、あった場合、そこにnumを追加する
            $data = array(
                'member_user_id' => $login_id,
                'product_id' => $data['product_id'],
                'product_num' => $data['product_num']
            );
            // ログイン者かつ商品IDが一致するもの
            $query = $this->Carts->find('InCart', [
                'data' => $data,
            ]);
            // product_idが一致するレコードがあったとき更新する
            if (isset($query)) {
                // product_numの更新
                $product_num_old = $query->product_num;
                $product_num_update = $data['product_num'] + $product_num_old;
                $data = array(
                    'member_user_id' => $login_id,
                    'product_id' => $data['product_id'],
                    'product_num' => $product_num_update
                );
                $cart = $this->Carts->patchEntity($query, $data);
            } else {
                $cart = $this->Carts->patchEntity($cart, $data);
            }
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
        $data = $this->request->getData();
        $cart = $this->Carts->find('CartEdit', [
            'cart_id' => $data['product_id']
        ]);
        if ($this->request->is(['post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, ['product_num' => $data['product_num']]);
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The Cart has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart could not be updated. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->find('CartDelete', [
            'id' => $id
        ]);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($categories = null)
    {
        return true;
    }
}
