<?php
namespace App\Controller\Member;

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
                $this->Auth->setUser($memberUser);
                $this->Flash->success(__('ユーザを追加し、ログインしました'));
                return $this->redirect(['controller' => '../Categories', 'action' => 'index']);
            }
            $this->Flash->error(__('not Saved'));
        }
        $this->set(compact('memberUser'));
    }

    /**
     * Edit method
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $id = $this->Auth->user('id');
        $memberUser = $this->MemberUsers->find('MemberUserView', [
            'id' => $id
        ]);
        if ($this->request->is(['post', 'put'])) {
            $memberUser = $this->MemberUsers->patchEntity($memberUser, $this->request->getData());
            if ($this->MemberUsers->save($memberUser)) {
                $this->Flash->success(__('The Member user has been saved.'));
                return $this->redirect(['action' => 'edit']);
            }
            $this->Flash->error(__('The Member user could not be saved. Please, try again.'));
        }
        $this->set(compact('memberUser'));
    }

    /**
     * Delete method
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->Auth->user('id');
        $memberUser = $this->MemberUsers->find('MemberUserDelete', [
            'id' => $id
        ]);
        $delete_flag = true;
        $data = array('delete_flag' => $delete_flag);
        $memberUser = $this->MemberUsers->patchEntity($memberUser, $data);
        if ($this->MemberUsers->save($memberUser)) {
            $this->request->getSession()->destroy();
            $this->Flash->success(__('The memberUser has been deleted.'));
            return $this->redirect(['controller' => '../Categories', 'action' => 'index']);
        }
        $this->Flash->error(__('The memberUser could not be deleted. Please, try again.'));
    }

    public function login()
    {
        if ($this->request->is('post')) {
            // すでにログインしていないか
            if (!$this->Auth->user()) {
                $memberUser = $this->Auth->identify();
                $memberUser_flag = $memberUser['delete_flag'];
                // 削除していないか
                if ($memberUser_flag == true) {
                    $this->Flash->error(__('delete_flag is true.'));
                    return $this->redirect(['action' => 'login']);
                }
                if ($memberUser) {
                    $this->Auth->setUser($memberUser);
                    return $this->redirect(['controller' => '../Categories', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('メールアドレスまたはパスワードに誤りがあります。'));
                }
            }
            $this->Flash->error(__('すでにログインしています'));
        }
    }

    public function logout()
    {
        // セッション破棄
        $this->request->getSession()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    /**
     * role別にアクセスを制御したい場合はここに記述。全ロールに許可する場合はreturn true
     */
    public function isAuthorized($categories = null)
    {
        return true;
    }

    public function beforeFilter(Event $event){
        // URLでloginページにリダイレクト時、フラッシュメッセージを出さないようにする
        $this->Auth->allow('login');
        $this->Auth->getConfig('authError', false);

        // ログイン認証不要のページ指定（loginの追加不要）
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }
}
