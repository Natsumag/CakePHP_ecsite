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
                <th scope="col"><?= __('No') ?></th>
                <th scope="col"><?= __('total_fee') ?></th>
                <th scope="col"><?= __('payment_flag') ?></th>
                <th scope="col"><?= __('purchase_flag') ?></th>
                <th scope="col"><?= __('created_at') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchase_histories as $purchase_history): ?>
            <tr>
                <td><?= $this->Number->format($purchase_history->id) ?></td>
                <td><?= $this->Number->format($purchase_history->total_fee) ?></td>
                <td><?= $purchase_history->payment_flag ? __('Yes') : __('No'); ?></td>
                <td><?= $purchase_history->purchase_flag ? __('Yes') : __('No'); ?></td>
                <td><?= h($purchase_history->created_at) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
