<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\Event\Event;

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
            $array = ['file_name1', 'file_name2', 'file_name3', 'file_name4', 'file_name5'];
            $uploadFile = array();


            foreach ($array as $value) {
                $uploadFile[] = $this->request->getData($value);
            }
            $key = array_search( 0, array_column( $uploadFile, 'error'));
//                $keys = array_keys($array, 'error');
                debug($uploadFile); // ここに配列で画像ファイルが溜まっているはず。
                exit();

//                if ($value['error']  0) {
//                    foreach ($array2 as $value) {
//                        $uploadFile2[] = $this->request->getData($value);
//                    }
//                }

//            foreach ($uploadFile as $upload) {
//                if ($upload['error'] !== 0) {
//                    var_dump($station);
//                }
//            }

            debug($uploadFile2); // ここに配列で画像ファイルが溜まっているはず。
            exit();


            // UploadFileでfile_name.error == 0 のもののみ以下の処理を進めたい
            $uploadPath = WWW_ROOT . '/files/Products/image/' . date('YmdHis');
            $uploadPath1 = $uploadPath . $uploadFile1['name'];
            $uploadPath2 = $uploadPath . $uploadFile2['name'];
            $uploadPath3 = $uploadPath . $uploadFile3['name'];
            $uploadPath4 = $uploadPath . $uploadFile4['name'];
            $uploadPath5 = $uploadPath . $uploadFile5['name'];
            $uploadPath6 = $uploadPath . $uploadFile6['name'];
            $limitFileSize = 1024 * 1024;


            try {
                $category['file1'] = AppUtility::file_upload($this->request->getData('file_name1'), $uploadPath1, $limitFileSize);
                $category['file2'] = AppUtility::file_upload($this->request->getData('file_name2'), $uploadPath2, $limitFileSize);
                debug($category['file2']);
                exit();
                $category['file3'] = AppUtility::file_upload($this->request->getData('file_name3'), $uploadPath3, $limitFileSize);
                $category['file4'] = AppUtility::file_upload($this->request->getData('file_name4'), $uploadPath4, $limitFileSize);
                $category['file5'] = AppUtility::file_upload($this->request->getData('file_name5'), $uploadPath5, $limitFileSize);
                $category['file6'] = AppUtility::file_upload($this->request->getData('file_name6'), $uploadPath6, $limitFileSize);
            } catch (RuntimeException $e){
                $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                $this->Flash->error(__($e->getMessage()));
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
                'file_name1' => date("YmdHis") . $uploadFile1['name'], //同様の形でDBに入れる
                'file_name2' => date("YmdHis") . $uploadFile2['name'],
                'file_name3' => date("YmdHis") . $uploadFile3['name'],
                'file_name4' => date("YmdHis") . $uploadFile4['name'],
                'file_name5' => date("YmdHis") . $uploadFile5['name'],
                'file_name6' => date("YmdHis") . $uploadFile6['name']
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
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $ihCorresponds = $this->Products->IhCorresponds->find('list', ['limit' => 200]);
        $materials = $this->Products->Materials->find('list', ['limit' => 200]);
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
