<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $event_date
 * @property string $content
 * @property string $detail
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\AdminUser[] $admin_users
 */

class Notice extends Entity
{
    protected  $_accessible = [
      'admin_user_id' =>true,
      'event_date' => true,
      'content' => true,
      'detail' => true,
      'created_at' => true,
      'updated_at' => true,
      'admin_users' => true,
    ];
}
