<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $notice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $notice->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Notices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notice'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($notice); ?>
    <fieldset>
        <legend><?= __('Edit Notice') ?></legend>
        <?php
        echo $this->Form->control('event_date');
        echo $this->Form->control('content');
        echo $this->Form->control('detail');
        ?>

    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
