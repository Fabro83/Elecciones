<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato $candidato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Candidato'), ['action' => 'edit', $candidato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Candidato'), ['action' => 'delete', $candidato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $candidato->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Candidatos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Candidato'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="candidatos view large-9 medium-8 columns content">
    <h3><?= h($candidato->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($candidato->Nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($candidato->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($candidato->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($candidato->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $candidato->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Mesas') ?></h4>
        <?php if (!empty($candidato->mesas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre Mesa') ?></th>
                <th scope="col"><?= __('Fiscal') ?></th>
                <th scope="col"><?= __('Contacto') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Delete') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($candidato->mesas as $mesas): ?>
            <tr>
                <td><?= h($mesas->id) ?></td>
                <td><?= h($mesas->nombre_mesa) ?></td>
                <td><?= h($mesas->fiscal) ?></td>
                <td><?= h($mesas->contacto) ?></td>
                <td><?= h($mesas->created) ?></td>
                <td><?= h($mesas->modified) ?></td>
                <td><?= h($mesas->delete) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Mesas', 'action' => 'view', $mesas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Mesas', 'action' => 'edit', $mesas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Mesas', 'action' => 'delete', $mesas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mesas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
