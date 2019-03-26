<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Establecimiento $establecimiento
 */
?>

<div class="establecimientos form large-9 medium-8 columns content">
    <?= $this->Form->create($establecimiento) ?>
    <fieldset>
        <legend><?= __('Add Establecimiento') ?></legend>
        <?php
            echo $this->Form->control('nombre_establecimiento');
            echo $this->Form->control('fiscal');
            echo $this->Form->control('contacto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
