<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories

 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always'
                ]
            ]
        ]);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->lengthBetween('name', [5, 50], 'length is 5~50');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price')
            ->lengthBetween('price', [3, 7], 'length is 3~7');

        $validator
            ->integer('units_in_stock')
            ->requirePresence('units_in_stock', 'create')
            ->notEmptyString('units_in_stock')
            ->lengthBetween('units_in_stock', [1, 4], 'length is 1~4');

        $validator
            ->integer('number_of_units_sold')
            ->maxLength('number_of_units_sold', 5)
            ->requirePresence('number_of_units_sold', 'create')
            ->notEmptyString('number_of_units_sold')
            ->lengthBetween('number_of_units_sold', [1, 5], 'length is 1~5');

        $validator
            ->scalar('size_circle')
            ->maxLength('size_circle', 5)
            ->allowEmptyString('size_circle')
            ->lengthBetween('size_circle', [1, 5], 'length is 1~5');

        $validator
            ->scalar('size_rectangle')
            ->maxLength('size_rectangle', 5)
            ->allowEmptyString('size_rectangle')
            ->lengthBetween('size_rectangle', [1, 5], 'length is 1~5');

        $validator
            ->integer('thickness')
            ->maxLength('thickness', 3)
            ->allowEmptyString('thickness')
            ->lengthBetween('thickness', [1, 3], 'length is 1~3');

        $validator
            ->integer('height')
            ->maxLength('height', 3)
            ->allowEmptyString('height')
            ->lengthBetween('height', [1, 3], 'length is 1~3');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');
        return $validator;
    }

    public function findProductIndex(Query $query)
    {
        return $query
            ->select(['id', 'category_id' => 'Categories.id', 'category_name' => 'Categories.name', 'name', 'size_circle', 'size_rectangle','units_in_stock', 'number_of_units_sold'])
            ->contain(['Categories'])
        ;
    }

    public function findProductView(Query $query, $id)
    {
        return $query
            ->select(['id', 'category_id' => 'Categories.id', 'category_name' => 'Categories.name', 'name', 'size_circle', 'size_rectangle','units_in_stock', 'number_of_units_sold','price', 'thickness', 'height', 'updated_at'])
            ->contain(['Categories'])
            ->where(['Products.id' => $id['id']])
            ->first()
        ;
    }

    public function findRelatedProductIndex(Query $query, $id)
    {
        return $query
            ->select(['id', 'name', 'units_in_stock', 'number_of_units_sold', 'size_rectangle', 'size_circle', 'updated_at'])
            ->contain(['Categories'])
            ->where(['Categories.id' => $id['id']])
            ->all()
        ;
    }

    public function findProductDelete(Query $query, $id)
    {
        return $query
            ->select(['id'])
            ->where(['Products.id' => $id['id']])
            ->first()
        ;
    }

    public function findProductAllPriceAndSize(Query $query)
    {
        return $query
            ->select(['id', 'category_id', 'price', 'size_rectangle', 'size_circle', 'height'])
            ->all()
        ;
    }

}
