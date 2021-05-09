<?php
namespace App\Controller\admin;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\Event\Event;
use Cake\Filesystem\File;
use RuntimeException;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'IhCorresponds', 'Materials'],
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'IhCorresponds', 'Materials'],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
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
                $uploadPath = WWW_ROOT . 'files/Products/image/' . $uploadFileName;
                $limitFileSize = 1024 * 1024;
                AppUtility::file_upload($uf, $uploadPath, $limitFileSize);
                // ファイル名の格納
                $array2['file_name' . $num] = $uploadFileName;
                $num++;
            }
            $data = array(
                'category_id' => $this->request->getData('category_id'),
                'ih_correspond_id' => $this->request->getData('ih_correspond_id'),
                'material_id' => $this->request->getData('material_id'),
                'name' => $this->request->getData('name'),
                'price' => $this->request->getData('price'),
                'units_in_stock' => $this->request->getData('units_in_stock'),
                'number_of_units_sold' => $this->request->getData('number_of_units_sold'),
                'description' => $this->request->getData('description'),
                'size' => $this->request->getData('size'),
                'thickness' => $this->request->getData('thickness'),
                'file_name1' => array_key_exists('file_name1', $array2) ? $array2['file_name1'] : '',
                'file_name2' => array_key_exists('file_name2', $array2) ? $array2['file_name2'] : '',
                'file_name3' => array_key_exists('file_name3', $array2) ? $array2['file_name3'] : '',
                'file_name4' => array_key_exists('file_name4', $array2) ? $array2['file_name4'] : '',
                'file_name5' => array_key_exists('file_name5', $array2) ? $array2['file_name5'] : '',
                'file_name6' => array_key_exists('file_name6', $array2) ? $array2['file_name6'] : ''
            );

            $product = $this->Products->newEntity($data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
            $categories = $this->Products->Categories->find('list', ['limit' => 20]);
            $ihCorresponds = $this->Products->IhCorresponds->find('list', ['limit' => 10]);
            $materials = $this->Products->Materials->find('list', ['limit' => 20]);
            $this->set(compact('product', 'categories', 'ihCorresponds', 'materials'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // 画像のアップロード処理

            $beforeUploadPath = WWW_ROOT . '/files/Products/image/';
            $limitFileSize = 1024 * 1024;
            $uploadFile1 = $this->request->getData('file_name1');
            if ($uploadFile1['error'] == 0) {
                $uploadPath1 = WWW_ROOT . '/files/Products/image/' . date('YmdHis') . $uploadFile1['name'];
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
                $uploadPath2 = WWW_ROOT . '/files/Products/image/' . date('YmdHis') . $uploadFile2['name'];
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
                $uploadPath3 = WWW_ROOT . '/files/Products/image/' . date('YmdHis') . $uploadFile3['name'];
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
                $uploadPath4 = WWW_ROOT . '/files/Products/image/' . date('YmdHis') . $uploadFile4['name'];
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
                $uploadPath5 = WWW_ROOT . '/files/Products/image/' . date('YmdHis') . $uploadFile5['name'];
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

            $uploadFile6 = $this->request->getData('file_name6');
            if ($uploadFile6['error'] == 0) {
                $uploadPath6 = WWW_ROOT . '/files/Products/image/' . date('YmdHis') . $uploadFile6['name'];
                try {
                    // 古い画像ファイルの削除
                    if (($this->request->getData('file_before6'))) {
                        $delFile = new File( $beforeUploadPath . $this->request->getData('file_before6'));
                        if (!$delFile->delete()) {
                            $this->log('ファイル更新時に下記ファイルが削除できませんでした。',LOG_DEBUG);
                            $this->log($this->request->getData('file_before6'), LOG_DEBUG);
                        }
                    }
                    // 更新処理
                    AppUtility::file_upload($this->request->getData('file_name6'), $uploadPath6, $limitFileSize);
                    $array['file_name6'] = date('YmdHis') . $uploadFile6['name'];
                } catch (RuntimeException $e) {
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                if ($this->request->getData('file_before6')) {
                    $beforeFileName6 = $this->request->getData('file_before6');
                    $array['file_name6'] = $beforeFileName6;
                } else {
                    $array['file_name6'] = '';
                }
            }

            $data = array(
                'category_id' => $this->request->getData('category_id'),
                'ih_correspond_id' => $this->request->getData('ih_correspond_id'),
                'material_id' => $this->request->getData('material_id'),
                'name' => $this->request->getData('name'),
                'price' => $this->request->getData('price'),
                'units_in_stock' => $this->request->getData('units_in_stock'),
                'number_of_units_sold' => $this->request->getData('number_of_units_sold'),
                'description' => $this->request->getData('description'),
                'size' => $this->request->getData('size'),
                'thickness' => $this->request->getData('thickness'),
                'file_name1' => $array['file_name1'],
                'file_name2' => $array['file_name2'],
                'file_name3' => $array['file_name3'],
                'file_name4' => $array['file_name4'],
                'file_name5' => $array['file_name5'],
                'file_name6' => $array['file_name6']
            );

            $product = $this->Products->patchEntity($product, $data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 20]);
        $ihCorresponds = $this->Products->IhCorresponds->find('list', ['limit' => 10]);
        $materials = $this->Products->Materials->find('list', ['limit' => 20]);
        $this->set(compact('product', 'categories', 'ihCorresponds', 'materials'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        $fileName1 = $product->file_name1;
        $fileName2 = $product->file_name2;
        $fileName3 = $product->file_name3;
        $fileName4 = $product->file_name4;
        $fileName5 = $product->file_name5;
        $fileName6 = $product->file_name6;

        // 画像の削除処理
        $filePath1 = WWW_ROOT . '/files/Products/image/' . $fileName1;
        try {
            $delFile = new File($filePath1);
            // ファイル削除処理実行
            if ($delFile->delete()) {
                $product['file_name1'] = "";
            } else {
                throw new RuntimeException('ファイルの削除ができませんでした.');
            }
        } catch (RuntimeException $e){
            $this->log($e->getMessage(),LOG_DEBUG);
            $this->log($product->file_name1,LOG_DEBUG);
        }

        if ($fileName2 !== '') {
            $filePath2 = WWW_ROOT . 'files/Products/image/' . $fileName2;
            try {
                $delFile = new File($filePath2);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $product['file_name2'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($product->file_name1,LOG_DEBUG);
            }
        }

        if ($fileName3 !== '') {
            $filePath3 = WWW_ROOT . 'files/Products/image/' . $fileName3;
            try {
                $delFile = new File($filePath3);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $product['file_name3'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($product->file_name1,LOG_DEBUG);
            }
        }

        if ($fileName4 !== '') {
            $filePath4 = WWW_ROOT . 'files/Products/image/' . $fileName4;
            try {
                $delFile = new File($filePath4);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $product['file_name4'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($product->file_name1,LOG_DEBUG);
            }
        }

        if ($fileName5 !== '') {
            $filePath5 = WWW_ROOT . 'files/Products/image/' . $fileName5;
            try {
                $delFile = new File($filePath5);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $product['file_name5'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($product->file_name1,LOG_DEBUG);
            }
        }

        if ($fileName6 !== '') {
            $filePath6 = WWW_ROOT . 'files/Products/image/' . $fileName6;
            try {
                $delFile = new File($filePath6);
                // ファイル削除処理実行
                if ($delFile->delete()) {
                    $product['file_name6'] = "";
                } else {
                    throw new RuntimeException('ファイルの削除ができませんでした.');
                }
            } catch (RuntimeException $e){
                $this->log($e->getMessage(),LOG_DEBUG);
                $this->log($product->file_name1,LOG_DEBUG);
            }
        }

        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($product = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）、一時的に追加している。
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['add','index','edit','view', 'delete']);
    }
}
