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
        $categories = $this->paginate($this->Categories->find('GeneralCategoryIndex'));
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

    public function isAuthorized($product = null)
    {
        return true;
    }
}
