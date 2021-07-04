<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

<div class="categories form large-10 medium-10 columns content">
    <?= $this->Form->create($category, ['type' => 'file']); ?>
    <fieldset>
        <legend><?= __('Add Category') ?></legend>
        <?php
        echo $this->Form->control('ih_correspond_id', ['options' => $ihCorrespods]);
        echo $this->Form->control('material_id', ['options' => $materials]);
        echo $this->Form->control('name');
        echo $this->Form->control('description');
        echo $this->Form->control('file_name1', ['type'=>'file']);
        echo $this->Form->control('file_name2', ['type'=>'file']);
        echo $this->Form->control('file_name3', ['type'=>'file']);
        echo $this->Form->control('file_name4', ['type'=>'file']);
        echo $this->Form->control('file_name5', ['type'=>'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
