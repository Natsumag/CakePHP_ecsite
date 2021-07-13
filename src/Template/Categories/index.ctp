<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>

<div class="categories index large-10 medium-10 columns content">
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
            <?php foreach ($categories as $categorie): ?>
                <tr>
                    <td><?= $this->Html->image('../files/Categories/image/'.$categorie->file_name1, array('height' => 100, 'width' => 100)) ?></td>
                    <td><?= h($categorie->name) ?></td>
                    <td>
                        <?php foreach ($related_products as $related_product):
                            if(($related_product->category_id) == ($categorie->id)):
                                echo $related_product->price . ',';
                            endif;
                        endforeach; ?>
                    </td>
                    <?php if(h($categorie->ih_correspond_id) === 1): ?>
                        <td><?= $ihCorrespods[1] ?></td>
                    <?php elseif(h($categorie->ih_correspond_id) === 2): ?>
                        <td><?= $ihCorrespods[2] ?></td>
                    <?php elseif(h($categorie->ih_correspond_id) === 3): ?>
                        <td><?= $ihCorrespods[3] ?></td>
                    <?php else: ?>
                        <td><?= $ihCorrespods[4] ?></td>
                    <?php endif; ?>
                    <td>
                        <?php foreach ($related_products as $related_product):
                            if(($related_product->category_id) == ($categorie->id)):
                                if(isset($cart->size_circle)):
                                    echo h($related_product->size_circle) . ',';
                                else:
                                    echo h($related_product->size_rectangle) . ',';
                                endif;
                            endif;
                        endforeach; ?>
                    </td>
                    <td><?= $categorie->material ?></td>
                    <td><?= h($categorie->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $categorie->id]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
