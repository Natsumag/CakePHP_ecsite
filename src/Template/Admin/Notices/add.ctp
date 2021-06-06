<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Notices'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="categories form large-9 medium-8 columns content">
    <?= $this->Form->create($notice); ?>
    <fieldset>
        <legend><?= __('Add Notice') ?></legend>
        <?php
        $username = $this->request->getSession()->read('Auth.User.id');
        echo $this->Form->hidden('admin_user_id', ['value' => $username]);
        echo $this->Form->control('event_date');
        echo $this->Form->control('content');
        echo $this->Form->control('detail');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
