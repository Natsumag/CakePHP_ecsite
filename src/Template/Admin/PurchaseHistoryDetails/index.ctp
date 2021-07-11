<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseHistoryDetail[]|\Cake\Collection\CollectionInterface $purchaseHistoryDetails
 */
?>
<div class="purchaseHistoryDetails index large-10 medium-10 columns content">
    <h3><?= __('Purchase History Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_history_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_num') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseHistoryDetails as $purchaseHistoryDetail): ?>
            <tr>
                <td><?= $this->Number->format($purchaseHistoryDetail->id) ?></td>
                <td><?= $purchaseHistoryDetail->has('purchase_history') ? $this->Html->link($purchaseHistoryDetail->purchase_history->id, ['controller' => 'PurchaseHistories', 'action' => 'view', $purchaseHistoryDetail->purchase_history->id]) : '' ?></td>
                <td><?= $purchaseHistoryDetail->has('product') ? $this->Html->link($purchaseHistoryDetail->product->name, ['controller' => 'Products', 'action' => 'view', $purchaseHistoryDetail->product->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseHistoryDetail->product_num) ?></td>
                <td><?= h($purchaseHistoryDetail->created_at) ?></td>
                <td><?= h($purchaseHistoryDetail->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseHistoryDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseHistoryDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseHistoryDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseHistoryDetail->id)]) ?>
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
