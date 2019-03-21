<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Funcione[]|\Cake\Collection\CollectionInterface $funciones
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Funcione'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="funciones index large-9 medium-8 columns content">
    <h3><?= __('Funciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funciones as $funcione): ?>
            <tr>
                <td><?= $this->Number->format($funcione->id) ?></td>
                <td><?= h($funcione->nombre) ?></td>
                <td><?= h($funcione->created) ?></td>
                <td><?= h($funcione->modified) ?></td>
                <td><?= h($funcione->delete) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $funcione->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $funcione->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $funcione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $funcione->id)]) ?>
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
