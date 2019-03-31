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
        <div class="card-header" ng-init="cargar()">Agregar Votos</div>
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
            <div ng-if="bandera"  class="progress mb-5">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <alert-message alert="alertMessage"></alert-message>
            <center>
                <button type="button" ng-click="saved()" class="btn  btn-lg btn-success btn-block">
                    <!-- <i class="glyphicon glyphicon-save"></i> -->Guardar
                </button>
            </center>
        </div>        
    </div>
    


<script type="text/javascript">
mainApp.directive("alertMessage", function($compile) {
    return {
        scope: {
            alert: "="
        },
        link: function (scope, element) {
            // Actualiza el mensaje de alerta cada vez que el objeto es modificado.
            scope.$watch('alert', function () {
                updateAlert();
            });
 
            // Cerrar mensaje de alerta
            scope.close = function() {
                scope.alert = null;
            }
 
            function updateAlert() {
                var html = "";
 
                if (scope.alert) {
                    var icon = null;
 
                    switch (scope.alert.type) {
                        case 'success': {
                            icon = 'ok-sign';
                        } break;
                        case 'warning': {
                            icon = 'exclamation-sign';
                        } break;
                        case 'info': {
                            icon = 'info-sign';
                        } break;
                        case 'danger': {
                            icon = 'remove-sign';
                        } break;
                    }
 
                    html = "<div class='alert alert-" + scope.alert.type + "' role='alert'>";
 
                    if (scope.alert.closable) {
                        html += "<button type='button' class='close' data-dismiss='alert' ng-click='close()' aria-label='Close'><span aria-hidden='true'></span></button>";
                    }
 
                    if (icon) {
                        html += "<span style='padding-right: 5px;' class='glyphicon glyphicon-" + icon + "' aria-hidden='true'></span>";
                    }
 
                    html += scope.alert.text;
                    html += "</div>";
                }
 
                var newElement = angular.element(html);
                var compiledElement = $compile(newElement)(scope);
 
                element.html(compiledElement);
 
                if (scope.alert && scope.alert.delay > 0) {
                    setTimeout(function () {
                        scope.alert = null;
                        scope.$apply();
                    }, scope.alert.delay * 1000);
                }
            }
        }
     }
});
    mainApp.controller('getInd', function($scope,$http){
        
        $scope.result = 0;
        $scope.mesa_elegida=0;      
        $scope.mesas = [];
        $scope.bandera = false;
        $scope.establecimientos = <?php echo json_encode($establecimientos) ?>;
        $scope.candidatos = <?php echo json_encode($candidatos) ?>;
        $scope.establecimientos_copia = $scope.establecimientos.slice();
        $scope.establecimientos_arre = [];
        $scope.establecimientos_arre = carga_establecimiento($scope.establecimientos_copia);
        //console.log($scope.establecimientos);
        
        $scope.candidatos_gobernadores = [];
        $scope.candidatos_dipu_propo = [];
        $scope.candidatos_dipu_provin = [];
        $scope.candidatos_intendentes = [];
        $scope.candidatos_concejales = [];
        pone_cero();        
        
        function carga_establecimiento (aux){
            var arre = [];
            angular.forEach(aux, function(value, key) {
                var aux = {'id':value.id,'nombre_establecimiento':value.nombre_establecimiento};
                arre.push(aux);
                //console.log(value.id + ': ' + value.nombre_establecimiento);
            });
            return arre;
        }
        function pone_cero() {
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
            });
        }
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

        $scope.saved = function (){     
            //VERIFICAR POR CADA ARREGLO DE CANDIDATOS SI HAY UN VOTO VACIO
            if(($scope.result != 0) && ($scope.mesa_elegida !=0)){
                $scope.bandera = true;             
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
                for (let index = 0; index < $scope.candidatos_concejales.length; index++) {
                    var aux = {'candidato_id':$scope.candidatos_concejales[index].id,'mesa_id':$scope.mesa_elegida,'votos':$scope.candidatos_concejales[index].cantidad_voto};
                    guardar.push(aux);
                }
                console.log(guardar);
                var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
                console.log(csrfToken);
                $http({
                    headers: {
                        'X-CSRF-Token': csrfToken,
                    },
                    method : "POST",
                    url : "<?php echo Router::url(array('controller' => 'mesas_candidatostwo', 'action' => 'add')) ?>",
                    data: guardar,
                }).then(function mySuccess(response) {
                    pone_cero();
                    $scope.mesa_elegida = 0;
                    $scope.bandera = false;
                    showAlert();
                    /*var getUrl = window.location;
                    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
                    window.location.href = baseUrl + "<?php //echo Router::url(array('controller' => 'presupuestos')) ?>";*/
                    //window.location.href = "http://localhost/consultas/presupuestos"
                }, function myError(response) {
                    console.log(response);
                });
            }
            
        }
        function showAlert() {
            $scope.alertMessage =   {
                // 'type' define el aspecto que tendrá el mensaje de alerta.
                type: "success",
                text: "Se guardaron los votos correctamente",
                // Si 'closable' es 'true' se mostrará un botón para ocultar de manera manual el mensaje.
                closable: true,
                // número de segundos antes de que el mensaje de alerta desaparezca de forma automática.
                delay: 7
            };
        };
    });

</script>