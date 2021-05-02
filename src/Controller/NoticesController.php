<?php
namespace App\Controller;

use App\Controller\AppController;
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
    public function index()
    {
        $this->paginate = [
            'contain' => ['AdminUsers'],
        ];
        $notices = $this ->paginate($this->Notices);

        $this->set(compact('notices'));
    }

    public function add()
    {
        $notice = $this->Notices->newEntity();
        if ($this->request->is('post')) {
            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
//            debug($notice);
//            exit();
            if ($this->Notices->save($notice)) {
                $this->Flash->success(__('saved.'));

                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('not saved.'));
        }
        $adminUsers = $this->Notices->AdminUsers->find('list', ['limit' => 100]);
        $this->set(compact('notice', 'adminUsers'));
    }

    public function edit($id = null)
    {
        $notice = $this->Notices->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notice = $this->Notices->patchEntity($notice, $this->request->getData());
            if ($this->Notices->save($notice)) {
                $this->Flash->success(__('The Notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notice could not be saved. Please, try again.'));
        }
        $this->set(compact('notice'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notice = $this->Notices->get($id);
        if ($this->Notices->delete($notice)) {
            $this->Flash->success(__('The notice has been deleted.'));
        } else {
            $this->Flash->error(__('The notice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($notices = null)
    {
        return true;
    }
}
