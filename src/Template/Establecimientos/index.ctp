<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Establecimiento[]|\Cake\Collection\CollectionInterface $establecimientos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Establecimiento'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="establecimientos index large-9 medium-8 columns content">
    <h3><?= __('Establecimientos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre_establecimiento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fiscal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contacto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($establecimientos as $establecimiento): ?>
            <tr>
                <td><?= $this->Number->format($establecimiento->id) ?></td>
                <td><?= h($establecimiento->nombre_establecimiento) ?></td>
                <td><?= h($establecimiento->fiscal) ?></td>
                <td><?= h($establecimiento->contacto) ?></td>
                <td><?= h($establecimiento->created) ?></td>
                <td><?= h($establecimiento->modified) ?></td>
                <td><?= h($establecimiento->delete) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $establecimiento->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $establecimiento->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $establecimiento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $establecimiento->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
