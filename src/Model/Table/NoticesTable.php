<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notices Model
 *
 * @property \App\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsTo $AdminUsers
 *
 * @method \App\Model\Entity\Notice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Notice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Notice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Notice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Notice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Notice findOrCreate($search, callable $callback = null, $options = [])
 */

class NoticesTable extends Table
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
        $this->setTable('notices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'admin_user_id',
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
            ->dateTime('event_date')
            ->allowEmptyDateTime('event_date');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        $validator
            ->scalar('detail')
            ->requirePresence('detail', 'create')
            ->notEmptyString('detail');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

}
