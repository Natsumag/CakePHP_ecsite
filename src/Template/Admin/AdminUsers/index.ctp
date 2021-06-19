<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdminUser[]|\Cake\Collection\CollectionInterface $adminUsers
 */
?>

<div class="adminUsers index large-9 medium-8 columns content">
    <h3><?= __('Admin Users') ?></h3>
        <div class="col text-right"><?= $this->Html->link(__('管理者ユーザの追加'), ['action' => 'add'], ['class' => 'button']) ?></div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adminUsers as $adminUser): ?>
            <tr>
                <td><?= $this->Number->format($adminUser->id) ?></td>
                <td><?= h($adminUser->name) ?></td>
                <td><?= h($adminUser->email) ?></td>
                <td>
                    <?php if (h($adminUser->delete_flag) == false) {
                        echo 'false<br>';
                    } else {
                        echo 'true<br>';
                    } ?>
                </td>
                <td><?= h($adminUser->created_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $adminUser->id], ['class' => 'button']) ?>
                    <?php if (h($adminUser->delete_flag) == false) {
                        echo $this->Form->postLink(__('削除'), ['action' => 'delete', $adminUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]);
                    } else {
                        echo $this->Form->postLink(__('削除取り消し'), ['action' => 'delete', $adminUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]);
                    } ?>
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
