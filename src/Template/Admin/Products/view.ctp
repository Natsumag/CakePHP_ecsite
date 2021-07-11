<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="products view large-10 medium-10 columns content">
    <h3><?= h($product->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $this->Html->link($product->category_name, ['controller' => 'Categories', 'action' => 'view', $product->category_id]) ?></td>
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
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($product->updated_at) ?></td>
        </tr>
    </table>
</div>
