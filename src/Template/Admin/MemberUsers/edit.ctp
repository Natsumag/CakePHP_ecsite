<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MemberUser $memberUser
 */
?>
<div class="adminUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($memberUser) ?>
    <fieldset>
        <legend><?= __('Edit Member User') ?></legend>
        <?php
        echo 'ID<br>';
        echo $this->Number->format($memberUser->id);
        echo '<br>';
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        echo $this->Form->control('zip_code');
        echo $this->Form->control('address');
        echo $this->Form->control('tel');
        echo 'Delete_flag<br>';
        if (h($memberUser->delete_flag) == false) {
            echo 'false<br>';
        } else {
            echo 'true<br>';
        }
        echo 'Created At<br>';
        echo h($memberUser->created_at);
        echo '<br>';
        echo 'Updated At<br>';
        echo h($memberUser->updated_at);
        ?>
    </fieldset>
    <?php if (h($memberUser->delete_flag) == false) {
        echo $this->Form->postLink(__('削除'), ['action' => 'delete', $memberUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $memberUser->id)]);
    } else {
        echo $this->Form->postLink(__('削除取り消し'), ['action' => 'delete', $memberUser->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $memberUser->id)]);
    } ?>
    <?= $this->Html->link(__('一覧へ戻る'), ['action' => 'index']) ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
