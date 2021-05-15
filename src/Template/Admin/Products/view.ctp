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
            <?php if(h($product->ih_correspond_id) === 1): ?>
                <td><?= $ihCorrespods[1] ?></td>
            <?php elseif(h($product->ih_correspond_id) === 2): ?>
                <td><?= $ihCorrespods[2] ?></td>
            <?php elseif(h($product->ih_correspond_id) === 3): ?>
                <td><?= $ihCorrespods[3] ?></td>
            <?php else: ?>
                <td><?= $ihCorrespods[4] ?></td>
            <?php endif; ?>

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
            <td><?= h($product->size_circle) ?></td>
        </tr><tr>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= h($product->size_rectangle) ?></td>
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
            <th scope="row"><?= __('Height') ?></th>
            <td><?= $this->Number->format($product->height) ?></td>
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

</div>
