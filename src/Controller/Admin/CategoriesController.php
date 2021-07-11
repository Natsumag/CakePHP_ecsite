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
        $categories = $this->paginate($this->Categories->find('CategoryIndex'));
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
        $category = $this->Categories->find('CategoryView', [
            'id' => $id
        ]);
        $this->loadModel('Products');
        $related_products = $this->Products->find('RelatedProductIndex', [
            'id' => $id
        ]);
        $this->set('ihCorrespods', IH_CORRESPOND);
        $this->set(compact('category'));
        $this->set(compact('related_products'));
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
            $list_file_name = ['file_name1', 'file_name2', 'file_name3', 'file_name4', 'file_name5'];
            $get_data = $this->request->getData();
            foreach ($list_file_name as $value) {
                $upload_files[] = $get_data[$value];
            }
            $file_name_num = 1;
            foreach ($upload_files as $upload_file) {
                // ファイルサイズがあるもののみ取得
                if ((int)$upload_file['size'] === 0) {
                    continue;
                }
                $upload_file_name = date('YmdHis') . $upload_file['name'];
                $upload_path = WWW_ROOT . 'files/Categories/image/' . $upload_file_name;
                $limit_file_size = 1024 * 1024;
                $file_error_check = AppUtility::file_upload($upload_file, $upload_path, $limit_file_size);
                // ファイル名の格納
                $store_file_name['file_name' . $file_name_num] = $upload_file_name;
                $file_name_num++;
            }
            if ($file_error_check === true) {
                $data = array(
                    'ih_correspond_id' => $get_data['ih_correspond_id'],
                    'material_id' => $get_data['material_id'],
                    'name' => $get_data['name'],
                    'description' => $get_data['description'],
                    'file_name1' => array_key_exists('file_name1', $store_file_name) ? $store_file_name['file_name1'] : '',
                    'file_name2' => array_key_exists('file_name2', $store_file_name) ? $store_file_name['file_name2'] : '',
                    'file_name3' => array_key_exists('file_name3', $store_file_name) ? $store_file_name['file_name3'] : '',
                    'file_name4' => array_key_exists('file_name4', $store_file_name) ? $store_file_name['file_name4'] : '',
                    'file_name5' => array_key_exists('file_name5', $store_file_name) ? $store_file_name['file_name5'] : ''
                );
                $category= $this->Categories->newEntity($data);
                if ($this->Categories->save($category)) {
                    $this->Flash->success(__('The category has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $materials = $this->Categories->Materials->find('MaterialsList');
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
        if ($this->request->is(['post', 'put'])) {
            $get_data = $this->request->getData();
            $before_upload_path = WWW_ROOT . '/files/Categories/image/';
            $limit_file_size = 1024 * 1024;

            for($i = 1; $i <= 5; $i++) {
                $upload_file = $get_data['file_name'.$i];
                if (isset($get_data['file_before'.$i])) {
                    $file_before = $get_data['file_before'.$i];
                } else {
                    $file_before = 'null';
                }
                if ($upload_file['error'] == 0) {
                    $uploadPath = $before_upload_path . date('YmdHis') . $upload_file['name'];
                    $array['file_name'.$i] = AppUtility::edit_check_file($file_before, $before_upload_path, $uploadPath, $upload_file, $limit_file_size);
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
                'material_id'      => $get_data['material_id'],
                'name'             => $get_data['name'],
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
        $materials = $this->Categories->Materials->find('MaterialsList');
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
        $before_upload_path = WWW_ROOT . '/files/Categories/image/';
        for($i = 1; $i <= 5; $i++) {
            $file_name = $category['file_name'.$i];
            if ($file_name !== '') {
                $filePath = $before_upload_path . $file_name;
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
}
