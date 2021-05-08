<?php
namespace App\Controller\Admin;


use Cake\Event\Event;

/**
 * Materials Controller
 *
 * @property \App\Model\Table\MaterialsTable $Materials
 *
 * @method \App\Model\Entity\Material[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MaterialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $materials = $this->paginate($this->Materials);

        $this->set(compact('materials'));
    }

    /**
     * View method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('material', $material);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $material = $this->Materials->newEntity();
        if ($this->request->is('post')) {
            $material = $this->Materials->patchEntity($material, $this->request->getData());
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material could not be saved. Please, try again.'));
        }
        $this->set(compact('material'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $material = $this->Materials->patchEntity($material, $this->request->getData());
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material could not be saved. Please, try again.'));
        }
        $this->set(compact('material'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $material = $this->Materials->get($id);
        if ($this->Materials->delete($material)) {
            $this->Flash->success(__('The material has been deleted.'));
        } else {
            $this->Flash->error(__('The material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($material = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）、一時的に追加している。
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add','index','edit','view', 'delete']);
    }
}
