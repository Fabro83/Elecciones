<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidatostwo[]|\Cake\Collection\CollectionInterface $candidatostwo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Candidatostwo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partidos'), ['controller' => 'Partidos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partido'), ['controller' => 'Partidos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="candidatostwo index large-9 medium-8 columns content">
    <h3><?= __('Candidatostwo') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete') ?></th>
                <th scope="col"><?= $this->Paginator->sort('funcion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('partido_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidatostwo as $candidatostwo): ?>
            <tr>
                <td><?= $this->Number->format($candidatostwo->id) ?></td>
                <td><?= h($candidatostwo->Nombre) ?></td>
                <td><?= h($candidatostwo->created) ?></td>
                <td><?= h($candidatostwo->modified) ?></td>
                <td><?= h($candidatostwo->delete) ?></td>
                <td><?= $this->Number->format($candidatostwo->funcion_id) ?></td>
                <td><?= $candidatostwo->has('partido') ? $this->Html->link($candidatostwo->partido->name, ['controller' => 'Partidos', 'action' => 'view', $candidatostwo->partido->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $candidatostwo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $candidatostwo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $candidatostwo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatostwo->id)]) ?>
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
