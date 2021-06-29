<?php
namespace App\Controller\Admin;

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

    public function edit($id = null)
    {
        $memberUser = $this->MemberUsers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $memberUser = $this->MemberUsers->patchEntity($memberUser, $this->request->getData());
            if ($this->MemberUsers->save($memberUser)) {
                $this->Flash->success(__('The Member user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Member user could not be saved. Please, try again.'));
        }
        $this->set(compact('memberUser'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post']);
        $memberUser = $this->MemberUsers->get($id);
        $memberUser_flag = $memberUser->delete_flag;
        if ($memberUser_flag == false) {
            $delete_flag = true;
            $data = array('delete_flag' => $delete_flag);
        } else {
            $delete_flag = false;
            $data = array('delete_flag' => $delete_flag);
        }

        $memberUser = $this->MemberUsers->patchEntity($memberUser, $data);
        if ($this->MemberUsers->save($memberUser)) {
            $this->Flash->success(__('The category has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The category could not be saved. Please, try again.'));
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
