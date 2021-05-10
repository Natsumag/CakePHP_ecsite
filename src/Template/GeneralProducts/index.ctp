<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $generalProducts
 */
?>

<div class="products index large-9 medium-8 columns content">
    <h3><?= __('GeneralProducts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col" class="actions"><?= __('file') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('ih_correspond_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('material_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('units_in_stock') ?></th>
            <th scope="col"><?= $this->Paginator->sort('number_of_units_sold') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= h($product->name) ?></td>
                <td><?= $this->Html->image('../files/Products/image/'.$product->file_name1, array('height' => 100, 'width' => 100)) ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
                <td><?= $product->has('ih_correspond') ? $this->Html->link($product->ih_correspond->type, ['controller' => 'IhCorresponds', 'action' => 'view', $product->ih_correspond->id]) : '' ?></td>
                <td><?= $product->has('material') ? $this->Html->link($product->material->material, ['controller' => 'Materials', 'action' => 'view', $product->material->id]) : '' ?></td>
                <td><?= $this->Number->format($product->units_in_stock) ?></td>
                <td><?= $this->Number->format($product->number_of_units_sold) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                </td>
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
