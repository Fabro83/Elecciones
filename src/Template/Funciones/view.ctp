<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Funcione $funcione
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Funcione'), ['action' => 'edit', $funcione->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Funcione'), ['action' => 'delete', $funcione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $funcione->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Funciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Funcione'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="funciones view large-9 medium-8 columns content">
    <h3><?= h($funcione->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($funcione->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($funcione->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($funcione->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($funcione->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $funcione->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
