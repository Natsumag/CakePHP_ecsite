<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */
?>


<div class="categories form large-10 medium-10 columns content">
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
