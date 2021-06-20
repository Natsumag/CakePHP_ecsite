<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice[]|\Cake\Collection\CollectionInterface $notices
 */
?>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Notices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('event_date') ?></th>
            <th scope="col"><?= $this->Paginator->sort('content') ?></th>
            <th scope="col"><?= $this->Paginator->sort('detail') ?></th>
            <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($notices as $notice): ?>
            <tr>
                <td><?= $this->Number->format($notice->id) ?></td>
                <td><?= h($notice->event_date) ?></td>
                <td><?= h($notice->content) ?></td>
                <td><?= h($notice->detail) ?></td>
                <td><?= h($notice->updated_at) ?></td>
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
