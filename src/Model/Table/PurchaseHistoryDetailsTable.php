<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseHistoryDetails Model
 *
 * @property \App\Model\Table\PurchaseHistoriesTable&\Cake\ORM\Association\BelongsTo $MemberPurchaseHistories
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\PurchaseHistoryDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseHistoryDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseHistoryDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseHistoryDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseHistoryDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseHistoryDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseHistoryDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseHistoryDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseHistoryDetailsTable extends Table
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

        $this->setTable('purchase_history_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('MemberPurchaseHistories', [
            'foreignKey' => 'purchase_history_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
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
            ->integer('product_num')
            ->requirePresence('product_num', 'create')
            ->notEmptyString('product_num');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

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
//        $rules->add($rules->existsIn(['purchase_history_id'], 'MemberPurchaseHistories'));
//        $rules->add($rules->existsIn(['product_id'], 'Products'));
//
//        return $rules;
//    }
}
