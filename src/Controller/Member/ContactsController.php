<?php
namespace App\Controller\Member;

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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contacts->newEntity();
        if ($this->request->is('post')) {
            if ($this->Auth->user('id')) {
                $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
                if (($this->getRequest()->getSession()->check('hogehoge2'))) {
                    $this->getRequest()->getSession()->consume('hogehoge2');
                }
                if (!($this->getRequest()->getSession()->check('hogehoge1'))) {
                    $this->getRequest()->getSession()->write('hogehoge', $contact);
                    return $this->redirect(['action' => 'confirm']);
                } else {
                    $contact = $this->getRequest()->getSession()->consume('hogehoge1');
                }
            }
            $this->Flash->error(__('not post.'));
        }
        $this->set(compact('contact'));
    }

    public function confirm()
    {
        if (!($this->getRequest()->getSession()->check('hogehoge2'))) {
            if (($this->getRequest()->getSession()->check('hogehoge'))) {
                $contact = $this->request->getSession()->read('hogehoge');
                $this->getRequest()->getSession()->write('hogehoge2', $contact);
                $this->set(compact('contact'));
            } else {
                return $this->redirect(['action' => 'add']);
            }
        } else {
            $contact = $this->getRequest()->getSession()->consume('hogehoge2');
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('saved.'));
                $this->render("complete");
            }
        }
        $this->set(compact('contact'));
    }

    public function isAuthorized($material = null)
    {
        return true;
    }
}
