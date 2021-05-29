<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $category->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categories form large-9 medium-8 columns content">
    <?= $this->Form->create($category, ['type' => 'file']); ?>
    <fieldset>
        <legend><?= __('Edit Category') ?></legend>
        <p>ID:<?= $this->Number->format($category->id) ?></p>
        <?php
            echo $this->Form->control('ih_correspond_id', ['options' => $ihCorrespods]);
            echo $this->Form->control('material_id', ['options' => $materials]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            if ($category->file_name1) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name1, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before1',['type'=>'hidden', "value"=>$category->file_name1]);
            }
            echo $this->Form->control('file_name1', ['type' => 'file']);
            if ($category->file_name2) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name2, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before2',['type'=>'hidden', "value"=>$category->file_name2]);
            }
            echo $this->Form->control('file_name2', ['type' => 'file']);
            if ($category->file_name3) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name3, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before3',['type'=>'hidden', "value"=>$category->file_name3]);
            }
            echo $this->Form->control('file_name3', ['type' => 'file']);
            if ($category->file_name4) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name4, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before4',['type'=>'hidden', "value"=>$category->file_name4]);
            }
            echo $this->Form->control('file_name4', ['type' => 'file']);
            if ($category->file_name5) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name5, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before5',['type'=>'hidden', "value"=>$category->file_name5]);
            }
            echo $this->Form->control('file_name5', ['type' => 'file']);



        ?>

    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
