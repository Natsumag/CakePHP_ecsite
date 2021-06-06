<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cart Entity
 *
 * @property int $id
 * @property int $member_user_id
 * @property int $product_id
 * @property int $product_num
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\MemberUser $member_user
 * @property \App\Model\Entity\Product $product
 */
class Cart extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'member_user_id' => true,
        'product_id' => true,
        'product_num' => true,
        'created_at' => true,
        'updated_at' => true,
        'member_user' => true,
        'product' => true,
    ];
}
