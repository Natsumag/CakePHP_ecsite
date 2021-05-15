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
 * @property \App\Model\Table\MaterialsTable&\Cake\ORM\Association\BelongsTo $Materials
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
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('ih_correspond_id')
            ->requirePresence('ih_correspond_id', 'create')
            ->notEmptyString('ih_correspond_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('price')
            ->maxLength('price', 7)
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->integer('units_in_stock')
            ->maxLength('units_in_stock', 4)
            ->requirePresence('units_in_stock', 'create')
            ->notEmptyString('units_in_stock');

        $validator
            ->integer('number_of_units_sold')
            ->maxLength('number_of_units_sold', 5)
            ->requirePresence('number_of_units_sold', 'create')
            ->notEmptyString('number_of_units_sold');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('size_circle')
            ->maxLength('size_circle', 5)
            ->allowEmptyString('size_circle');

        $validator
            ->scalar('size_rectangle')
            ->maxLength('size_rectangle', 5)
            ->allowEmptyString('size_rectangle');

        $validator
            ->integer('thickness')
            ->maxLength('thickness', 3)
            ->allowEmptyString('thickness');

        $validator
            ->integer('height')
            ->maxLength('height', 3)
            ->allowEmptyString('height');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */

//    public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->existsIn(['category_id'], 'Categories'));
//        $rules->add($rules->existsIn(['ih_correspond_id'], 'IhCorresponds'));
//        $rules->add($rules->existsIn(['material_id'], 'Materials'));
//
//        return $rules;
//    }
}
