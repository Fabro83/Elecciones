<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato[]|\Cake\Collection\CollectionInterface $candidatos
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <div class="pb-5">
        <?= $this->Html->link(__('Nueva Mesa'), ['action' => 'add'],['class'=>'btn btn-primary']) ?>
    </div>
</nav>
<div class="mesa index large-9 medium-8 columns content">
    <h3><?= __('mesa') ?></h3>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre_mesa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fiscal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contacto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Establecimiento') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mesas as $mesa): ?>
            <tr>
            <td><?= $this->Number->format($mesa->id) ?></td>
                <td><?= h($mesa->nombre_mesa) ?></td>
                <td><?= h($mesa->fiscal) ?></td>
                <td><?= h($mesa->contacto) ?></td>
                <td><?php echo date('d/m H:m', strtotime($mesa->modified));?></td>
                <td><?= h($mesa->establecimiento['nombre_establecimiento']) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-pencil']).' ',['controller' => 'mesas', 'action' => 'edit', $mesa->id],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'establecimientos', 'action' => 'delete', $mesa->id], ['confirm' => __('Quiere eliminar el candidato # {0}?', $mesa->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('ulitmo') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, mostrando {{current}} almacenados(s) de {{count}} total')]) ?></p>
    </div>
</div>
