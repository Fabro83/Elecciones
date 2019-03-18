<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato $candidato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="candidatos form large-9 medium-8 columns content">
    <?= $this->Form->create($candidato) ?>
    <fieldset>
        <legend><?= __('Add Candidato') ?></legend>
        <?php
            echo $this->Form->control('Nombre');
            echo $this->Form->control('delete');
            echo $this->Form->control('mesas._ids', ['options' => $mesas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
