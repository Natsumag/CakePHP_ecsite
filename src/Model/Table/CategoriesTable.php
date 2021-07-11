<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 * @property \App\Model\Table\MaterialsTable&\Cake\ORM\Association\BelongsTo $Materials
 *
 * @method \App\Model\Entity\Category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Category newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Category|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Category[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Category findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesTable extends Table
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

        $this->setTable('categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Products', [
            'foreignKey' => 'category_id',
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
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->lengthBetween('name', [5, 20], 'name length is 5~20');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator->setProvider('custom', 'App\Model\Validation\CustomValidation');

        for($i = 1; $i <= 5; $i++) {
            $validator
                ->requirePresence('file_name'.$i, 'create')
                ->allowEmptyString('file_name'.$i)
                ->add('file_name'.$i, 'rule_name', [
                    'rule' => ['is_file_type'],
                    'provider' => 'custom',
                    'message' => "書式に誤りがあります",
                ]);
        }

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * 必要な値のみ表示
     *
     */
    public function findCategoryIndex(Query $query)
    {
        return $query
            ->select(['id', 'ih_correspond_id', 'material_id', 'name', 'description', 'file_name1', 'updated_at', 'material' => 'Materials.material'])
            ->contain(['Materials'])
            ;
    }

    public function findCategoryView(Query $query, $id)
    {
        return $query
            ->select(['id', 'ih_correspond_id', 'material_id', 'name', 'description', 'file_name1', 'file_name2', 'file_name3', 'file_name4', 'file_name5', 'updated_at', 'material' => 'Materials.material'])
            ->where('id' == $id)
            ->contain(['Materials'])
            ->contain(['Products'])
            ->first()
            ;
    }
}
