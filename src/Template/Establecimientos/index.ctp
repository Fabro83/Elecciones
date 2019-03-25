<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Establecimiento[]|\Cake\Collection\CollectionInterface $establecimientos
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato[]|\Cake\Collection\CollectionInterface $candidatos
 */
?>
<div class="establecimientos index large-9 medium-8 columns content">
    <h3><?= __('Establecimientos') ?></h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre_establecimiento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fiscal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contacto') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($establecimientos as $establecimiento): ?>
            <tr>
                <td><?= $this->Number->format($establecimiento->id) ?></td>
                <td><?= h($establecimiento->nombre_establecimiento) ?></td>
                <td><?= h($establecimiento->fiscal) ?></td>
                <td><?= h($establecimiento->contacto) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-eye-open']).' ',['action' => 'view', $establecimiento->id],['class' => 'btn btn-success', 'role' => 'button' , 'escape' => false]);?>
                    <?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-pencil']).' ',['action' => 'edit', $establecimiento->id],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
