<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * IhCorresponds Controller
 *
 * @property \App\Model\Table\IhCorrespondsTable $IhCorresponds
 *
 * @method \App\Model\Entity\IhCorrespond[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IhCorrespondsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $ihCorresponds = $this->paginate($this->IhCorresponds);

        $this->set(compact('ihCorresponds'));
    }

    /**
     * View method
     *
     * @param string|null $id Ih Correspond id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ihCorrespond = $this->IhCorresponds->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('ihCorrespond', $ihCorrespond);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ihCorrespond = $this->IhCorresponds->newEntity();
        if ($this->request->is('post')) {
            $ihCorrespond = $this->IhCorresponds->patchEntity($ihCorrespond, $this->request->getData());
            if ($this->IhCorresponds->save($ihCorrespond)) {
                $this->Flash->success(__('The ih correspond has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ih correspond could not be saved. Please, try again.'));
        }
        $this->set(compact('ihCorrespond'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ih Correspond id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ihCorrespond = $this->IhCorresponds->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ihCorrespond = $this->IhCorresponds->patchEntity($ihCorrespond, $this->request->getData());
            if ($this->IhCorresponds->save($ihCorrespond)) {
                $this->Flash->success(__('The ih correspond has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ih correspond could not be saved. Please, try again.'));
        }
        $this->set(compact('ihCorrespond'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ih Correspond id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ihCorrespond = $this->IhCorresponds->get($id);
        if ($this->IhCorresponds->delete($ihCorrespond)) {
            $this->Flash->success(__('The ih correspond has been deleted.'));
        } else {
            $this->Flash->error(__('The ih correspond could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($ihCorrespond = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）、一時的に追加している。
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add','index','edit','view', 'delete']);
    }
}
