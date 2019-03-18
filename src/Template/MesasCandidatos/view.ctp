<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mesas Candidato'), ['action' => 'edit', $mesasCandidato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mesas Candidato'), ['action' => 'delete', $mesasCandidato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mesasCandidato->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mesas Candidatos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mesas Candidato'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mesasCandidatos view large-9 medium-8 columns content">
    <h3><?= h($mesasCandidato->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Candidato') ?></th>
            <td><?= $mesasCandidato->has('candidato') ? $this->Html->link($mesasCandidato->candidato->id, ['controller' => 'Candidatos', 'action' => 'view', $mesasCandidato->candidato->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mesa') ?></th>
            <td><?= $mesasCandidato->has('mesa') ? $this->Html->link($mesasCandidato->mesa->id, ['controller' => 'Mesas', 'action' => 'view', $mesasCandidato->mesa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mesasCandidato->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Votos') ?></th>
            <td><?= $this->Number->format($mesasCandidato->votos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mesasCandidato->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mesasCandidato->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $mesasCandidato->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
