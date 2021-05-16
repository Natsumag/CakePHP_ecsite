<?php
namespace App\Controller;
use Cake\Event\Event;


class GeneralCategoriesController extends AppController
{
    public function initialize() {
        parent::initialize();
        // モデルの読み込み
        $this->loadModel('Products');
        $this->loadModel('Categories');

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

//        $categories = $this->paginate($this->Categories);
        $query = $this->Categories
            ->find()
            ->contain(['Products' => function($query){
                return $query->select(['id', 'category_id', 'name', 'ih_correspond_id', 'material_id', 'price', 'units_in_stock', 'description', 'size_circle', 'size_rectangle', 'thickness', 'height']); // ここで設定
            }]);
        $categories = $query->all();

        debug($categories);
        exit();

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


    public function isAuthorized($product = null)
    {
        return true;
    }

    // ログイン認証不要のページ指定（loginの追加不要）、一時的に追加している。
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['index','view']);
    }
}
