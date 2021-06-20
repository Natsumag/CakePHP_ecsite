<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>

<div class="purchaseHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($contact, ['type' => 'post', 'url' => ['controller' => 'Contacts', 'action' => 'add']]) ?>
    <fieldset>
        <legend><?= __('お問い合わせ内容の確認') ?></legend>
        <?= $this->Form->value('content', ['type' => 'textarea']) ?>
        <?php
        echo $this->Form->hidden('member_user_id', ['value' => $contact['id']]);
        echo $this->Form->hidden('name', ['value' => $contact['name']]);
        echo $this->Form->hidden('email', ['value' => $contact['email']]);
        echo $this->Form->hidden('content', ['value' => $contact['content']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>

    <?= $this->Html->link(__('修正する'), ['controller' => 'Contacts', 'action' => 'edit']) ?>
    <?= $this->Form->end() ?>
</div>

