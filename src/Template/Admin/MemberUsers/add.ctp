<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MemberUser $memberUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Member Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="memberUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($memberUser) ?>
    <fieldset>
        <legend><?= __('Add Member User') ?></legend>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        echo $this->Form->control('password');
        echo $this->Form->control('zip_code');
        echo $this->Form->control('address');
        echo $this->Form->control('tel');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
