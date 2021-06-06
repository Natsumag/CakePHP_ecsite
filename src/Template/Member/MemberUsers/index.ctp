<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MemberUser[]|\Cake\Collection\CollectionInterface $memberUsers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Member User'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="memberUsers index large-9 medium-8 columns content">
    <h3><?= __('Member Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($memberUsers as $memberUser): ?>
            <tr>
                <td><?= $this->Number->format($memberUser->id) ?></td>
                <td><?= h($memberUser->name) ?></td>
                <td><?= h($memberUser->email) ?></td>
                <td><?= $this->Number->format($memberUser->zip_code) ?></td>
                <td><?= h($memberUser->address) ?></td>
                <td><?= h($memberUser->tel) ?></td>
                <td><?= h($memberUser->delete_flag) ?></td>
                <td><?= h($memberUser->created_at) ?></td>
                <td><?= h($memberUser->updated_at) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
