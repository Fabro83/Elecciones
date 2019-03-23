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


    <div class="card border-success p-2 mb-3" ng-controller="getInd">
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
        </div>
        <div class="card border-info mb-3">
            <div class="card-header"><h3 style="text-align:center">Gobernadores</h3></div>
            <div class="card-body row">
                <div ng-repeat="row in candidatos_gobernadores">
                    <div class="form-group p-2">
                        <!-- <img src="{{row.url}}" class="img-circle mx-auto" width="200" height="200"> -->
                        <label>{{row.Nombre}}</label>
                        <?php 
                                echo $this->Form->control('votos', array('class' => 'form-control center','label'=>false,'type'=>'number','placeholder'=>'Ingrese votos','ng-model'=>'row.cantidad_voto'));
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-info mb-3">
            <div class="card-header"><h3 style="text-align:center">Diputados proporcionales</h3></div>
            <div class="card-body row">
                <div ng-repeat="row in candidatos_dipu_propo" >
                    <div class="form-group col-sm-12">
                        <!-- <img src="{{row.url}}" class="img-circle mx-auto" width="200" height="200"> -->
                        <label>{{row.Nombre}}</label>
                        <?php 
                                echo $this->Form->control('votos', array('class' => 'form-control center','label'=>false,'type'=>'number','placeholder'=>'Ingrese votos','ng-model'=>'row.cantidad_voto'));
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-info mb-3">
            <div class="card-header"><h3 style="text-align:center">Diputados provinciales</h3></div>
            <div class="card-body row">
                <div class ng-repeat="row in candidatos_dipu_provin" >
                    <div class="form-group col-sm-12">
                        <!-- <img src="{{row.url}}" class="img-circle mx-auto" width="200" height="200"> -->
                        <label>{{row.Nombre}}</label>
                        <?php 
                                echo $this->Form->control('votos', array('class' => 'form-control center','label'=>false,'type'=>'number','placeholder'=>'Ingrese votos','ng-model'=>'row.cantidad_voto'));
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-info mb-3">
            <div class="card-header"><h3 style="text-align:center">Intendentes</h3></div>
            <div class="card-body row">
                <div ng-repeat="row in candidatos_intendentes" >
                    <div class="form-group col-sm-12">
                        <!-- <img src="{{row.url}}" class="img-circle mx-auto" width="200" height="200"> -->
                        <label>{{row.Nombre}}</label>
                        <?php 
                                echo $this->Form->control('votos', array('class' => 'form-control center','label'=>false,'type'=>'number','placeholder'=>'Ingrese votos','ng-model'=>'row.cantidad_voto'));
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-info mb-3">
            <div class="card-header"><h3 style="text-align:center">Concejales</h3></div>
                <div class="card-body row">
                    <div ng-repeat="row in candidatos_concejales" >
                        <div class="form-group col-sm-12">
                            <!-- <img src="{{row.url}}" class="img-circle mx-auto" width="200" height="200"> -->
                            <label>{{row.Nombre}}</label>
                            <?php 
                                    echo $this->Form->control('votos', array('class' => 'form-control center','label'=>false,'type'=>'number','placeholder'=>'Ingrese votos','ng-model'=>'row.cantidad_voto'));
                                ?>
                        </div>
                    </div>
                </div>
            </div>
            <center>
            <button type="button" ng-click="saved()" class="btn  btn-lg btn-success btn-block">
                <!-- <i class="glyphicon glyphicon-save"></i> -->Guardar
            </button>
        </center>
        </div>        
    </div>
    


<script type="text/javascript">
    mainApp.controller('getInd', function($scope,$http){

        //debugger;
        $scope.alertMessage = null;
        
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
        //console.log($scope.establecimientos);
        $scope.candidatos = <?php echo json_encode($candidatos) ?>;
        $scope.candidatos_gobernadores = [];
        $scope.candidatos_dipu_propo = [];
        $scope.candidatos_dipu_provin = [];
        $scope.candidatos_intendentes = [];
        $scope.candidatos_concejales = [];
        angular.forEach($scope.candidatos, function(value, key) {
            
            if(value.funcion_id == 1){
                var candi = {'id':value.id, 'Nombre':value.Nombre,'cantidad_voto':0};
                $scope.candidatos_gobernadores.push(candi);
            }
            if(value.funcion_id == 2){
                var candi = {'id':value.id, 'Nombre':value.Nombre,'cantidad_voto':0};
                $scope.candidatos_dipu_propo.push(candi);
            }
            if(value.funcion_id == 3){
                var candi = {'id':value.id, 'Nombre':value.Nombre,'cantidad_voto':0};
                $scope.candidatos_dipu_provin.push(candi);
            }
            if(value.funcion_id == 4){
                var candi = {'id':value.id, 'Nombre':value.Nombre,'cantidad_voto':0};
                $scope.candidatos_intendentes.push(candi);
            }
            if(value.funcion_id == 5){
                var candi = {'id':value.id, 'Nombre':value.Nombre,'cantidad_voto':0};
                $scope.candidatos_concejales.push(candi);
            }
            
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        
         console.log($scope.candidatos_dipu_provin);
        
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
            
            //VERIFICAR POR CADA ARREGLO DE CANDIDATOS SI HAY UN VOTO VACIO
            if(($scope.result != 0) && ($scope.mesa_elegida !=0)){                
                var mesa_id = $scope.mesa_elegida;
                guardar = [];
                for (let index = 0; index < $scope.candidatos_gobernadores.length; index++) {
                    var aux = {'candidato_id':$scope.candidatos_gobernadores[index].id,'mesa_id':$scope.mesa_elegida,'votos':$scope.candidatos_gobernadores[index].cantidad_voto};
                    guardar.push(aux);
                }
                for (let index = 0; index < $scope.candidatos_dipu_propo.length; index++) {
                    var aux = {'candidato_id':$scope.candidatos_dipu_propo[index].id,'mesa_id':$scope.mesa_elegida,'votos':$scope.candidatos_dipu_propo[index].cantidad_voto};
                    guardar.push(aux);
                }
                for (let index = 0; index < $scope.candidatos_dipu_provin.length; index++) {
                    var aux = {'candidato_id':$scope.candidatos_dipu_provin[index].id,'mesa_id':$scope.mesa_elegida,'votos':$scope.candidatos_dipu_provin[index].cantidad_voto};
                    guardar.push(aux);
                }
                for (let index = 0; index < $scope.candidatos_intendentes.length; index++) {
                    var aux = {'candidato_id':$scope.candidatos_intendentes[index].id,'mesa_id':$scope.mesa_elegida,'votos':$scope.candidatos_intendentes[index].cantidad_voto};
                    guardar.push(aux);
                }
                console.log(guardar);
                var csrfToken = <?php json_encode($this->request->getParam('_csrfToken')) ;?> 
                console.log(csrfToken);
                $http({
                    headers: {
                        'X-CSRF-Token': 'b5bb609527c89927ad0f111cd29d7194d79b30b0887e6f1b2dfb4b5842543e34cf7efe924d5caba12aac1183002d3ba674777875243009978bf43672a087e2a6',
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
                    console.log(response);
                });
            }
            
        }
    });

</script>