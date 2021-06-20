<?php
namespace App\Controller\Member;

use Cake\Event\Event;

/**
 * AdminUsers Controller
 *
 * @property \App\Model\Table\MemberUsersTable $MemberUsers
 *
 * @method \App\Model\Entity\MemberUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MemberUsersController extends AppController
{
    public function index()
    {
        $memberUsers = $this->paginate($this->MemberUsers);

        $this->set(compact('memberUsers'));
    }

    public function add()
    {
        $memberUser = $this->MemberUsers->newEntity();
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

    public function login()
    {
        if ($this->request->is('post')) {
            $memberUser = $this->Auth->identify();
            $memberUser_flag = $memberUser['delete_flag'];
            if ($memberUser_flag == true) {
                $this->Flash->error(__('delete_flag is true'));
                return $this->redirect(['action' => 'login']);
            }
            if ($memberUser) {
                $this->Auth->setUser($memberUser);
                return $this->redirect(['controller' => '../Categories', 'action' => 'index']);
            }
            $this->Flash->error(__('not Login'));
        }
    }

    public function logout()
    {
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($categories = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add','index','logout']);
    }
}
