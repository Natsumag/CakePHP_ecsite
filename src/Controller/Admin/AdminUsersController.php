<?php
namespace App\Controller\Admin;

use Cake\Event\Event;

/**
 * AdminUsers Controller
 *
 * @property \App\Model\Table\AdminUsersTable $AdminUsers
 *
 * @method \App\Model\Entity\AdminUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $adminUsers = $this->paginate($this->AdminUsers->find('AdminUserIndex'));
        $this->set(compact('adminUsers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adminUser = $this->AdminUsers->newEntity();
        if ($this->request->is('post')) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success(__('The Admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Admin user could not be saved. Please, try again.'));
        }
        $this->set(compact('adminUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminUser = $this->AdminUsers->find('AdminUserView', [
            'id' => $id
        ]);
        if ($this->request->is(['post', 'put'])) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success(__('The Admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Admin user could not be saved. Please, try again.'));
        }
        $this->set(compact('adminUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminUser = $this->AdminUsers->find('AdminUserDelete', [
            'id' => $id
        ]);
        // delete_flagを逆転させて保存
        $delete_flag_change = !($adminUser->delete_flag);
        $data = array('delete_flag' => $delete_flag_change);
        $adminUser = $this->AdminUsers->patchEntity($adminUser, $data);
        if ($this->AdminUsers->save($adminUser)) {
            if ($delete_flag_change == true) {
                $this->Flash->success(__('The Admin user has been deleted.'));
            } else {
                $this->Flash->success(__('The Admin user has been canceled delete.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        if ($delete_flag_change == true) {
            $this->Flash->error(__('The Admin user could not be deleted. Please, try again.'));
        } else {
            $this->Flash->error(__('The Admin user could not be canceled delete. Please, try again.'));
        }
    }

    public function login()
    {
        if ($this->request->is('post')) {
            if (!$this->Auth->user()) {
                $adminUser = $this->Auth->identify();
                $adminUser_flag = $adminUser['delete_flag'];
                if ($adminUser_flag == true) {
                    $this->Flash->error(__('delete_flag is true.'));
                    return $this->redirect(['action' => 'login']);
                }
                if ($adminUser) {
                    $this->Auth->setUser($adminUser);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error(__('メールアドレスまたはパスワードに誤りがあります。'));
                }
            }
            $this->Flash->error(__('すでにログインしています'));
        }
    }

    public function logout()
    {
        // セッション破棄
        $this->request->getSession()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function beforeFilter(Event $event)
    {
        // URLでloginページにリダイレクト時、フラッシュメッセージを出さないようにする
        $this->Auth->allow('login');
        $this->Auth->getConfig('authError', false);

        // ログイン認証不要のページ指定（loginの追加不要）
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }
}
