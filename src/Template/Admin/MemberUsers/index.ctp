<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MemberUser[]|\Cake\Collection\CollectionInterface $memberUsers
 */
?>

<div class="memberUsers index large-12 medium-12 columns content">
    <h3>
        <?= __('Member Users') ?>
        <?= $this->Html->link(__('add'), ['action' => 'add']) ?>
    </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($memberUsers as $memberUser): ?>
            <tr>
                <td><?= $this->Number->format($memberUser->id) ?></td>
                <td><?= h($memberUser->name) ?></td>
                <td><?= h($memberUser->email) ?></td>
                <td><?= $this->Number->format($memberUser->zip_code) ?></td>
                <td><?= h($memberUser->address) ?></td>
                <td><?= h($memberUser->tel) ?></td>
                <td>
                    <?php if (h($memberUser->delete_flag) == false) {
                        echo 'false<br>';
                    } else {
                        echo 'true<br>';
                    } ?>
                </td>
                <td><?= h($memberUser->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $memberUser->id], ['class' => 'button']) ?>
                    <?php if (h($memberUser->delete_flag) == false) {
                        echo $this->Form->postLink(__('削除'), ['action' => 'delete', $memberUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $memberUser->id)]);
                    } else {
                        echo $this->Form->postLink(__('削除取り消し'), ['action' => 'delete', $memberUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $memberUser->id)]);
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
