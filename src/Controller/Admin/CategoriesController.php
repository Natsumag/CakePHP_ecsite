<?php
namespace App\Controller\Admin;

use App\Utils\AppUtility;
use Cake\Event\Event;
use Cake\Filesystem\File;
use RuntimeException;
use Cake\ORM\RulesChecker;


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
        $this->paginate = [
            'contain' => ['Materials'],
        ];
        $categories = $this->paginate($this->Categories);
        $this->set('ihCorrespods', IH_CORRESPOND);
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
            'contain' => ['Products', 'Materials'],
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
                $file_up = AppUtility::file_upload($uf, $uploadPath, $limitFileSize);
                // ファイル名の格納
                $array2['file_name' . $num] = $uploadFileName;
                $num++;
            }
//            if ($file_up === true) {
                $data = array(
                    'ih_correspond_id' => $this->request->getData('ih_correspond_id'),
                    'material_id' => $this->request->getData('material_id'),
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
//            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $materials = $this->Categories->Materials->find('list', ['limit' => 20]);
        $this->set('ihCorrespods', IH_CORRESPOND);
        $this->set(compact('category', 'materials'));
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
            $get_data = $this->request->getData();
            $beforeUploadPath = WWW_ROOT . '/files/Categories/image/';
            $limitFileSize = 1024 * 1024;

            for($i = 1; $i <= 5; $i++) {
                $uploadFile = $get_data['file_name'.$i];
                if (isset($get_data['file_before'.$i])) {
                    $file_before = $get_data['file_before'.$i];
                } else {
                    $file_before = 'null';
                }
                if ($uploadFile['error'] == 0) {
                    $uploadPath = $beforeUploadPath . date('YmdHis') . $uploadFile['name'];
                    $array['file_name'.$i] = AppUtility::edit_check_file($file_before, $beforeUploadPath, $uploadPath, $uploadFile, $limitFileSize);
                } else {
                    if ($file_before != 'null') {
                        $array['file_name'.$i] = $file_before;
                    } else {
                        $array['file_name'.$i] = '';
                    }
                }
            }
            $data = array(
                'ih_correspond_id' => $get_data['ih_correspond_id'],
                'material_id' => $get_data['material_id'],
                'name' => $get_data['name'],
                'description' => $get_data['description'],
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
        $materials = $this->Categories->Materials->find('list', ['limit' => 20]);
        $this->set('ihCorrespods', IH_CORRESPOND);
        $this->set(compact('category', 'materials'));
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
        // 画像の削除処理
        $beforeUploadPath = WWW_ROOT . '/files/Categories/image/';
        for($i = 1; $i <= 5; $i++) {
            $fileName = $category['file_name'.$i];
            if ($fileName !== '') {
                $filePath = $beforeUploadPath . $fileName;
                try {
                    $delFile = new File($filePath);
                    // ファイル削除処理実行
                    if ($delFile->delete()) {
                        $category['file_name'.$i] = "";
                    } else {
                        throw new RuntimeException('ファイルの削除ができませんでした.');
                    }
                } catch (RuntimeException $e) {
                    $this->log($e->getMessage(), LOG_DEBUG);
                    $this->log($category['file_name'.$i], LOG_DEBUG);
                }
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

    public function buildRules(RulesChecker $rules)
    {

        // 更新のルールを追加
        $rules->addUpdate(function ($entity, $options) {
            // 失敗／成功を示す真偽値を返す
        }, 'ruleName');

        return $rules;
    }

}
