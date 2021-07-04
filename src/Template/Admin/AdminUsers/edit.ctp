<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdminUser $adminUser
 */
?>
<div class="adminUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($adminUser, ['url' => ['controller' => 'AdminUsers', 'action' => 'edit']]) ?>
    <fieldset>
        <legend><?= __('Edit Admin User') ?></legend>
        <?php
            echo 'ID<br>';
            echo $this->Number->format($adminUser->id);
            echo '<br>';
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo 'Created At<br>';
            echo h($adminUser->created_at);
            echo '<br>';
            echo 'Updated At<br>';
            echo h($adminUser->updated_at);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?php if (h($adminUser->delete_flag) == false) {
        echo $this->Form->postLink(__('削除'), ['action' => 'delete', $adminUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]);
    } else {
        echo $this->Form->postLink(__('削除取り消し'), ['action' => 'delete', $adminUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]);
    } ?>
    <?= $this->Html->link(__('一覧へ戻る'), ['action' => 'index']) ?>

</div>
