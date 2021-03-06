<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mesa $mesa
 */
?>
<div class="candidatos form large-9 medium-8 columns content">
    <?= $this->Form->create($mesa) ?>
    <fieldset>
        <div class="card border-success mb-3" >
          <div class="card-header">Editar Mesa</div>
          <div class="card-body">
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('nombre_mesa', array('class' => 'form-control','type' => 'text','label'=>false,'placeholder'=>'Numero de mesa'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('fiscal', array('class' => 'form-control','type' => 'text','label'=>false,'placeholder'=>'Fiscal'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('establecimiento_id', array('class' => 'form-control','label'=>false,'options'=>$establecimientos));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('contacto', array('class' => 'form-control','type' => 'text','label'=>false,'placeholder'=>'Contacto'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('total_votantes', array('class' => 'form-control','type' => 'number','placeholder'=>'Totales votantes'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('parcial_votantes', array('class' => 'form-control','type' => 'number','placeholder'=>'Totales parciales'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('total_impugnados', array('class' => 'form-control','type' => 'number','placeholder'=>'Totales impugnados'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('total_escrutados', array('class' => 'form-control','type' => 'number','placeholder'=>'Totales encrutadas'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('total_gobernador', array('class' => 'form-control','type' => 'number','placeholder'=>'Totales Gobernador'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('total_intendente', array('class' => 'form-control','type' => 'number','placeholder'=>'Totales Intendente'));
                  ?>
            </div>
          </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

