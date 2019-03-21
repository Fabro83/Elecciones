<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Funcione $funcione
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $funcione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $funcione->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Funciones'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="funciones form large-9 medium-8 columns content">
    <?= $this->Form->create($funcione) ?>
    <fieldset>
        <legend><?= __('Edit Funcione') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('delete');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
