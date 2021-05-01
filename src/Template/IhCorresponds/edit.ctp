<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IhCorrespond $ihCorrespond
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ihCorrespond->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ihCorrespond->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ih Corresponds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ihCorresponds form large-9 medium-8 columns content">
    <?= $this->Form->create($ihCorrespond) ?>
    <fieldset>
        <legend><?= __('Edit Ih Correspond') ?></legend>
        <?php
            echo $this->Form->control('type');
        ?>
        <div hidden>
            <?php
            echo $this->Form->control('created_at');
            echo $this->Form->control('updated_at', ['empty' => true]);
            ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
