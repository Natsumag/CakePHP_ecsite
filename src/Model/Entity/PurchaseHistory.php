<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseHistory Entity
 *
 * @property int $id
 * @property int $member_user_id
 * @property int $total_fee
 * @property bool $payment_flag
 * @property bool $purchase_flag
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\MemberUser $member_user
 * @property \App\Model\Entity\PurchaseHistoryDetail[] $purchase_history_details
 */
class PurchaseHistory extends Entity
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
        'total_fee' => true,
        'payment_flag' => true,
        'purchase_flag' => true,
        'created_at' => true,
        'updated_at' => true,
        'member_user' => true,
        'purchase_history_details' => true,
    ];
}
