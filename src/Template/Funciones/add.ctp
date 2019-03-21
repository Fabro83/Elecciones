<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Funcione $funcione
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Funciones'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="funciones form large-9 medium-8 columns content">
    <?= $this->Form->create($funcione) ?>
    <fieldset>
        <legend><?= __('Add Funcione') ?></legend>
        <?php
            echo $this->Form->control('nombre');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
