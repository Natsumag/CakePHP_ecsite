<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseHistoryDetail Entity
 *
 * @property int $id
 * @property int $purchase_history_id
 * @property int $product_id
 * @property int $product_num
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\PurchaseHistory $purchase_history
 * @property \App\Model\Entity\Product $product
 */
class PurchaseHistoryDetail extends Entity
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
        'purchase_history_id' => true,
        'product_id' => true,
        'product_num' => true,
        'created_at' => true,
        'updated_at' => true,
        'purchase_history' => true,
        'product' => true,
    ];
}
