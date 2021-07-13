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
        $memberUsers = $this->paginate($this->MemberUsers->find('MemberUserIndex'));
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
        $memberUser = $this->MemberUsers->find('MemberUserView', [
            'id' => $id
        ]);
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
        $this->request->allowMethod(['post', 'delete']);
        $memberUser = $this->MemberUsers->find('MemberUserDelete', [
            'id' => $id
        ]);
        $delete_flag_change = !($memberUser->delete_flag);
        $data = array('delete_flag' => $delete_flag_change);
        $memberUser = $this->MemberUsers->patchEntity($memberUser, $data);
        if ($this->MemberUsers->save($memberUser)) {
            if ($delete_flag_change == true) {
                $this->Flash->success(__('The Member user has been deleted.'));
            } else {
                $this->Flash->success(__('The Member user has been canceled delete.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        if ($delete_flag_change == true) {
            $this->Flash->error(__('The Member user could not be deleted. Please, try again.'));
        } else {
            $this->Flash->error(__('The Member user could not be canceled delete. Please, try again.'));
        }
    }
}
