<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice[]|\Cake\Collection\CollectionInterface $notices
 */
?>
<div class="products index large-10 medium-10 columns content">
    <h3><?= __('Notices') ?></h3>
    <div class="col text-right"><?= $this->Html->link(__('add'), ['action' => 'add'], ['class' => 'button']) ?></div>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('admin_user_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('event_date') ?></th>
            <th scope="col"><?= $this->Paginator->sort('content') ?></th>
            <th scope="col"><?= $this->Paginator->sort('detail') ?></th>
            <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($notices as $notice): ?>
            <tr>
                <td><?= $this->Number->format($notice->id) ?></td>
                <td><?= $this->Html->link($notice->admin_name, ['controller' => 'Admin_Users', 'action' => 'edit', $notice->admin_name_id]) ?></td>
                <td><?= h($notice->event_date) ?></td>
                <td><?= h($notice->content) ?></td>
                <td><?= h($notice->detail) ?></td>
                <td><?= h($notice->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notice->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notice->id)]) ?>
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
