<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\AppUtility;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;



class GeneralProductsController extends AppController
{
    public function initialize() {
        parent::initialize();
        // モデルの読み込み
        $this->loadModel('Products');
        $this->loadModel('Categories');
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'IhCorresponds', 'Materials'],
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));

    }

    public function view($id = null)
    {
        $generalProduct = $this->Products->get($id, [
            'contain' => ['Categories', 'IhCorresponds', 'Materials'],
        ]);

        $this->set('product', $generalProduct);
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
