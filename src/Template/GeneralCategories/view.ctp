<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */

use Cake\Core\Configure;

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
            <th scope="row"><?= __('File Name1') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name1, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Name2') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name2, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Name3') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name3, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Name4') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name4, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Name5') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name5, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= h($category->material->material) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('対応熱源') ?></th>
            <?php if(h($category->ih_correspond_id) === 1): ?>
                <td><?= $ihCorrespods[1] ?></td>
            <?php elseif(h($category->ih_correspond_id) === 2): ?>
                <td><?= $ihCorrespods[2] ?></td>
            <?php elseif(h($category->ih_correspond_id) === 3): ?>
                <td><?= $category[3] ?></td>
            <?php else: ?>
                <td><?= $ihCorrespods[4] ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <th scope="row"><?= __('説明') ?></th>
            <td><?= $this->Text->autoParagraph(h($category->description)); ?></td>
        </tr>
        <?php foreach ($category->products as $products): ?>
            <tr>
                <th scope="row"><?= __('価格') ?></th>
                <td><?= h($products->price) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('サイズ') ?></th>
                <td><?= h($products->size_circle) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('厚さ') ?></th>
                <td><?= h($products->thickness) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
