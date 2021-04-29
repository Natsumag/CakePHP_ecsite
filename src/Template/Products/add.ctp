<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('品物一覧'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
        echo $this->Form->control('category_id');
        echo $this->Form->control('ih_correspond_id');
        echo $this->Form->control('material_id');
        echo $this->Form->control('name');
        echo $this->Form->control('price');
        echo $this->Form->control('units_in_stock');
        echo $this->Form->control('number_of_units_sold');
        echo $this->Form->control('description');
        echo $this->Form->control('size');
        echo $this->Form->control('thickness');
        echo $this->Form->control('file_name',["type"=>"file"]);
        ?>
        <div hidden>
            <?php
            echo $this->Form->control('created_at');
            echo $this->Form->control('updated_at', ['empty' => true]);
            ?>
        </div>
    </fieldset>

    <button type=“button” onclick="location.href='/ecsite/admin-users/index'">一覧へ戻る</button>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
