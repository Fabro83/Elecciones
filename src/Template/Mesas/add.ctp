<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mesa $mesa
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Mesas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mesas form large-9 medium-8 columns content">
    <?= $this->Form->create($mesa) ?>
    <fieldset>
        <legend><?= __('Add Mesa') ?></legend>
        <?php
            echo $this->Form->control('nombre_mesa');
            echo $this->Form->control('fiscal');
            echo $this->Form->control('contacto');
            echo $this->Form->control('delete');
            echo $this->Form->control('establecimiento_id');
            echo $this->Form->control('candidatos._ids', ['options' => $candidatos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
