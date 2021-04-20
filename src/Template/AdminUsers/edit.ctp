<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdminUser $adminUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $adminUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Admin Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="adminUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($adminUser) ?>
    <fieldset>
        <legend><?= __('Edit Admin User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('created_at');
            echo $this->Form->control('updated_at', ['empty' => true]);
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Html->link(__('List Admin Users'), ['action' => 'index'], ['class' => 'button']) ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
