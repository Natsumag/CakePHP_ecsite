<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminUsers Model
 *
 * @property \App\Model\Table\NoticesTable&\Cake\ORM\Association\HasMany $Notices
 *
 * @method \App\Model\Entity\AdminUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdminUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdminUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdminUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdminUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdminUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdminUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdminUser findOrCreate($search, callable $callback = null, $options = [])
 */
class AdminUsersTable extends Table
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
        $this->setTable('admin_users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Notices', [
            'foreignKey' => 'admin_user_id',
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
            ->lengthBetween('name', [5, 40], 'length is 5~40');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->lengthBetween('email', [10, 100], 'length is 10~100')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->lengthBetween('password', [8, 20], 'length is 8~20');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        $validator
            ->boolean('delete_flag')
            ->allowEmptyString('delete_flag');
        return $validator;
    }

    /**
     * ??????????????????Index?????????
     *
     */
    public function findAdminUserIndex(Query $query)
    {
        return $query
            ->select(['id', 'name', 'email', 'delete_flag', 'created_at'])
        ;
    }

    public function findAdminUserView(Query $query, $id)
    {
        return $query
            ->select(['id', 'name', 'email', 'delete_flag', 'created_at'])
            ->where(['AdminUsers.id' => $id['id']])
            ->first()
        ;
    }

    public function findAdminUserDelete(Query $query, $id)
    {
        return $query
            ->select(['id', 'delete_flag'])
            ->where(['AdminUsers.id' => $id['id']])
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
        // ??????email????????????????????????????????????
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
