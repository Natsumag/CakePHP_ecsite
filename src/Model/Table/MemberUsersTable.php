<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MemberUsers Model
 *
 * @method \App\Model\Entity\MemberUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\MemberUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MemberUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MemberUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MemberUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MemberUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MemberUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MemberUser findOrCreate($search, callable $callback = null, $options = [])
 */
class MemberUsersTable extends Table
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
        $this->setTable('member_users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->notEmptyString('name')
            ->lengthBetween('name', [5, 100], 'length is 5~100');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->lengthBetween('email', [10, 100], 'length is 10~100');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->lengthBetween('password', [8, 20], 'length is 8~20');

        $validator
            ->integer('zip_code')
            ->requirePresence('zip_code', 'create')
            ->notEmptyString('zip_code')
            ->lengthBetween('zip_code', [7, 8], 'length is 7~8');

        $validator
            ->scalar('address')
            ->maxLength('address', 200)
            ->requirePresence('address', 'create')
            ->notEmptyString('address')
            ->lengthBetween('address', [10, 200], 'length is 10~200');

        $validator
            ->scalar('tel')
            ->requirePresence('tel', 'create')
            ->notEmptyString('tel')
            ->lengthBetween('tel', [7, 21], 'length is 7~21');

        $validator
            ->boolean('delete_flag')
            ->allowEmptyString('delete_flag');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');
        return $validator;
    }

    /**
     * 必要な値のみIndexに表示
     *
     */
    public function findMemberUserIndex(Query $query)
    {
        return $query
            ->select(['id', 'name', 'email', 'zip_code', 'address', 'tel', 'delete_flag', 'updated_at'])
        ;
    }

    public function findMemberUserView(Query $query, $id)
    {
        return $query
            ->select(['id', 'name', 'email', 'zip_code', 'address', 'tel', 'delete_flag', 'updated_at'])
            ->where(['MemberUsers.id' => $id['id']])
            ->first()
        ;
    }

    public function findMemberUserDelete(Query $query, $id)
    {
        return $query
            ->select(['id', 'delete_flag'])
            ->where(['MemberUsers.id' => $id['id']])
            ->first()
        ;
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
        // 同じemailが保存されないための処理
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
