<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Size') ?></th>
            <td><?= $this->Number->format($category->file_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($category->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($category->updated_at) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Name') ?></h4>
        <?= $this->Text->autoParagraph(h($category->name)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($category->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_name)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Type') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_type)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Path') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_path)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($category->products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Ih Correspond Id') ?></th>
                <th scope="col"><?= __('Material Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Units In Stock') ?></th>
                <th scope="col"><?= __('Number Of Units Sold') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Size') ?></th>
                <th scope="col"><?= __('Thickness') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('File Type') ?></th>
                <th scope="col"><?= __('File Path') ?></th>
                <th scope="col"><?= __('File Size') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->category_id) ?></td>
                <td><?= h($products->ih_correspond_id) ?></td>
                <td><?= h($products->material_id) ?></td>
                <td><?= h($products->name) ?></td>
                <td><?= h($products->price) ?></td>
                <td><?= h($products->units_in_stock) ?></td>
                <td><?= h($products->number_of_units_sold) ?></td>
                <td><?= h($products->description) ?></td>
                <td><?= h($products->size) ?></td>
                <td><?= h($products->thickness) ?></td>
                <td><?= h($products->file_name) ?></td>
                <td><?= h($products->file_type) ?></td>
                <td><?= h($products->file_path) ?></td>
                <td><?= h($products->file_size) ?></td>
                <td><?= h($products->created_at) ?></td>
                <td><?= h($products->updated_at) ?></td>
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
