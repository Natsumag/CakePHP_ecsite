<?php
namespace App\Controller;
use Cake\Event\Event;


class CategoriesController extends AppController
{
    public function initialize() {
        parent::initialize();
        // モデルの読み込み
        $this->loadModel('Products');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->Categories
            ->find()
            ->contain(['Products', 'Materials']);
        $categories = $query->all();
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
