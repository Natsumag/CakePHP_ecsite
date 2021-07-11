<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Material[]|\Cake\Collection\CollectionInterface $materials
 */
?>

<div class="materials index large-10 medium-10 columns content">
    <h3><?= __('Materials') ?></h3>
    <div class="col text-right"><?= $this->Html->link(__('add'), ['action' => 'add'], ['class' => 'button']) ?></div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $material): ?>
            <tr>
                <td><?= $this->Number->format($material->id) ?></td>
                <td><?= h($material->material) ?></td>
                <td><?= h($material->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $material->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $material->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $material->id], ['confirm' => __('Are you sure you want to delete # {0}?', $material->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
