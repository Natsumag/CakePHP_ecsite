<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseHistory[]|\Cake\Collection\CollectionInterface $purchaseHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Member Users'), ['controller' => 'MemberUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchase History Details'), ['controller' => 'PurchaseHistoryDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase History Detail'), ['controller' => 'PurchaseHistoryDetails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseHistories index large-9 medium-8 columns content">
    <h3><?= __('Purchase Histories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_fee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseHistories as $purchaseHistory): ?>
            <tr>
                <td><?= $this->Number->format($purchaseHistory->id) ?></td>
                <td><?= $purchaseHistory->has('member_user') ? $this->Html->link($purchaseHistory->member_user->name, ['controller' => 'MemberUsers', 'action' => 'view', $purchaseHistory->member_user->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseHistory->total_fee) ?></td>
                <td><?= h($purchaseHistory->payment_flag) ?></td>
                <td><?= h($purchaseHistory->purchase_flag) ?></td>
                <td><?= h($purchaseHistory->created_at) ?></td>
                <td><?= h($purchaseHistory->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseHistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseHistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseHistory->id)]) ?>
                </td>
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
