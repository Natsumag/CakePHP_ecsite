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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $memberUsers = $this->paginate($this->MemberUsers->find('MemberIndex'));
        $this->set(compact('memberUsers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
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

    /**
     * Edit method
     *
     * @param string|null $id Member User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $memberUser = $this->MemberUsers->get($id);
        if ($this->request->is(['post', 'put'])) {
            $memberUser = $this->MemberUsers->patchEntity($memberUser, $this->request->getData());
            if ($this->MemberUsers->save($memberUser)) {
                $this->Flash->success(__('The Member user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Member user could not be saved. Please, try again.'));
        }
        $this->set(compact('memberUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Member User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post']);
        $memberUser = $this->MemberUsers->get($id);
        $delete_flag = !($memberUser->delete_flag);
        $data = array('delete_flag' => $delete_flag);

        $memberUser = $this->MemberUsers->patchEntity($memberUser, $data);
        if ($this->MemberUsers->save($memberUser)) {
            $this->Flash->success(__('The Member user has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The Member user could not be saved. Please, try again.'));
    }

    /**
     * role別にアクセスを制御したい場合はここに記述。全ロールに許可する場合はreturn true
     */
    public function isAuthorized($categories = null)
    {
        return true;
    }
}
