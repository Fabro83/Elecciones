<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mesasCandidato->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mesasCandidato->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Mesas Candidatos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Candidatos'), ['controller' => 'Candidatos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['controller' => 'Candidatos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Mesas'), ['controller' => 'Mesas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mesa'), ['controller' => 'Mesas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mesasCandidatos form large-9 medium-8 columns content">
    <?= $this->Form->create($mesasCandidato) ?>
    <fieldset>
        <legend><?= __('Edit Mesas Candidato') ?></legend>
        <?php
            echo $this->Form->control('candidato_id', ['options' => $candidatos]);
            echo $this->Form->control('mesa_id', ['options' => $mesas]);
            echo $this->Form->control('votos');
            echo $this->Form->control('delete');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
