<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdminUser $adminUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Menu') ?></li>
        <li><?= $this->Html->link(__('管理者ユーザ一覧'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="adminUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($adminUser) ?>
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
    <button type=“button” onclick="location.href='/ecsite/Admin-users/index'">一覧へ戻る</button>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Form->postLink(__('削除'), ['action' => 'delete', $adminUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]) ?>
