<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contacts Model
 *
 * @property \App\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsTo $AdminUsers
 * @property \App\Model\Table\MemberUsersTable&\Cake\ORM\Association\BelongsTo $MemberUsers
 *
 * @method \App\Model\Entity\Contact get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contact newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Contact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contact|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contact saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contact[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contact findOrCreate($search, callable $callback = null, $options = [])
 */
class ContactsTable extends Table
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
        $this->setTable('contacts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'admin_user_id',
        ]);
        $this->belongsTo('MemberUsers', [
            'foreignKey' => 'member_user_id',
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->lengthBetween('name', [10, 20], 'length is 10~20');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->lengthBetween('email', [10, 100], 'length is 10~100');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmptyString('content')
            ->lengthBetween('content', [10, 200], 'length is 10~200');

        $validator
            ->boolean('reply_states_flag')
            ->notEmptyString('reply_states_flag');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');
        return $validator;
    }

    public function findContactIndex(Query $query)
    {
        return $query
            ->select(['id', 'admin_name_id' => 'AdminUsers.id', 'admin_name' => 'AdminUsers.name', 'name' => 'MemberUsers.name', 'email', 'content', 'reply_states_flag', 'updated_at'])
            ->contain(['AdminUsers'])
            ->contain(['MemberUsers'])
        ;
    }

    public function findContactView(Query $query, $id)
    {
        return $query
            ->select(['id', 'name' => 'MemberUsers.name', 'email', 'content', 'reply_states_flag', 'updated_at'])
            ->contain(['MemberUsers'])
            ->where(['Contacts.id' => $id['id']])
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
        // 対象テーブルに値が存在しなかった場合、エラーになる
        $rules->add($rules->existsIn(['admin_user_id'], 'AdminUsers'));
        $rules->add($rules->existsIn(['member_user_id'], 'MemberUsers'));
        return $rules;
    }
}
