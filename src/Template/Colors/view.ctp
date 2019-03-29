<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Color'), ['action' => 'edit', $color->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Color'), ['action' => 'delete', $color->id], ['confirm' => __('Are you sure you want to delete # {0}?', $color->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Colors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Color'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partidos'), ['controller' => 'Partidos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partido'), ['controller' => 'Partidos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="colors view large-9 medium-8 columns content">
    <h3><?= h($color->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($color->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Html') ?></th>
            <td><?= h($color->html) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partido') ?></th>
            <td><?= $color->has('partido') ? $this->Html->link($color->partido->name, ['controller' => 'Partidos', 'action' => 'view', $color->partido->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($color->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($color->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($color->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $color->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
