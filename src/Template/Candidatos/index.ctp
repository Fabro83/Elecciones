<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato[]|\Cake\Collection\CollectionInterface $candidatos
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <div class="pb-5">
        <?= $this->Html->link(__('Nuevo Candidato'), ['action' => 'add'],['class'=>'btn btn-primary']) ?>
    </div>
</nav>
<div class="candidatos index large-9 medium-8 columns content">
    <h3><?= __('Candidatos') ?></h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Funcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Partido') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidatos as $candidato): ?>
            <tr>
                <td><?= $this->Number->format($candidato->id) ?></td>
                <td><?= h($candidato->Nombre) ?></td>
                <td><?= h($candidato->funcione['nombre']) ?></td>
                <td><?= h($candidato->partido['name']) ?></td>
                <td class="actions">
                    <?php //echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-eye-open']).' ',['controller' => 'candidatos', 'action' => 'view', $candidato->id],['class' => 'btn btn-warning', 'role' => 'button' , 'escape' => false]);?>
                    <?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-pencil']).' ',['controller' => 'candidatos', 'action' => 'edit', $candidato->id],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'candidatos', 'action' => 'delete', $candidato->id], ['confirm' => __('Quiere eliminar el candidato # {0}?', $candidato->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
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
