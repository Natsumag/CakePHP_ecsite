<?php
namespace App\Controller\Admin;

use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Materials Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $contacts = $this->paginate($this->Contacts->find('ContactIndex'));
        $this->set(compact('contacts'));
    }

    /**
     * Reply method
     *
     * @param string|null $id Contacts id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function reply($id = null)
    {
        $contact = $this->Contacts->find('ContactView', [
            'id' => $id
        ]);
        if ($this->request->is(['post', 'put'])) {
            $reply_content = $this->request->getData('reply_content');
            $login_user = $this->Auth->user('id');
            $data = array(
                'reply_states_flag' => true,
                'admin_user_id' => $login_user
            );
            $contact = $this->Contacts->patchEntity($contact, $data);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The material has been saved.'));
                $login_user = $this->Auth->user();
                // メール送信
                $email = new Email('default');
                $email->setFrom(['cakephp0906@gmail.com' => 'PHP Cake'])
                    ->setTo($login_user['email'])
                    ->setSubject('ご購入ありがとうございます')
                    ->viewBuilder()
                    ->setTemplate('contact_reply')
                    ->setVar('reply_content', $reply_content)
                    ->setVar('content', $contact['content'])
                    ->setVar('name', $contact['name'])
                ;
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material could not be saved. Please, try again.'));
        }
        $this->set(compact('contact'));
    }
}
