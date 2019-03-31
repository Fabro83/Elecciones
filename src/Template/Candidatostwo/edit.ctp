<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidatostwo $candidatostwo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $candidatostwo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $candidatostwo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Candidatostwo'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Partidos'), ['controller' => 'Partidos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partido'), ['controller' => 'Partidos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="candidatostwo form large-9 medium-8 columns content">
    <?= $this->Form->create($candidatostwo) ?>
    <fieldset>
        <legend><?= __('Edit Candidatostwo') ?></legend>
        <?php
            echo $this->Form->control('Nombre');
            echo $this->Form->control('delete');
            echo $this->Form->control('url');
            echo $this->Form->control('funcion_id');
            echo $this->Form->control('partido_id', ['options' => $partidos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
