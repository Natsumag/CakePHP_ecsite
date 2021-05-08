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
            $array1 = ['file_name1', 'file_name2', 'file_name3', 'file_name4', 'file_name5'];
            $num = 1;
            $uploadFile = array();

            //アップロード
            foreach ($array1 as $value) {
                $uploadFile[] = $this->request->getData($value);
                foreach ($uploadFile as $uf) {
                    if ((int)$uf['size'] === 0) {
                        continue;
                    }
                    $a = array();
                    $a[] = $uf;

                    $x = date('YmdHis') . $uf['name'];
                    $uploadPath = WWW_ROOT . 'files/Products/image/' . $x;
                    $limitFileSize = 1024 * 1024;
                    $array2['file_name' . $num] = $x;
                    try {
                        AppUtility::file_upload($uf, $uploadPath, $limitFileSize);
                        $num++;
                    } catch (RuntimeException $e) {
                        $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                        $this->Flash->error(__($e->getMessage()));
                    }


                }
            }
//            array_pop($array);
            debug($y);
            exit();




            foreach ($uploadFile as $uf) {
                if ( (int)$uf['size'] === 0 ) { // 念のため型キャストでintegerを指定
                    continue;
                }
                // ここにファイルアップロードの処理を書く
                $array['file_name' . $num] = $num . 'つ目のファイル名';// 実際には右辺は日付と、アップロードした時のファイル名
                $num++; // ファイルがあった時だけ、連番が増える。1〜5まで連動してくれる想定。
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
