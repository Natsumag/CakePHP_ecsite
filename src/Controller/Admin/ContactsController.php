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
