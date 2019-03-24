<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd">
    <div class="card-header">Graficos</div>
    <div id="goberData" ng-init=gob() style="height: 300px; width: 100%;"></div>
    <div id="propData" ng-init=pro() style="height: 300px; width: 100%;"></div>
    <div id="provData" ng-init=prov() style="height: 300px; width: 100%;"></div>
    <div id="intenData" ng-init=inten() style="height: 300px; width: 100%;"></div>
    <div id="conceData" ng-init=conce() style="height: 300px; width: 100%;"></div>
</div>


<script type="text/javascript">
    mainApp.controller('getInd', function($scope,$http){

        //debugger;
        $scope.tipo_grafico = <?php echo json_encode($tipo_grafico) ?>;
        $scope.gobernadores  = <?php echo json_encode($gobernadores) ?>;
        console.log($scope.gobernadores);
        $scope.datagob = [];
        angular.forEach($scope.gobernadores, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos};
            $scope.datagob.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        $scope.gob = function () {
            var chart = new CanvasJS.Chart("goberData", {
                animationEnabled: true, 
		animationDuration: 2000,
                title:{
                    text: "Votos por Gobernador"              
                },
                data: [              
                {
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type: $scope.tipo_grafico,
                    dataPoints: $scope.datagob
                }
                ]
            });
            chart.render();
        }


        $scope.proporcionales = <?php echo json_encode($proporcionales) ?>;
        $scope.dataprop = [];
        angular.forEach($scope.proporcionales, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos};
            $scope.dataprop.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        $scope.pro = function () {
            var chart = new CanvasJS.Chart("propData", {
                animationEnabled: true, 
		animationDuration: 2000,
                title:{
                    text: "Votos por Diputados proporcionales"              
                },
                data: [              
                {
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type: $scope.tipo_grafico,
                    dataPoints: $scope.dataprop
                }
                ]
            });
            chart.render();
        }

        $scope.provinciales = <?php echo json_encode($provinciales) ?>;
        $scope.dataprov = [];
        angular.forEach($scope.provinciales, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos};
            $scope.dataprov.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        $scope.prov = function () {
            var chart = new CanvasJS.Chart("provData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Votos por Diputados provinciales"              
                },
                data: [              
                {
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type: $scope.tipo_grafico,
                    dataPoints: $scope.dataprov
                }
                ]
            });
            chart.render();
        }

        $scope.intendentes = <?php echo json_encode($intendentes) ?>;
        $scope.dataint = [];
        angular.forEach($scope.intendentes, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos};
            $scope.dataint.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        $scope.inten = function () {
            var chart = new CanvasJS.Chart("intenData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Votos por intendentes"              
                },
                data: [              
                {
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type: $scope.tipo_grafico,
                    dataPoints: $scope.dataint
                }
                ]
            });
            chart.render();
        }

        $scope.concejales = <?php echo json_encode($concejales) ?>;
        $scope.datacon = [];
        angular.forEach($scope.concejales, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos};
            $scope.datacon.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        $scope.conce = function () {
            var chart = new CanvasJS.Chart("conceData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Votos por concejales"              
                },
                data: [              
                {
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type: $scope.tipo_grafico,
                    dataPoints: $scope.datacon
                }
                ]
            });
            chart.render();
        }

       
    });

</script>