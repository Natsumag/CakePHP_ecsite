<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="categories form large-10 medium-10 columns content">
    <?= $this->Form->create($category, ['type' => 'file']); ?>
    <fieldset>
        <legend><?= __('Edit Category') ?></legend>
        <p>ID:<?= $this->Number->format($category->id) ?></p>
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
            if ($category->file_name1) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name1, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before1',['type'=>'hidden', "value"=>$category->file_name1]);
            }
            echo $this->Form->control('file_name1', ['type' => 'file']);
            if ($category->file_name2) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name2, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before2',['type'=>'hidden', "value"=>$category->file_name2]);
            }
            echo $this->Form->control('file_name2', ['type' => 'file']);
            if ($category->file_name3) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name3, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before3',['type'=>'hidden', "value"=>$category->file_name3]);
            }
            echo $this->Form->control('file_name3', ['type' => 'file']);
            if ($category->file_name4) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name4, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before4',['type'=>'hidden', "value"=>$category->file_name4]);
            }
            echo $this->Form->control('file_name4', ['type' => 'file']);
            if ($category->file_name5) {
                echo $this->Html->image('../files/Categories/image/'.$category->file_name5, array('height' => 100, 'width' => 100));
                echo $this->Form->control('file_before5',['type'=>'hidden', "value"=>$category->file_name5]);
            }
            echo $this->Form->control('file_name5', ['type' => 'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $category->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $category->id)]); ?>
</div>
