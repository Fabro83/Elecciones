<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Establecimiento $establecimiento
 */
?>
<div class="establecimientos view large-9 medium-8 columns content">
    <?php //echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-flash']).' ',['controller'=>'mesas_candidatos','action' => 'paraestablecimientos',2, $establecimiento->id],['class' => 'btn btn-primary', 'role' => 'button' , 'escape' => false]);?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Establecimiento:   ') ?></th>
            <td><?= h($establecimiento->nombre_establecimiento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fiscal: ') ?></th>
            <td><?= h($establecimiento->fiscal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contacto: ') ?></th>
            <td><?= h($establecimiento->contacto) ?></td>
        </tr>
        
    </table>
    <div class="related">
        <?php if (!empty($establecimiento->mesas)): ?>
        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre_mesa') ?></th>
                <th scope="col">Porcentaje de votantes</th>
                <th scope="col"><?= $this->Paginator->sort('fiscal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contacto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($establecimiento->mesas as $mesa): ?>
            <tr>
                <td><?= h($mesa->nombre_mesa) ?></td>
                <td><div class="progress" style="font-size: 0.95rem;height: 2rem;">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo ($this->Number->format($mesa->total_votantes) - $this->Number->format($mesa->parcial_votantes)); ?>"
                    aria-valuemin="0" aria-valuemax="100" style="width:<?php echo (($mesa->parcial_votantes * 100) / $mesa->total_votantes); ?>%;    background-color: #089c22a8;color: #3c2525;font-family: initial;">
                    <?php echo ($this->Number->toPercentage((($mesa->parcial_votantes * 100) / $mesa->total_votantes)));?>
                    </div>
                </div></td>
                <td><?= h($mesa->fiscal) ?></td>
                <td><?= h($mesa->contacto) ?></td>
                <td><?php echo date('H:m', strtotime($mesa->modified));?></td>                
                <!-- <td class="actions"> -->
                <?php //echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-stats']).' ',['controller' => 'mesas_candidatos', 'action' => 'paramesas', 1,$mesa->id],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?>
                <?php //echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-record']).' ',['controller' => 'mesas_candidatos', 'action' => 'paramesas', 2,$mesa->id],['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]);?>
                <?php //echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-pencil']).' ',['controller' => 'mesas', 'action' => 'edit', $mesa->id],['class' => 'btn btn-danger', 'role' => 'button' , 'escape' => false]);?>
            <!-- </td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <?php endif; ?>
    </div>
</div>
