<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Establecimiento $establecimiento
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Establecimiento'), ['action' => 'edit', $establecimiento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Establecimiento'), ['action' => 'delete', $establecimiento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $establecimiento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Establecimientos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Establecimiento'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="establecimientos view large-9 medium-8 columns content">
    <h3><?= h($establecimiento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre Establecimiento') ?></th>
            <td><?= h($establecimiento->nombre_establecimiento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fiscal') ?></th>
            <td><?= h($establecimiento->fiscal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contacto') ?></th>
            <td><?= h($establecimiento->contacto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($establecimiento->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($establecimiento->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($establecimiento->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete') ?></th>
            <td><?= $establecimiento->delete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Mesas') ?></h4>
        <?php if (!empty($establecimiento->mesas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre Mesa') ?></th>
                <th scope="col"><?= __('Fiscal') ?></th>
                <th scope="col"><?= __('Contacto') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Delete') ?></th>
                <th scope="col"><?= __('Establecimiento Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($establecimiento->mesas as $mesas): ?>
            <tr>
                <td><?= h($mesas->id) ?></td>
                <td><?= h($mesas->nombre_mesa) ?></td>
                <td><?= h($mesas->fiscal) ?></td>
                <td><?= h($mesas->contacto) ?></td>
                <td><?= h($mesas->created) ?></td>
                <td><?= h($mesas->modified) ?></td>
                <td><?= h($mesas->delete) ?></td>
                <td><?= h($mesas->establecimiento_id) ?></td>
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
