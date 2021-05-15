<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\Event\Event;
use Cake\Filesystem\File;
use RuntimeException;


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

        $this->set('ihCorrespods', IH_CORRESPOND);
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

            // 画像のアップロード処理
            $array1 = ['file_name1', 'file_name2', 'file_name3', 'file_name4', 'file_name5', 'file_name6'];
            $uploadFile = array();
            $num = 1; // アップロードされたファイルを数えるのに使用
            foreach ($array1 as $value) {
                $uploadFile[] = $this->request->getData($value);
            }
            // ファイルサイズがあるもののみ取得し、アップロード
            foreach ($uploadFile as $uf) {
                if ((int)$uf['size'] === 0) {
                    continue;
                }
                $uploadFileName = date('YmdHis') . $uf['name'];
                $uploadPath = WWW_ROOT . 'files/Categories/image/' . $uploadFileName;
                $limitFileSize = 1024 * 1024;
                AppUtility::file_upload($uf, $uploadPath, $limitFileSize);
                // ファイル名の格納
                $array2['file_name' . $num] = $uploadFileName;
                $num++;
            }
            $data = array(
                'name' => $this->request->getData('name'),
                'description' => $this->request->getData('description'),
                'file_name1' => array_key_exists('file_name1', $array2) ? $array2['file_name1'] : '',
                'file_name2' => array_key_exists('file_name2', $array2) ? $array2['file_name2'] : '',
                'file_name3' => array_key_exists('file_name3', $array2) ? $array2['file_name3'] : '',
                'file_name4' => array_key_exists('file_name4', $array2) ? $array2['file_name4'] : '',
                'file_name5' => array_key_exists('file_name5', $array2) ? $array2['file_name5'] : ''
            );

            $category= $this->Categories->newEntity($data);

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
        $category = $this->Categories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $beforeUploadPath = WWW_ROOT . '/files/Categories/image/';
            $limitFileSize = 1024 * 1024;
            $uploadFile1 = $this->request->getData('file_name1');
            if ($uploadFile1['error'] == 0) {
                $uploadPath1 = $beforeUploadPath . date('YmdHis') . $uploadFile1['name'];
                try {
                    // 古い画像ファイルの削除
                    if (($this->request->getData('file_before1'))) {
                        $delFile = new File( $beforeUploadPath . $this->request->getData('file_before1'));
                        if (!$delFile->delete()) {
                            $this->log('ファイル更新時に下記ファイルが削除できませんでした。',LOG_DEBUG);
                            $this->log($this->request->getData('file_before1'), LOG_DEBUG);
                        }
                    }
                    // 更新処理
                    AppUtility::file_upload($this->request->getData('file_name1'), $uploadPath1, $limitFileSize);
                    $array['file_name1'] = date('YmdHis') . $uploadFile1['name'];
                } catch (RuntimeException $e) {
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                if ($this->request->getData('file_before1')) {
                    $beforeFileName1 = $this->request->getData('file_before1');
                    $array['file_name1'] = $beforeFileName1;
                } else {
                    $array['file_name1'] = '';
                }
            }

            $uploadFile2 = $this->request->getData('file_name2');
            if ($uploadFile2['error'] == 0) {
                $uploadPath2 = $beforeUploadPath . date('YmdHis') . $uploadFile2['name'];
                try {
                    // 古い画像ファイルの削除
                    if (($this->request->getData('file_before2'))) {
                        $delFile = new File( $beforeUploadPath . $this->request->getData('file_before2'));
                        if (!$delFile->delete()) {
                            $this->log('ファイル更新時に下記ファイルが削除できませんでした。',LOG_DEBUG);
                            $this->log($this->request->getData('file_before2'), LOG_DEBUG);
                        }
                    }
                    // 更新処理
                    AppUtility::file_upload($this->request->getData('file_name2'), $uploadPath2, $limitFileSize);
                    $array['file_name2'] = date('YmdHis') . $uploadFile2['name'];
                } catch (RuntimeException $e) {
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                if ($this->request->getData('file_before2')) {
                    $beforeFileName2 = $this->request->getData('file_before2');
                    $array['file_name2'] = $beforeFileName2;
                } else {
                    $array['file_name2'] = '';
                }
            }

            $uploadFile3 = $this->request->getData('file_name3');
            if ($uploadFile3['error'] == 0) {
                $uploadPath3 = $beforeUploadPath . date('YmdHis') . $uploadFile3['name'];
                try {
                    // 古い画像ファイルの削除
                    if (($this->request->getData('file_before3'))) {
                        $delFile = new File( $beforeUploadPath . $this->request->getData('file_before3'));
                        if (!$delFile->delete()) {
                            $this->log('ファイル更新時に下記ファイルが削除できませんでした。',LOG_DEBUG);
                            $this->log($this->request->getData('file_before3'), LOG_DEBUG);
                        }
                    }
                    // 更新処理
                    AppUtility::file_upload($this->request->getData('file_name3'), $uploadPath3, $limitFileSize);
                    $array['file_name3'] = date('YmdHis') . $uploadFile3['name'];
                } catch (RuntimeException $e) {
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                if ($this->request->getData('file_before2')) {
                    $beforeFileName3 = $this->request->getData('file_before3');
                    $array['file_name3'] = $beforeFileName3;
                } else {
                    $array['file_name3'] = '';
                }
            }

            $uploadFile4 = $this->request->getData('file_name4');
            if ($uploadFile4['error'] == 0) {
                $uploadPath4 = $beforeUploadPath . date('YmdHis') . $uploadFile4['name'];
                try {
                    // 古い画像ファイルの削除
                    if (($this->request->getData('file_before4'))) {
                        $delFile = new File( $beforeUploadPath . $this->request->getData('file_before4'));
                        if (!$delFile->delete()) {
                            $this->log('ファイル更新時に下記ファイルが削除できませんでした。',LOG_DEBUG);
                            $this->log($this->request->getData('file_before4'), LOG_DEBUG);
                        }
                        // 更新処理
                        AppUtility::file_upload($this->request->getData('file_name4'), $uploadPath4, $limitFileSize);
                        $array['file_name4'] = date('YmdHis') . $uploadFile4['name'];
                    }
                } catch (RuntimeException $e) {
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                if ($this->request->getData('file_before4')) {
                    $beforeFileName4 = $this->request->getData('file_before4');
                    $array['file_name4'] = $beforeFileName4;
                } else {
                    $array['file_name4'] = '';
                }
            }

            $uploadFile5 = $this->request->getData('file_name5');
            if ($uploadFile5['error'] == 0) {
                $uploadPath5 = $beforeUploadPath . date('YmdHis') . $uploadFile5['name'];
                try {
                    // 古い画像ファイルの削除
                    if (($this->request->getData('file_before5'))) {
                        $delFile = new File( $beforeUploadPath . $this->request->getData('file_before5'));
                        if (!$delFile->delete()) {
                            $this->log('ファイル更新時に下記ファイルが削除できませんでした。',LOG_DEBUG);
                            $this->log($this->request->getData('file_before5'), LOG_DEBUG);
                        }
                    }
                    // 更新処理
                    AppUtility::file_upload($this->request->getData('file_name5'), $uploadPath5, $limitFileSize);
                    $array['file_name5'] = date('YmdHis') . $uploadFile5['name'];
                } catch (RuntimeException $e) {
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                if ($this->request->getData('file_before5')) {
                    $beforeFileName5 = $this->request->getData('file_before5');
                    $array['file_name5'] = $beforeFileName5;
                } else {
                    $array['file_name5'] = '';
                }
            }

            $data = array(
                'name' => $this->request->getData('name'),
                'description' => $this->request->getData('description'),
                'file_name1' => $array['file_name1'],
                'file_name2' => $array['file_name2'],
                'file_name3' => $array['file_name3'],
                'file_name4' => $array['file_name4'],
                'file_name5' => $array['file_name5']
            );

            $category = $this->Categories->patchEntity($category, $data);

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
        $fileName1 = $category->file_name1;
        $fileName2 = $category->file_name2;
        $fileName3 = $category->file_name3;
        $fileName4 = $category->file_name4;
        $fileName5 = $category->file_name5;

        // 画像の削除処理
        $beforeUploadPath = WWW_ROOT . '/files/Categories/image/';
        $filePath1 = $beforeUploadPath . $fileName1;
        try {
            $delFile = new File($filePath1);
            // ファイル削除処理実行
            if ($delFile->delete()) {
                $category['file_name1'] = "";
            } else {
                throw new RuntimeException('ファイルの削除ができませんでした.');
            }
        } catch (RuntimeException $e){
            $this->log($e->getMessage(),LOG_DEBUG);
            $this->log($category->file_name1,LOG_DEBUG);
        }

        if ($fileName2 !== '') {
            $filePath2 = $beforeUploadPath . $fileName2;
            try {
                $delFile = new File($filePath2);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $category['file_name2'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($category->file_name2,LOG_DEBUG);
            }
        }

        if ($fileName3 !== '') {
            $filePath3 = $beforeUploadPath . $fileName3;
            try {
                $delFile = new File($filePath3);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $category['file_name3'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($category->file_name3,LOG_DEBUG);
            }
        }

        if ($fileName4 !== '') {
            $filePath4 = $beforeUploadPath . $fileName4;
            try {
                $delFile = new File($filePath4);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $category['file_name4'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($category->file_name4,LOG_DEBUG);
            }
        }

        if ($fileName5 !== '') {
            $filePath5 = $beforeUploadPath . $fileName5;
            try {
                $delFile = new File($filePath5);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $category['file_name5'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($category->file_name5,LOG_DEBUG);
            }
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
        $this->Auth->allow(['add','index','edit','view', 'delete']);
    }
}
