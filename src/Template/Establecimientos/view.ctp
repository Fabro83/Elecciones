<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Establecimiento $establecimiento
 */
?>
<div class="establecimientos view large-9 medium-8 columns content">
    <h3><?= h($establecimiento->nombre_establecimiento) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fiscal') ?></th>
            <td><?= h($establecimiento->fiscal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contacto') ?></th>
            <td><?= h($establecimiento->contacto) ?></td>
        </tr>
        
    </table>
    <div class="related">
        <?php if (!empty($establecimiento->mesas)): ?>
        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre_mesa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fiscal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contacto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($establecimiento->mesas as $mesa): ?>
            <tr>
                <td><?= h($mesa->nombre_mesa) ?></td>
                <td><?= h($mesa->fiscal) ?></td>
                <td><?= h($mesa->contacto) ?></td>
                <td><?php echo date('d/m H:m', strtotime($mesa->modified));?></td>
                <td class="actions">
                <?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-eye-open']).' ',['controller' => 'mesas', 'action' => 'individual', $mesa->id],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?>
                <?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-pencil']).' ',['controller' => 'mesas', 'action' => 'edit', $mesa->id],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <?php endif; ?>
    </div>
</div>
