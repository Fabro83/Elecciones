<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Candidato $candidato
 */
?>
<div class="candidatos form large-9 medium-8 columns content">
    <?= $this->Form->create($candidato) ?>
    <fieldset>
        <div class="card border-success mb-3" >
          <div class="card-header">Editar candidato</div>
          <div class="card-body">
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('Nombre', array('class' => 'form-control','type' => 'text','label'=>false,'placeholder'=>'Nombre del candidato'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('url', array('class' => 'form-control','type' => 'text','label'=>false,'placeholder'=>'Url de la imagen'));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('partido_id', array('class' => 'form-control','type' => 'select','label'=>false,'options' => $partidos));
                  ?>
            </div>
            <div class="form-group ">
              <?php 
                     echo $this->Form->control('funcion_id', array('class' => 'form-control','type' => 'select','label'=>false,'options' => $funciones));
                  ?>
            </div>
          </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
