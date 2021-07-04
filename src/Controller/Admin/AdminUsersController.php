<?php
namespace App\Controller\Admin;

use Cake\ORM\TableRegistry;
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
        $adminUsers = $this->paginate($this->AdminUsers);

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
        $adminUser = $this->AdminUsers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success(__('The Admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Admin user could not be saved. Please, try again.'));
        }
        $this->set(compact('adminUser'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post']);
        $adminUser = $this->AdminUsers->get($id);
        $delete_flag = !($adminUser->delete_flag);
        $data = array('delete_flag' => $delete_flag);
        $adminUser = $this->AdminUsers->patchEntity($adminUser, $data);
        if ($this->AdminUsers->save($adminUser)) {
            $this->Flash->success(__('The category has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The category could not be saved. Please, try again.'));
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $adminUser = $this->Auth->identify();
            $adminUser_flag = $adminUser['delete_flag'];
            if ($adminUser_flag == true) {
                $this->Flash->error(__('delete_flag is true'));
                return $this->redirect(['action' => 'login']);
            }
            if ($adminUser) {
                $this->Auth->setUser($adminUser);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('メールアドレスまたはパスワードに誤りがあります。'));
            }
            $this->Flash->error(__(''));
        }
    }

    public function logout()
    {
        // セッションを破棄
         $this->request->getSession()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    /**
     * role別にアクセスを制御したい場合はここに記述。全ロールに許可する場合はreturn trueとだけ書く
     */
    public function isAuthorized($adminUser = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）
    public function beforeFilter(Event $event){
        $this->Auth->allow('login');
        $this->Auth->getConfig('authError', false);
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }
}
