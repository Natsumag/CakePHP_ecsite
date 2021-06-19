<?php
namespace App\Controller\Member;

use Cake\Event\Event;

/**
 * Materials Controller
 *
 * @property \App\Model\Table\ContactsTable $MemberContacts
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MemberContactsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // モデルの読み込み
        $this->loadModel('Contacts');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
            if ($this->Auth->user('id')) {
                if (!($this->getRequest()->getSession()->check('hogehoge'))) {
                    $this->getRequest()->getSession()->write('hogehoge', $this->getRequest()->getSession()->read());
                    $this->set(compact('contact'));

                    $this->render("confirm");
                } else {
                    $this->getRequest()->getSession()->delete('hogehoge');
                    $getdata = $this->request->getData();
                    $contact = $this->Contacts->patchEntity($contact, $getdata);
                    if ($this->Contacts->save($contact)) {
                        $this->Flash->success(__('saved.'));

                        $this->render("complete");
                    } else {
                        $this->Flash->error(__('not saved.'));
                    }

                }
//                $this->Flash->error(__('not post.'));
            }

        }
        $this->set(compact('contact'));
    }

    public function confirm()
    {
        if (!($this->getRequest()->getSession()->check('hogehoge'))) {
            return $this->redirect(['action' => 'add']);
        }

        $this->redirect($this->request->referer());
    }



    public function edit()
    {
        $this->getRequest()->getSession()->delete('hogehoge');

        $this->redirect($this->request->referer());
    }


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
        $this->Auth->allow(['add', 'confirm', 'complete']);
    }
}
