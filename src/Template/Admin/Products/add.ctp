<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ih Corresponds'), ['controller' => 'IhCorresponds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ih Correspond'), ['controller' => 'IhCorresponds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product, ['type' => 'file']); ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('category_id', ['options' => $categories]);
            echo $this->Form->control('ih_correspond_id', ['options' => $ihCorresponds]);
            echo $this->Form->control('material_id', ['options' => $materials]);
            echo $this->Form->control('name');
            echo $this->Form->control('price');
            echo $this->Form->control('units_in_stock');
            echo $this->Form->control('number_of_units_sold');
            echo $this->Form->control('description');
            echo $this->Form->control('size');
            echo $this->Form->control('thickness');
            echo $this->Form->control('file_name1', ['type'=>'file']);
            echo $this->Form->control('file_name2', ['type'=>'file']);
            echo $this->Form->control('file_name3', ['type'=>'file']);
            echo $this->Form->control('file_name4', ['type'=>'file']);
            echo $this->Form->control('file_name5', ['type'=>'file']);
            echo $this->Form->control('file_name6', ['type'=>'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
