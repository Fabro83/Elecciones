<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partido $partido
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Partido'), ['action' => 'edit', $partido->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Partido'), ['action' => 'delete', $partido->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partido->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Partidos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partido'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="partidos view large-9 medium-8 columns content">
    <h3><?= h($partido->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($partido->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($partido->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($partido->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($partido->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $partido->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Candidatos') ?></h4>
        <?php if (!empty($partido->candidatos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Delete') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Funcion Id') ?></th>
                <th scope="col"><?= __('Partido Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($partido->candidatos as $candidatos): ?>
            <tr>
                <td><?= h($candidatos->id) ?></td>
                <td><?= h($candidatos->Nombre) ?></td>
                <td><?= h($candidatos->created) ?></td>
                <td><?= h($candidatos->modified) ?></td>
                <td><?= h($candidatos->delete) ?></td>
                <td><?= h($candidatos->url) ?></td>
                <td><?= h($candidatos->funcion_id) ?></td>
                <td><?= h($candidatos->partido_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Candidatos', 'action' => 'view', $candidatos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Candidatos', 'action' => 'edit', $candidatos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Candidatos', 'action' => 'delete', $candidatos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidatos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
