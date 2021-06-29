<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property int|null $admin_user_id
 * @property int $member_user_id
 * @property string $name
 * @property string $email
 * @property string $content
 * @property bool $reply_states_flag
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\AdminUser $admin_user
 * @property \App\Model\Entity\MemberUser $member_user
 */
class Contact extends Entity
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
        'admin_user_id' => true,
        'member_user_id' => true,
        'name' => true,
        'email' => true,
        'content' => true,
        'reply_states_flag' => true,
        'created_at' => true,
        'updated_at' => true,
        'admin_user' => true,
        'member_user' => true,
    ];
}
