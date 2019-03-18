<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Establecimiento $establecimiento
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Establecimientos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="establecimientos form large-9 medium-8 columns content">
    <?= $this->Form->create($establecimiento) ?>
    <fieldset>
        <legend><?= __('Add Establecimiento') ?></legend>
        <?php
            echo $this->Form->control('nombre_establecimiento');
            echo $this->Form->control('fiscal');
            echo $this->Form->control('contacto');
            echo $this->Form->control('delete');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
