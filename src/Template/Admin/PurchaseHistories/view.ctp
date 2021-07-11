<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseHistory $purchaseHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase History'), ['action' => 'edit', $purchaseHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase History'), ['action' => 'delete', $purchaseHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Member Users'), ['controller' => 'MemberUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member User'), ['controller' => 'MemberUsers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase History Details'), ['controller' => 'PurchaseHistoryDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase History Detail'), ['controller' => 'PurchaseHistoryDetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseHistories view large-10 medium-10 columns content">
    <h3><?= h($purchaseHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member User') ?></th>
            <td><?= $purchaseHistory->has('member_user') ? $this->Html->link($purchaseHistory->member_user->name, ['controller' => 'MemberUsers', 'action' => 'view', $purchaseHistory->member_user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Fee') ?></th>
            <td><?= $this->Number->format($purchaseHistory->total_fee) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($purchaseHistory->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($purchaseHistory->updated_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Flag') ?></th>
            <td><?= $purchaseHistory->payment_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Flag') ?></th>
            <td><?= $purchaseHistory->purchase_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Purchase History Details') ?></h4>
        <?php if (!empty($purchaseHistory->purchase_history_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Purchase History Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Product Num') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($purchaseHistory->purchase_history_details as $purchaseHistoryDetails): ?>
            <tr>
                <td><?= h($purchaseHistoryDetails->id) ?></td>
                <td><?= h($purchaseHistoryDetails->purchase_history_id) ?></td>
                <td><?= h($purchaseHistoryDetails->product_id) ?></td>
                <td><?= h($purchaseHistoryDetails->product_num) ?></td>
                <td><?= h($purchaseHistoryDetails->created_at) ?></td>
                <td><?= h($purchaseHistoryDetails->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseHistoryDetails', 'action' => 'view', $purchaseHistoryDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseHistoryDetails', 'action' => 'edit', $purchaseHistoryDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseHistoryDetails', 'action' => 'delete', $purchaseHistoryDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseHistoryDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
