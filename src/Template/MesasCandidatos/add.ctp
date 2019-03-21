<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>
<!-- <div class="mesasCandidatos form large-9 medium-8 columns content">
    <?= $this->Form->create($mesasCandidato) ?>
    <fieldset>
        <legend><?= __('Add Mesas Candidato') ?></legend>
        <?php
            //echo $this->Form->control('candidato_id', ['options' => $candidatos]);
            //echo $this->Form->control('mesa_id', ['options' => $mesas]);
            //echo $this->Form->control('votos');
            //echo $this->Form->control('delete');
        ?>
    </fieldset>
    <?php //$this->Form->button(__('Submit')) ?>
    <?php// $this->Form->end() ?>
</div> -->


<div class="card border-success mb-3" ng-controller="getInd">
    <div class="card-header" ng-init="cargar()">Agregar votos</div>
        <alert-message alert="alertMessage"></alert-message>
        <div class="card-body row">
        <div class="form-group col-sm-6">
            <?php //echo $this->Form->control('establecimientos_arre', array( 'label'=>'Establecimiento','class' => 'form-control','ng-model'=>'establecimientos_arre')); ?>
            <label>Establecimientos</label>
            <select ng-model="result" class="form-control" ng-change="update()">
                <option ng-repeat="result in establecimientos_arre"  ng-value="result.id">{{ result.nombre_establecimiento }}</option>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <?php //echo $this->Form->control('establecimientos_arre', array( 'label'=>'Establecimiento','class' => 'form-control','ng-model'=>'establecimientos_arre')); ?>
            <label>Mesas</label>
            <select ng-model="mesa_elegida" class="form-control">
                <option ng-repeat="mesa_elegida in mesas"  ng-value="mesa_elegida.id">{{ mesa_elegida.nombre_mesa }}</option>
            </select>
        </div>
        <div class="p-5" ng-repeat="row in candidatos">
            <div class="form-group col-sm-12">
                <img src="{{row.url}}" class="img-circle mx-auto" width="200" height="200">
                <?php 
                     echo $this->Form->control('votos', array('class' => 'form-control center','label'=>false,'type'=>'number','placeholder'=>'Ingrese votos','ng-model'=>'votos[$index].cantidad_voto'));
                  ?>
            </div>
        </div>        
    </div>
    <center>
            <button type="button" ng-click="saved()" class="btn  btn-lg btn-success btn-block">
                <!-- <i class="glyphicon glyphicon-save"></i> -->Guardar
            </button>
        </center>
</div>

<script type="text/javascript">
    mainApp.controller('getInd', function($scope,$http){

        //debugger;
        $scope.alertMessage = null;
        $scope.votos = [];
        $scope.result = 0;
        $scope.mesa_elegida=0;      
        $scope.mesas = [];
        $scope.establecimientos = <?php echo json_encode($establecimientos) ?>;
        $scope.establecimientos_arre = [];
        angular.forEach($scope.establecimientos, function(value, key) {
            var aux = {'id':value.id,'nombre_establecimiento':value.nombre_establecimiento};
            $scope.establecimientos_arre.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        console.log($scope.establecimientos);

        $scope.candidatos = <?php echo json_encode($candidatos) ?>;
        angular.forEach($scope.candidatos, function(value, key) {
            var aux = {'id':value.id,'cantidad_voto': 0};
            $scope.votos.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        
         console.log($scope.votos);
        
        $scope.update = function() {
            //debugger;
            $scope.mesas = [];
            var indice = $scope.result-1;
            for (let index = 0; index < $scope.establecimientos[indice].mesas.length; index++) {
                var aux = {'id':$scope.establecimientos[indice].mesas[index].id,'nombre_mesa':$scope.establecimientos[indice].mesas[index].nombre_mesa};
                $scope.mesas.push(aux);
            }
            console.log($scope.mesas);
        }

        function showAlert() {
            $scope.alertMessage =   {
                // 'type' define el aspecto que tendrá el mensaje de alerta.
                type: "warning",
                text: "El servicio que quiere guardar ya esta incluido en el presupuesto",
                // Si 'closable' es 'true' se mostrará un botón para ocultar de manera manual el mensaje.
                closable: true,
                // número de segundos antes de que el mensaje de alerta desaparezca de forma automática.
                delay: 7
            };
        };

        $scope.saved = function (){
            debugger;
            var bandera = true;
            if(($scope.result != 0) && ($scope.mesa_elegida !=0)){
                for (let index = 0; index < $scope.votos.length; index++) {
                    if($scope.votos[index].cantidad_voto === 'undefined'){
                        bandera = false;
                    }
                }
                if(bandera){
                    var mesa_id = $scope.mesa_elegida;
                    guardar = [];
                    for (let index = 0; index < $scope.votos.length; index++) {
                        var aux = {'candidato_id':$scope.votos[index].id,'mesa_id':$scope.mesa_elegida,'votos':$scope.votos[index].cantidad_voto};
                        guardar.push(aux);
                    }
                    console.log(guardar);
                    var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
                    $http({
                        headers: {
                            'X-CSRF-Token': csrfToken
                        },
                        method : "POST",
                        url : "<?php echo Router::url(array('controller' => 'mesas_candidatos', 'action' => 'add')) ?>",
                        data: guardar,
                    }).then(function mySuccess(response) {
                        debugger;
                        /*var getUrl = window.location;
                        var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
                        window.location.href = baseUrl + "<?php //echo Router::url(array('controller' => 'presupuestos')) ?>";*/
                        //window.location.href = "http://localhost/consultas/presupuestos"
                    }, function myError(response) {
                        $scope.myWelcome = response.statusText;
                    });
                }
                
            }
            
        }
    });

</script>