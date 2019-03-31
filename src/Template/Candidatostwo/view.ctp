<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidatostwo $candidatostwo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Candidatostwo'), ['action' => 'edit', $candidatostwo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Candidatostwo'), ['action' => 'delete', $candidatostwo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatostwo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Candidatostwo'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidatostwo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partidos'), ['controller' => 'Partidos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partido'), ['controller' => 'Partidos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="candidatostwo view large-9 medium-8 columns content">
    <h3><?= h($candidatostwo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($candidatostwo->Nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partido') ?></th>
            <td><?= $candidatostwo->has('partido') ? $this->Html->link($candidatostwo->partido->name, ['controller' => 'Partidos', 'action' => 'view', $candidatostwo->partido->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($candidatostwo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Funcion Id') ?></th>
            <td><?= $this->Number->format($candidatostwo->funcion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($candidatostwo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($candidatostwo->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $candidatostwo->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Url') ?></h4>
        <?= $this->Text->autoParagraph(h($candidatostwo->url)); ?>
    </div>
</div>
