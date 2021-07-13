<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

<div class="categories form large-10 medium-10 columns content">
    <?= $this->Form->create($category, ['type' => 'file']); ?>
    <fieldset>
        <legend><?= __('Add Category') ?></legend>
        <?php
        echo $this->Form->control('ih_correspond_id', ['options' => $ihCorrespods]);
        ?>
        <div class="input select">
            <label for="material-id">Material</label>
            <select name="material_id" id="material-id">
                <?php
                $this->Form->unlockField('material_id');
                foreach ($materials as $material) {
                    echo '<option value='. $material['id'] .'>'. $material['material'] .'</option>';
                }
                ?>
            </select>
        </div>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('description');
        echo $this->Form->control('file_name1', ['type'=>'file', 'required' => true]);
        echo $this->Form->control('file_name2', ['type'=>'file']);
        echo $this->Form->control('file_name3', ['type'=>'file']);
        echo $this->Form->control('file_name4', ['type'=>'file']);
        echo $this->Form->control('file_name5', ['type'=>'file']);
        ?>

    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
