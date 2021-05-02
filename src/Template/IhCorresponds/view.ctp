<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IhCorrespond $ihCorrespond
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ih Correspond'), ['action' => 'edit', $ihCorrespond->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ih Correspond'), ['action' => 'delete', $ihCorrespond->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ihCorrespond->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ih Corresponds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ih Correspond'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ihCorresponds view large-9 medium-8 columns content">
    <h3><?= h($ihCorrespond->type) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ihCorrespond->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($ihCorrespond->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($ihCorrespond->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($ihCorrespond->updated_at) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($ihCorrespond->products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Units In Stock') ?></th>
                <th scope="col"><?= __('Number Of Units Sold') ?></th>
                <th scope="col"><?= __('Size') ?></th>
                <th scope="col"><?= __('File') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($ihCorrespond->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->category_id) ?></td>
                <td><?= h($products->name) ?></td>
                <td><?= h($products->units_in_stock) ?></td>
                <td><?= h($products->number_of_units_sold) ?></td>
                <td><?= h($products->size) ?></td>
                <td><?= $this->Html->image('../files/Products/image/'.$products->file_name1, array('height' => 100, 'width' => 100)); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
