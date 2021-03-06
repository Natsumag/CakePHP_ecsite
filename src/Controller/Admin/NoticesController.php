<?php
namespace App\Controller\Admin;

use Cake\Event\Event;

/**
 * Notices Controller
 *
 * @property \App\Model\Table\NoticesTable $Notices
 *
 * @method \App\Model\Entity\Notice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class NoticesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $notices = $this->paginate($this->Notices->find('NoticeIndex'));
        $this->set(compact('notices'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notice = $this->Notices->newEntity();
        if ($this->request->is('post')) {
            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
            if ($this->Notices->save($notice)) {
                $this->Flash->success(__('saved.'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('not saved.'));
        }
        $this->set(compact('notice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notice = $this->Notices->find('NoticeView', [
            'id' => $id
        ]);
        if ($this->request->is(['post', 'put'])) {
            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
            if ($this->Notices->save($notice)) {
                $this->Flash->success(__('The Notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notice could not be saved. Please, try again.'));
        }
        $this->set(compact('notice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notice = $this->Notices->find('NoticeDelete', [
            'id' => $id
        ]);
        if ($this->Notices->delete($notice)) {
            $this->Flash->success(__('The notice has been deleted.'));
        } else {
            $this->Flash->error(__('The notice could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
