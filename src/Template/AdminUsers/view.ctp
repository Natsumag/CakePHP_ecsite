<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdminUser $adminUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Admin User'), ['action' => 'edit', $adminUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Admin User'), ['action' => 'delete', $adminUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Admin Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="adminUsers view large-9 medium-8 columns content">
    <h3><?= h($adminUser->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($adminUser->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($adminUser->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($adminUser->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($adminUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($adminUser->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($adminUser->updated_at) ?></td>
        </tr>
    </table>
    <div class="heading"><?= __('Actions') ?></div>
    <div>
        <?= $this->Html->link(__('Edit Admin User'), ['action' => 'edit', $adminUser->id], ['class' => 'button']) ?>
        <?= $this->Form->postLink(__('Delete Admin User'), ['action' => 'delete', $adminUser->id], ['class' => 'button','confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]) ?>
    </div>
    <div>
        <?= $this->Html->link(__('List Admin Users'), ['action' => 'index'], ['class' => 'button']) ?>
        <?= $this->Html->link(__('New Admin User'), ['action' => 'add'], ['class' => 'button']) ?>
    </div>
</div>
