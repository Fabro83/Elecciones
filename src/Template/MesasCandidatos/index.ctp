<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato[]|\Cake\Collection\CollectionInterface $mesasCandidatos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Mesas Candidato'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mesasCandidatos index large-9 medium-8 columns content">
    <h3><?= __('Mesas Candidatos') ?></h3>
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
            <?php foreach ($mesasCandidatos as $mesasCandidato): ?>
            <tr>
                <td><?= $this->Number->format($mesasCandidato->id) ?></td>
                <td><?= $mesasCandidato->has('candidato') ? $this->Html->link($mesasCandidato->candidato->id, ['controller' => 'Candidatos', 'action' => 'view', $mesasCandidato->candidato->id]) : '' ?></td>
                <td><?= $mesasCandidato->has('mesa') ? $this->Html->link($mesasCandidato->mesa->id, ['controller' => 'Mesas', 'action' => 'view', $mesasCandidato->mesa->id]) : '' ?></td>
                <td><?= $this->Number->format($mesasCandidato->votos) ?></td>
                <td><?= h($mesasCandidato->created) ?></td>
                <td><?= h($mesasCandidato->modified) ?></td>
                <td><?= h($mesasCandidato->delete) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mesasCandidato->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mesasCandidato->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mesasCandidato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mesasCandidato->id)]) ?>
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
