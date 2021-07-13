<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseHistory $purchaseHistory
 */
?>
<div class="purchaseHistories view large-10 medium-10 columns content">
    <h3><?= h($purchaseHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member User') ?></th>
            <td><?= $this->Html->link($purchaseHistory->member_name, ['controller' => 'Member_Users', 'action' => 'edit', $purchaseHistory->member_name_id]) ?></td>
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
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Product size') ?></th>
                <th scope="col"><?= __('Product size') ?></th>
                <th scope="col"><?= __('Product Num') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
            </tr>
            <?php foreach ($related_purchase_history_details as $purchaseHistoryDetails): ?>
            <tr>
                <td><?= h($purchaseHistoryDetails->id) ?></td>
                <td><?= $this->Html->link($purchaseHistoryDetails->product_name, ['controller' => 'Products', 'action' => 'view', $purchaseHistoryDetails->product_id]) ?></td>
                <td><?= h($purchaseHistoryDetails->size_rectangle) ?></td>
                <td><?= h($purchaseHistoryDetails->size_circle) ?></td>
                <td><?= h($purchaseHistoryDetails->product_num) ?></td>
                <td><?= h($purchaseHistoryDetails->created_at) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
