<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdminUser $adminUser
 */
?>
<div class="adminUsers form large-10 medium-10 columns content">
    <?= $this->Form->create($adminUser) ?>
    <fieldset>
        <legend><?= __('Add Admin User') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>

    </fieldset>

    <?= $this->Html->link(__('List Admin Users'), ['action' => 'index']) ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
