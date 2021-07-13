<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MemberUser $memberUser
 */
?>
<div class="adminUsers form large-10 medium-10 columns content">
    <?= $this->Form->create($memberUser, ['url' => ['controller' => 'MemberUsers', 'action' => 'edit']]) ?>
    <fieldset>
        <legend><?= __('Edit Member User') ?></legend>
        <?php
        echo 'ID:';
        echo $this->Number->format($memberUser->id);
        echo '<br>';
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        echo $this->Form->control('zip_code');
        echo $this->Form->control('address');
        echo $this->Form->control('tel');
        echo 'Created At:';
        echo h($memberUser->created_at);
        echo '<br>';
        echo 'Updated At:';
        echo h($memberUser->updated_at);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $memberUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete?', $memberUser->id)]); ?>
</div>
