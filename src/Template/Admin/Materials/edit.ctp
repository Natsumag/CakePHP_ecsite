<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Material $material
 */
?>
<div class="materials form large-10 medium-10 columns content">
    <?= $this->Form->create($material) ?>
    <fieldset>
        <legend><?= __('Edit Material') ?></legend>
        <?php
            echo $this->Form->control('material');
        ?>
        <div hidden>
            <?php
            echo $this->Form->control('created_at');
            echo $this->Form->control('updated_at', ['empty' => true]);
            ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $material->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $material->id)]); ?>
</div>
