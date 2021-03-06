<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Materials Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 *
 * @method \App\Model\Entity\Material get($primaryKey, $options = [])
 * @method \App\Model\Entity\Material newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Material[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Material|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Material saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Material patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Material[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Material findOrCreate($search, callable $callback = null, $options = [])
 */
class MaterialsTable extends Table
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

        $this->setTable('materials');
        $this->setDisplayField('material');
        $this->setPrimaryKey('id');

        $this->hasMany('Categories', [
            'foreignKey' => 'material_id',
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
            ->scalar('material')
            ->requirePresence('material', 'create')
            ->notEmptyString('material')
            ->lengthBetween('material', [2, 100], 'length is 2~100');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');
        return $validator;
    }

    public function findMaterialIndex(Query $query)
    {
        return $query
            ->select(['id', 'material', 'updated_at'])
        ;
    }

    public function findMaterialView(Query $query, $id)
    {
        return $query
            ->select(['id', 'material', 'updated_at'])
            ->where(['Materials.id' => $id['id']])
            ->first()
        ;
    }

    public function findMaterialDelete(Query $query, $id)
    {
        return $query
            ->select(['id'])
            ->where(['Materials.id' => $id['id']])
            ->first()
        ;
    }

    public function findMaterialsList(Query $query)
    {
        return $query
            ->select(['Materials__id'=> 'id', 'Materials__material' => 'material'])
            ->from('materials Materials')
        ;
    }
}
