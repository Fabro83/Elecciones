<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato[]|\Cake\Collection\CollectionInterface $candidatos
 */
?>


<div class="mesa index large-9 medium-8 columns content">
    <h3><?= __('Graficos') ?></h3>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">fila</th>
                <th scope="col">Tipo de grafico/th>
                <th scope="col">Boton</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>                
                <td>Todos en Columna</td>
                <td><?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-eye-open']).' ',['controller' => 'mesas_candidatos', 'action' => 'todos',1],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?></td>
            </tr>
            <tr>
                <td>2</td>                
                <td>Todos en torta</td>
                <td><?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-eye-open']).' ',['controller' => 'mesas_candidatos', 'action' => 'todos',2],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?></td>
            </tr>
        </tbody>
    </table>
</div>
