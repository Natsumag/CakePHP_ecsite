<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>

<div class="purchaseHistories form large-10 medium-10 columns content">
    <?= $this->Form->create($contact, ['type' => 'post', 'url' => ['controller' => 'Contacts', 'action' => 'confirm']]) ?>
    <fieldset>
        <legend><?= __('お問い合わせ内容の確認') ?></legend>
        <p>name:<?= h($contact->content) ?></p>
        <p>email:<?= h($contact->name) ?></p>
        <p>content:<?= h($contact->email) ?></p>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button('修正する', ['onclick' => 'history.back()', 'type' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
