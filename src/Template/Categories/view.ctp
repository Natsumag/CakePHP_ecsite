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
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($category->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File1') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name1, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File2') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name2, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File3') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name3, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File4') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name4, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File5') ?></th>
            <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name5, array('height' => 100, 'width' => 100)); ?></td>
        </tr>
    </table>

    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($category->products)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Price') ?></th>
                    <th scope="col"><?= __('Size') ?></th>
                    <th scope="col"><?= __('height') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($category->products as $products): ?>
                    <tr>
                        <td><?= h($products->name) ?></td>
                        <td><?= h($products->price) ?></td>
                        <td><?= h($products->height) ?></td>
                        <?php if(h($products->size_circle)): ?>
                        <td><?= h($products->size_circle) ?></td>
                        <?php else: ?>
                        <td><?= h($products->size_rectangle) ?></td>
                        <?php endif; ?>
                        <td class="actions">
                            <?= $this->Form->create('null', [ 'type' => 'post', 'url' => ['controller' => 'Member/Carts', 'action' => 'add']]); ?>
                            <!-- セキュリティコンポーネントのハッシュプロセスを通過しないようにするためunlockedFieldを設定 -->
                            <?php $this->Form->unlockField('product_id'); ?>
                            <input type="hidden" name="product_id" value="<?= h($products->id) ?>">
                            <?php $this->Form->unlockField('product_num'); ?>
                            <select name="product_num">
                                <?php for($i = 1; $i <= 9; $i++) {
                                   echo "<option value='{$i}'>$i</option>";
                                 } ?>
                            </select>
<!--                        --><?//= h($products->number_of_units_sold) ?><!--と照らし合わせて購入数を調節するandカートコントローラorモデルで数を減らす-->
                            <?= $this->Form->button(__('カートに入れる')) ?>
                            <?= $this->Form->end() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php endif; ?>
    </div>
</div>
