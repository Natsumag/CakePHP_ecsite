<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>

<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($contact); ?>
    <fieldset>
        <legend><?= __('Reply Contact') ?></legend>
        <ul>
            <li>Name:<?= h($contact->name); ?><br></li>
            <li>Email:<?= h($contact->email); ?><br></li>
            <li>Content:<?= h($contact->content); ?></li>
            <li>
                Reply_content
                <?= $this->Form->value('reply_content', ['type' => 'textarea']) ?>
            </li>
        </ul>
    </fieldset>
    <?= $this->Form->button('戻る', ['onclick' => 'history.back()', 'type' => 'button']) ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
