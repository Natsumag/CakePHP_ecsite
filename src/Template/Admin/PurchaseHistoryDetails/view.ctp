<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseHistoryDetail $purchaseHistoryDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase History Detail'), ['action' => 'edit', $purchaseHistoryDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase History Detail'), ['action' => 'delete', $purchaseHistoryDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseHistoryDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase History Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase History Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Histories'), ['controller' => 'PurchaseHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase History'), ['controller' => 'PurchaseHistories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseHistoryDetails view large-10 medium-10 columns content">
    <h3><?= h($purchaseHistoryDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Purchase History') ?></th>
            <td><?= $purchaseHistoryDetail->has('purchase_history') ? $this->Html->link($purchaseHistoryDetail->purchase_history->id, ['controller' => 'PurchaseHistories', 'action' => 'view', $purchaseHistoryDetail->purchase_history->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $purchaseHistoryDetail->has('product') ? $this->Html->link($purchaseHistoryDetail->product->name, ['controller' => 'Products', 'action' => 'view', $purchaseHistoryDetail->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseHistoryDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Num') ?></th>
            <td><?= $this->Number->format($purchaseHistoryDetail->product_num) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($purchaseHistoryDetail->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($purchaseHistoryDetail->updated_at) ?></td>
        </tr>
    </table>
</div>
