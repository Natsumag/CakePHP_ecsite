<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;
use App\Utils\AppUtility;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('category', $category);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());

//            画像のアップロード処理
            $uploadFile = $this->request->getData('file_name');
            $uploadPath = WWW_ROOT . '/files/Categories/image/' . date("YmdHis") . $uploadFile['name'];
            $limitFileSize = 1024 * 1024;
            try {
                $category['file'] = AppUtility::file_upload($this->request->getData('file_name'), $uploadPath, $limitFileSize);
            } catch (RuntimeException $e){
                $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                $this->Flash->error(__($e->getMessage()));
            }

            $data = array(
                'name' => $this->request->getData('name'),
                'description' => $this->request->getData('description'),
                'created_at' => $this->request->getData('created_at'),
                'updated_at' => $this->request->getData('updated_at'),
                'file_name' => date("YmdHis") . $uploadFile['name'] //同様の形でDBに入れる
            );
            $category = $this->Categories->newEntity($data);

            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

//            $category = $this->Categories->newEntity($category, $this->request->getData());

            $uploadFile = $this->request->getData('file_name.error');
            // 編集の画像ファイルが入力されたときtrue
            if($uploadFile == 0){
                $limitFileSize = 1024 * 1024;
                $uploadPath = WWW_ROOT . '/files/Categories/image/' . date("YmdHis") . $uploadFile['name'];
                $beforeUploadPath = WWW_ROOT . '/files/Categories/image/';
                try {
                        // 古い画像ファイルの削除
                        if (($this->request->getData('file_before'))){
                            $del_file = new File( $beforeUploadPath . $this->request->getData('file_before'));
                            if(!$del_file->delete()) {
                                $this->log("ファイル更新時に下記ファイルが削除できませんでした。",LOG_DEBUG);
                                $this->log($this->request->getData('file_before'), LOG_DEBUG);
                            }
                        // 更新処理
                        $category['file'] = AppUtility::file_upload($this->request->getData('file_name'), $uploadPath, $limitFileSize);
                        $data = array(
                            'name' => $this->request->getData('name'),
                            'description' => $this->request->getData('description'),
                            'created_at' => $this->request->getData('created_at'),
                            'updated_at' => $this->request->getData('updated_at'),
                            'file_name' => date("YmdHis") . $uploadFile['name'] //同様の形でDBに入れる
                        );

                        $category = $this->Categories->patchEntity($category, $data);
                    }
                } catch (RuntimeException $e){
                    // アップロード失敗の時、既登録ファイルを保持（ここ未完成）
                    $category['file'] = $this->request->getData('file_before');
//
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }

            } else {
                // ここ未完成
                $category['file'] = $this->request->getData('file_before');
                debug($category['file']);
                exit();
            }


            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        $fileName = $category->file_name;

//        画像の削除処理
        $uploadPath = WWW_ROOT . '/files/Categories/image/' . $fileName;
        try {
            $del_file = new File($uploadPath);
            // ファイル削除処理実行
            if($del_file->delete()) {
                $category['file'] = "";
            } else {
                throw new RuntimeException('ファイルの削除ができませんでした.');
            }
        } catch (RuntimeException $e){
            $this->log($e->getMessage(),LOG_DEBUG);
            $this->log($category->file_name,LOG_DEBUG);
        }

        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($categories = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）、一時的に追加している。
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add','index','edit','view','delete']);
    }
}
