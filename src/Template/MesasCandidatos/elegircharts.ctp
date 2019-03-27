<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato[]|\Cake\Collection\CollectionInterface $candidatos
 */
?>


<div class="mesa index large-9 medium-8 columns content">
    <center><h1><?= __('Gráficos') ?></h1></center>
    <table class="table table-hover" width="100px">
        <tbody>
            <tr>            
                <td>Gráfico de Barras</td>
                <td><?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-eye-open']).' ',['controller' => 'mesas_candidatos', 'action' => 'todos',1],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?></td>
            </tr>
            <tr>              
                <td>Gráfico de Torta</td>
                <td><?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-eye-open']).' ',['controller' => 'mesas_candidatos', 'action' => 'todos',2],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?></td>
            </tr>
        </tbody>
    </table>
</div>
