<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */

?>
<div class="categories view large-10 medium-10 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ih Correspond') ?></th>
            <?php if(h($category->ih_correspond_id) === 1): ?>
                <td><?= $ihCorrespods[1] ?></td>
            <?php elseif(h($category->ih_correspond_id) === 2): ?>
                <td><?= $ihCorrespods[2] ?></td>
            <?php elseif(h($category->ih_correspond_id) === 3): ?>
                <td><?= $ihCorrespods[3] ?></td>
            <?php else: ?>
                <td><?= $ihCorrespods[4] ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= h($category->material) ?></td>
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
        <h4><?= __('File Name1') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_name1)); ?>
        <?= $this->Html->image('../files/Categories/image/'.$category->file_name1, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name2') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_name2)); ?>
        <?= $this->Html->image('../files/Categories/image/'.$category->file_name2, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name3') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_name3)); ?>
        <?= $this->Html->image('../files/Categories/image/'.$category->file_name3, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name4') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_name4)); ?>
        <?= $this->Html->image('../files/Categories/image/'.$category->file_name4, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="row">
        <h4><?= __('File Name5') ?></h4>
        <?= $this->Text->autoParagraph(h($category->file_name5)); ?>
        <?= $this->Html->image('../files/Categories/image/'.$category->file_name5, array('height' => 100, 'width' => 100)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($related_products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Units In Stock') ?></th>
                <th scope="col"><?= __('Number Of Units Sold') ?></th>
                <th scope="col"><?= __('Size Rectangle') ?></th>
                <th scope="col"><?= __('Size Circle') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($related_products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->name) ?></td>
                <td><?= h($products->units_in_stock) ?></td>
                <td><?= h($products->number_of_units_sold) ?></td>
                <td><?= h($products->size_rectangle) ?></td>
                <td><?= h($products->size_circle) ?></td>
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
