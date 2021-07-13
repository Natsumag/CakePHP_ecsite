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
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_fee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseHistories as $purchaseHistory): ?>
            <tr>
                <td><?= $this->Number->format($purchaseHistory->id) ?></td>
                <td><?= $this->Html->link($purchaseHistory->member_name, ['controller' => 'Member_Users', 'action' => 'edit', $purchaseHistory->member_name_id]) ?></td>
                <td><?= $this->Number->format($purchaseHistory->total_fee) ?></td>
                <td>
                    <?php if (h($purchaseHistory->payment_flag) == false) {
                        echo 'false<br>';
                    } else {
                        echo 'true<br>';
                    } ?>
                </td>
                <td>
                    <?php if (h($purchaseHistory->purchase_flag) == false) {
                        echo 'false<br>';
                    } else {
                        echo 'true<br>';
                    } ?>
                </td>
                <td><?= h($purchaseHistory->created_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseHistory->id]) ?>
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
