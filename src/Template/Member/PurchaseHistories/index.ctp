<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseHistory[]|\Cake\Collection\CollectionInterface $purchaseHistories
 */
?>

<div class="purchaseHistories index large-10 medium-10 columns content">
    <h3><?= __('Purchase Histories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('member_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_fee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseHistories as $purchaseHistory): ?>
            <tr>

                <td><?= $purchaseHistory->has('member_user') ? $this->Html->link($purchaseHistory->member_user->name, ['controller' => 'MemberUsers', 'action' => 'view', $purchaseHistory->member_user->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseHistory->total_fee) ?></td>
                <td><?= h($purchaseHistory->payment_flag) ?></td>
                <td><?= h($purchaseHistory->purchase_flag) ?></td>
                <td><?= h($purchaseHistory->created_at) ?></td>
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
