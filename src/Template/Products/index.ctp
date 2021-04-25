<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Menu') ?></li>
        <li><?= $this->Html->link(__('品物'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="Products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>

    <div class="col text-right"><?= $this->Html->link(__('品物の追加'), ['action' => 'add'], ['class' => 'button']) ?></div>

    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('ih_correspond_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('material_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('units_in_stock') ?></th>
            <th scope="col"><?= $this->Paginator->sort('number_of_units_sold') ?></th>
            <th scope="col"><?= $this->Paginator->sort('description') ?></th>
            <th scope="col"><?= $this->Paginator->sort('size') ?></th>
            <th scope="col"><?= $this->Paginator->sort('thickness') ?></th>
            <th scope="col"><?= $this->Paginator->sort('file_name') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= h($product->category_id) ?></td>
                <td><?= h($product->ih_correspond_id) ?></td>
                <td><?= h($product->material_id) ?></td>
                <td><?= h($product->name) ?></td>
                <td><?= h($product->price) ?></td>
                <td><?= h($product->units_in_stock) ?></td>
                <td><?= h($product->number_of_units_sold) ?></td>
                <td><?= h($product->description) ?></td>
                <td><?= h($product->size) ?></td>
                <td><?= h($product->thickness) ?></td>
                <td><?= h($product->file_name) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
