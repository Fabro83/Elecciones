<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidatostwo $mesasCandidatostwo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mesas Candidatostwo'), ['action' => 'edit', $mesasCandidatostwo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mesas Candidatostwo'), ['action' => 'delete', $mesasCandidatostwo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mesasCandidatostwo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mesas Candidatostwo'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mesas Candidatostwo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mesasCandidatostwo view large-9 medium-8 columns content">
    <h3><?= h($mesasCandidatostwo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Candidato') ?></th>
            <td><?= $mesasCandidatostwo->has('candidato') ? $this->Html->link($mesasCandidatostwo->candidato->id, ['controller' => 'Candidatos', 'action' => 'view', $mesasCandidatostwo->candidato->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mesa') ?></th>
            <td><?= $mesasCandidatostwo->has('mesa') ? $this->Html->link($mesasCandidatostwo->mesa->id, ['controller' => 'Mesas', 'action' => 'view', $mesasCandidatostwo->mesa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mesasCandidatostwo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Votos') ?></th>
            <td><?= $this->Number->format($mesasCandidatostwo->votos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mesasCandidatostwo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mesasCandidatostwo->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $mesasCandidatostwo->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
