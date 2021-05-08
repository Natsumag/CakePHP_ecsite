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
     * View method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminUser = $this->AdminUsers->get($id, [
            'contain' => [],
        ]);

        $this->set('adminUser', $adminUser);
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
        $adminUser = $this->AdminUsers->get($id, [
            'contain' => [],
        ]);
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
        $adminUser = $this->AdminUsers->get($id);
        if ($this->AdminUsers->delete($adminUser)) {
            $this->Flash->success(__('The Admin user has been deleted.'));
        } else {
            $this->Flash->error(__('The Admin user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

// ログイン認証不要のページ指定（loginの追加不要）
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }

    /**
     * role別にアクセスを制御したい場合はここに記述。全ロールに許可する場合はreturn trueとだけ書く
     */
    public function isAuthorized($adminUser = null)
    {
        return true;
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $adminUser = $this->Auth->identify();
            if ($adminUser) {
                $this->Auth->setUser($adminUser);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('メールアドレスまたはパスワードに誤りがあります。'));
        }
    }

    public function logout()
    {
        // セッションを破棄
         $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }
}
