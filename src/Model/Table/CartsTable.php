<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Carts Model
 *
 * @property \App\Model\Table\MemberUsersTable&\Cake\ORM\Association\BelongsTo $MemberUsers
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Cart get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cart|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cart saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cart findOrCreate($search, callable $callback = null, $options = [])
 */
class CartsTable extends Table
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

        $this->setTable('carts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('MemberUsers', [
            'foreignKey' => 'member_user_id',
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
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['member_user_id'], 'MemberUsers'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        return $rules;
    }

    public function findCartIndex(Query $query, $login_id)
    {
        return $query
            ->select(['id', 'product_id' => 'Products.id', 'product_name' => 'Products.name', 'price' => 'Products.price', 'product_num'])
            ->where(['Carts.member_user_id' => $login_id['login_id']])
            ->contain(['Products'])
        ;
    }

    public function findCartEdit(Query $query, $cart_id)
    {
        return $query
            ->select(['id', 'product_num'])
            ->where(['Carts.id' => $cart_id['cart_id']])
            ->first()
        ;
    }

    public function findCartDelete(Query $query, $id)
    {
        return $query
            ->select(['id'])
            ->where(['Carts.id' => $id['id']])
            ->first()
        ;
    }

}
