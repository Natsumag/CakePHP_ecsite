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
 * @property \App\Model\Table\IhCorrespondsTable&\Cake\ORM\Association\BelongsTo $IhCorresponds
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

        $this->setTable('products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
//        $this->belongsTo('IhCorresponds', [
//            'foreignKey' => 'ih_correspond_id',
//            'joinType' => 'INNER',
//        ]);
//        $this->belongsTo('Materials', [
//            'foreignKey' => 'material_id',
//            'joinType' => 'INNER',
//        ]);
        // Upload Plugin
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file_name' => [
                'fields' => [
                    'type' => 'file_type',
                    'dir'  => 'file_path',
                    'size' => 'file_size',
                ]
            ],
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->integer('units_in_stock')
            ->requirePresence('units_in_stock', 'create')
            ->notEmptyString('units_in_stock');

        $validator
            ->integer('number_of_units_sold')
            ->requirePresence('number_of_units_sold', 'create')
            ->notEmptyString('number_of_units_sold');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('size')
            ->requirePresence('size', 'create')
            ->notEmptyString('size');

        $validator
            ->integer('thickness')
            ->allowEmptyString('thickness');

        $validator
            ->scalar('file_name')
            ->requirePresence('file_name', 'create')
            ->notEmptyFile('file_name');

        $validator
            ->scalar('file_type')
            ->requirePresence('file_type', 'create')
            ->notEmptyFile('file_type');

        $validator
            ->scalar('file_path')
            ->requirePresence('file_path', 'create')
            ->notEmptyFile('file_path');

        $validator
            ->integer('file_size')
            ->requirePresence('file_size', 'create')
            ->notEmptyFile('file_size');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
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
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
//        $rules->add($rules->existsIn(['ih_correspond_id'], 'IhCorresponds'));
//        $rules->add($rules->existsIn(['material_id'], 'Materials'));

        return $rules;
    }
}
