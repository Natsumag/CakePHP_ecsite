<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact[]|\Cake\Collection\CollectionInterface $contacts
 */
?>

<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Contacts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('member_user_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
            <th scope="col"><?= $this->Paginator->sort('content') ?></th>
            <th scope="col"><?= $this->Paginator->sort('reply_states_flag') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
            <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= $this->Number->format($contact->id) ?></td>
                <td><?= $contact->has('member_user') ? $this->Html->link($contact->member_user->name, ['controller' => 'AdminUsers', 'action' => 'view', $contact->member_user->id]) : '' ?></td>

                <td><?= h($contact->name) ?></td>
                <td><?= h($contact->email) ?></td>
                <td>
                    <?php
                    $text = h($contact->content);
                    $limit = 5;
                    if(mb_strlen($text) > $limit) {
                        $title = mb_substr($text,0,$limit);
                        echo $title. '･･･';
                    } else {
                        echo $text;
                    }
                    ?>
                </td>

                <td><?= h($contact->reply_states_flag) ?></td>
                <td><?= h($contact->created_at) ?></td>
                <td><?= h($contact->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('返信'), ['action' => 'reply', $contact->id]) ?>
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
