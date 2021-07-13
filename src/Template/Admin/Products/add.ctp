<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="products form large-10 medium-10 columns content">
    <?= $this->Form->create($product); ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('category_id', ['options' => $categories]);
            echo $this->Form->control('name');
            echo $this->Form->control('price');
            echo $this->Form->control('units_in_stock');
            echo $this->Form->control('number_of_units_sold');
            echo $this->Form->control('size_circle');
            echo $this->Form->control('size_rectangle');
            echo $this->Form->control('thickness');
            echo $this->Form->control('height');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
