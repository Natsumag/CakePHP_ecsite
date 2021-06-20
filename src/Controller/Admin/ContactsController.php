<?php
namespace App\Controller\Admin;

use Cake\Event\Event;

/**
 * Materials Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // モデルの読み込み
        $this->loadModel('Contacts');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MemberUsers'],
        ];
        $contacts = $this->paginate($this->Contacts);

        $this->set(compact('contacts'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $material = $this->Contacts->get($id, [
            'contain' => ['MemberUsers'],
        ]);

        $this->set('material', $material);
    }

    /**
     * Edit method
     *
     */
    public function reply($id = null)
    {
        $contact = $this->Contacts->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material could not be saved. Please, try again.'));
        }
        $this->set(compact('contact'));
    }


    public function isAuthorized($material = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）、一時的に追加している。
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['index','reply','view']);
    }
}
