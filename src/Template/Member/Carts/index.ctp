<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cart[]|\Cake\Collection\CollectionInterface $carts
 */
?>

<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Carts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_num') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($carts as $cart): ?>
            <tr>
                <td><?= $this->Number->format($cart->id) ?></td>
                <td><?= $cart->has('product') ? $this->Html->link($cart->product->name, ['controller' => '../generalCategories', 'action' => 'view', $cart->product->category_id]) : '' ?></td>
                <td><?= h($cart->product->price) ?></td>

                <td class="actions">
                    <?= $this->Form->create('null', [ 'type' => 'post', 'url' => ['controller' => 'Carts', 'action' => 'edit']]); ?>
                    <!-- セキュリティコンポーネントのハッシュプロセスを通過しないようにするためunlockedFieldを設定 -->
                    <?php $this->Form->unlockField('product_id'); ?>
                    <input type="hidden" name="product_id" value="<?= h($cart->id) ?>">
                    <?php $this->Form->unlockField('product_num'); ?>
                    <select name="product_num">
                        <?php for($i = 1; $i <= 9; $i++): ?>
                            <option value='<?= $i ?>' <?= $i== $cart->product_num ? 'selected' : '' ?>><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>

                    <?= $this->Form->button(__('Edit')) ?>
                    <?= $this->Form->end() ?>
                </td>

                <td><?= h(($cart->product->price) * ($cart->product_num)) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id)]) ?>
                </td>
                <?php $total += ($cart->product->price) * ($cart->product_num);?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>合計金額：<?= $this->Number->currency($total, "JPY"); ?></p>

    <?= $this->Form->create('null', [ 'type' => 'post', 'url' => ['controller' => 'PurchaseHistories', 'action' => 'add']]); ?>
    <?php $this->Form->unlockField('total_fee'); ?>
    <input type="hidden" name="total_fee" value="<?= h($total) ?>">
    <?php
    foreach ($carts as $key => $cart):
        $product_id = 'product_id_' . $key;
        $product_num = 'product_num_' . $key;
        $this->Form->unlockField( $product_id );
        $this->Form->unlockField( $product_num );
    ?>
        <input type="hidden" name="<?= $product_id; ?>" value="<?= h( $cart->id ) ?>">
        <input type="hidden" name="<?= $product_num; ?>" value="<?= h($cart->product_num) ?>">
    <?php endforeach; ?>
    <?= $this->Html->link(__('商品一覧'), ['controller' => '../generalCategories', 'action' => 'index']) ?>
    <?php if ($this->Number->currency($total, "JPY") !== '¥0'): ?>
        <?= $this->Form->button(__('購入')) ?>
    <?php endif; ?>
    <?= $this->Form->end() ?>
</div>
