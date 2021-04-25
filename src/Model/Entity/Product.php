<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $category_id
 * @property int $ih_correspond_id
 * @property int $material_id
 * @property string $name
 * @property int $price
 * @property int $units_in_stock
 * @property int $number_of_units_sold
 * @property string $description
 * @property int $size
 * @property int|null $thickness
 * @property string $file_name
 * @property string $file_type
 * @property string $file_path
 * @property int $file_size
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\IhCorrespond $ih_correspond
 * @property \App\Model\Entity\Material $material
 */
class Product extends Entity
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
        'category_id' => true,
        'ih_correspond_id' => true,
        'material_id' => true,
        'name' => true,
        'price' => true,
        'units_in_stock' => true,
        'number_of_units_sold' => true,
        'description' => true,
        'size' => true,
        'thickness' => true,
        'file_name' => true,
        'file_type' => true,
        'file_path' => true,
        'file_size' => true,
        'created_at' => true,
        'updated_at' => true,
        'category' => true,
        'ih_correspond' => true,
        'material' => true,
    ];
}
