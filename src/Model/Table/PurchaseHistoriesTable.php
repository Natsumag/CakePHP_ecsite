<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseHistories Model
 *
 * @property \App\Model\Table\MemberUsersTable&\Cake\ORM\Association\BelongsTo $MemberUsers
 * @property \App\Model\Table\PurchaseHistoryDetailsTable&\Cake\ORM\Association\HasMany $PurchaseHistoryDetails
 *
 * @method \App\Model\Entity\PurchaseHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseHistory findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseHistoriesTable extends Table
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

        $this->setTable('purchase_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('MemberUsers', [
            'foreignKey' => 'member_user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PurchaseHistoryDetails', [
            'foreignKey' => 'purchase_history_id',
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
            ->integer('total_fee')
            ->requirePresence('total_fee', 'create')
            ->notEmptyString('total_fee');

        $validator
            ->boolean('payment_flag')
            ->allowEmptyString('payment_flag');

        $validator
            ->boolean('purchase_flag')
            ->allowEmptyString('purchase_flag');

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
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['member_user_id'], 'MemberUsers'));

        return $rules;
    }

    public function findPurchaseHistoryIndex(Query $query)
    {
        return $query
            // 一覧上で常に必要となるカラムを取得
            ->select(['id', 'member_name_id' => 'MemberUsers.id', 'member_name' => 'MemberUsers.name', 'total_fee', 'payment_flag', 'purchase_flag', 'created_at'])
            ->contain(['MemberUsers'])
        ;
    }

    public function findPurchaseHistoryView(Query $query, $id)
    {
        return $query
            // 一覧上で常に必要となるカラムを取得
            ->select(['id', 'member_name_id' => 'MemberUsers.id', 'member_name' => 'MemberUsers.name', 'total_fee', 'payment_flag', 'purchase_flag', 'created_at'])
            ->contain(['MemberUsers'])
            ->contain(['PurchaseHistoryDetails'])
            ->where(['PurchaseHistories.id' => $id['id']])
            ->first()
        ;
    }

    public function findMemberPurchaseHistoryIndex(Query $query, $login_id)
    {
        return $query
            // 一覧上で常に必要となるカラムを取得
            ->select(['id', 'member_name_id' => 'MemberUsers.id', 'total_fee', 'payment_flag', 'purchase_flag', 'created_at'])
            ->contain(['MemberUsers'])
            ->where(['MemberUsers.id' => $login_id['login_id']])
            ->all()
        ;
    }
}
