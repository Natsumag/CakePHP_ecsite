<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>

<div class="categories index large-9 medium-8 columns content">
    <h3><?= __('Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('商品イメージ') ?></th>
                <th scope="col" class="actions"><?= __('商品名') ?></th>
                <th scope="col" class="actions"><?= __('価格') ?></th>
                <th scope="col" class="actions"><?= __('対応熱源') ?></th>
                <th scope="col" class="actions"><?= __('サイズ') ?></th>
                <th scope="col" class="actions"><?= __('素材') ?></th>
                <th scope="col" class="actions"><?= __('特徴') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $categories_arrays = $categories->toArray(); ?>
            <?php foreach ($categories_arrays as $categories_array): ?>
                <tr>
                    <td><?= $this->Html->image('../files/Categories/image/'.$categories_array->file_name1, array('height' => 100, 'width' => 100)) ?></td>
                    <td><?= h($categories_array->name) ?></td>
                    <td><?= $categories_array->products[0]->price; ?></td>
                    <?php if(h($categories_array->ih_correspond_id) === 1): ?>
                        <td><?= $ihCorrespods[1] ?></td>
                    <?php elseif(h($categories_array->ih_correspond_id) === 2): ?>
                        <td><?= $ihCorrespods[2] ?></td>
                    <?php elseif(h($categories_array->ih_correspond_id) === 3): ?>
                        <td><?= $ihCorrespods[3] ?></td>
                    <?php else: ?>
                        <td><?= $ihCorrespods[4] ?></td>
                    <?php endif; ?>
                    <td><?= $categories_array->products[0]->size_circle[0]; ?></td>
                    <td><?= $categories_array->material->material ?></td>
                    <td><?= h($categories_array->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $categories_array->id]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
