<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */
?>
<div class="products form large-10 medium-10 columns content">
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
