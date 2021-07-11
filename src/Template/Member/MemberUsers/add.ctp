<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MemberUser $memberUser
 */
?>
<div class="memberUsers form large-10 medium-10 columns content">
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
