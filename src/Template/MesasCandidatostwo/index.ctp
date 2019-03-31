<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidatostwo[]|\Cake\Collection\CollectionInterface $mesasCandidatostwo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Mesas Candidatostwo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mesasCandidatostwo index large-9 medium-8 columns content">
    <h3><?= __('Mesas Candidatostwo') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('candidato_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mesa_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('votos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mesasCandidatostwo as $mesasCandidatostwo): ?>
            <tr>
                <td><?= $this->Number->format($mesasCandidatostwo->id) ?></td>
                <td><?= $mesasCandidatostwo->has('candidato') ? $this->Html->link($mesasCandidatostwo->candidato->id, ['controller' => 'Candidatos', 'action' => 'view', $mesasCandidatostwo->candidato->id]) : '' ?></td>
                <td><?= $mesasCandidatostwo->has('mesa') ? $this->Html->link($mesasCandidatostwo->mesa->id, ['controller' => 'Mesas', 'action' => 'view', $mesasCandidatostwo->mesa->id]) : '' ?></td>
                <td><?= $this->Number->format($mesasCandidatostwo->votos) ?></td>
                <td><?= h($mesasCandidatostwo->created) ?></td>
                <td><?= h($mesasCandidatostwo->modified) ?></td>
                <td><?= h($mesasCandidatostwo->delete) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mesasCandidatostwo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mesasCandidatostwo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mesasCandidatostwo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mesasCandidatostwo->id)]) ?>
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
