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
    </ul>
</nav>
<div class="categories form large-9 medium-8 columns content">
    <?= $this->Form->create($category, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Category') ?></legend>
        <p>ID:<?= $this->Number->format($category->id) ?></p>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            if ($category->file_name){
                echo $this->Html->image('../files/Categories/image/'.$category->file_name, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before',['type'=>'hidden', "value"=>$category->file_name]);

            }
            echo $this->Form->control('file_name', ['type' => 'file']);

        ?>
        <div hidden>
            <?php
            echo $this->Form->control('created_at');
            echo $this->Form->control('updated_at', ['empty' => true]);
            ?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
