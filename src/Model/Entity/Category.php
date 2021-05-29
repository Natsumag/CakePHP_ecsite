<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $file_name
 * @property int $file_size
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\Product[] $products
 */
class Category extends Entity
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
        'material_id' => true,
        'ih_correspond_id' => true,
        'name' => true,
        'description' => true,
        'file_name1' => true,
        'file_name2' => true,
        'file_name3' => true,
        'file_name4' => true,
        'file_name5' => true,
        'created_at' => true,
        'updated_at' => true,
        'products' => true,
        'material' => true,
    ];
}
