<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ih Corresponds'), ['controller' => 'IhCorresponds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ih Correspond'), ['controller' => 'IhCorresponds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ih Correspond') ?></th>
            <td><?= $product->has('ih_correspond') ? $this->Html->link($product->ih_correspond->type, ['controller' => 'IhCorresponds', 'action' => 'view', $product->ih_correspond->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= $product->has('material') ? $this->Html->link($product->material->material, ['controller' => 'Materials', 'action' => 'view', $product->material->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= h($product->size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($product->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Units In Stock') ?></th>
            <td><?= $this->Number->format($product->units_in_stock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Units Sold') ?></th>
            <td><?= $this->Number->format($product->number_of_units_sold) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thickness') ?></th>
            <td><?= $this->Number->format($product->thickness) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($product->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($product->updated_at) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name1') ?></h4>
        <?= $this->Text->autoParagraph(h($product->file_name1)); ?>
        <?= $this->Html->image('../files/Products/image/'.$product->file_name1, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name2') ?></h4>
        <?= $this->Text->autoParagraph(h($product->file_name2)); ?>
        <?= $this->Html->image('../files/Products/image/'.$product->file_name2, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name3') ?></h4>
        <?= $this->Text->autoParagraph(h($product->file_name3)); ?>
        <?= $this->Html->image('../files/Products/image/'.$product->file_name3, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name4') ?></h4>
        <?= $this->Text->autoParagraph(h($product->file_name4)); ?>
        <?= $this->Html->image('../files/Products/image/'.$product->file_name4, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name5') ?></h4>
        <?= $this->Text->autoParagraph(h($product->file_name5)); ?>
        <?= $this->Html->image('../files/Products/image/'.$product->file_name5, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name6') ?></h4>
        <?= $this->Text->autoParagraph(h($product->file_name6)); ?>
        <?= $this->Html->image('../files/Products/image/'.$product->file_name6, array('height' => 100, 'width' => 100)); ?>
    </div>
</div>
