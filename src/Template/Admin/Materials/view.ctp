<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Material $material
 */
?>
<div class="materials view large-10 medium-10 columns content">
    <h3><?= h($material->material) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($material->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= h($material->material) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($material->updated_at) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Categories') ?></h4>
        <?php if (!empty($related_categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Ih Correspond Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('File') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($related_categories as $category): ?>
            <tr>
                <td><?= h($category->id) ?></td>
                <?php if(h($category->ih_correspond_id) === 1): ?>
                    <td><?= $ihCorrespods[1] ?></td>
                <?php elseif(h($category->ih_correspond_id) === 2): ?>
                    <td><?= $ihCorrespods[2] ?></td>
                <?php elseif(h($category->ih_correspond_id) === 3): ?>
                    <td><?= $ihCorrespods[3] ?></td>
                <?php else: ?>
                    <td><?= $ihCorrespods[4] ?></td>
                <?php endif; ?>
                <td><?= h($category->name) ?></td>
                <td><?= $this->Html->image('../files/Categories/image/'.$category->file_name1, array('height' => 100, 'width' => 100)); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $category->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $category->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
