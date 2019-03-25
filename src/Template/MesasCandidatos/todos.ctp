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

        $scope.tipo_grafico = <?php echo json_encode($tipo_grafico) ?>;
        $scope.gobernadores  = <?php echo json_encode($gobernadores) ?>;
     
        $scope.datagob = [];

        angular.forEach($scope.gobernadores, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos*100/totVotos($scope.gobernadores)};
            $scope.datagob.push(aux);
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
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        dataPoints: $scope.datagob
                     }
                ]
            });
            chart.render();
        }


        $scope.proporcionales = <?php echo json_encode($proporcionales) ?>;
        $scope.dataprop = [];
        
        angular.forEach($scope.proporcionales, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos*100/totVotos($scope.proporcionales)};
            $scope.dataprop.push(aux);            
        });
      
        $scope.pro = function () {
            var chart = new CanvasJS.Chart("propData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Diputados proporcionales"              
                },
                data: [              
                    {
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        dataPoints: $scope.dataprop
                    }
                ]
            });
            chart.render();
        }

        $scope.provinciales = <?php echo json_encode($provinciales) ?>;
        $scope.dataprov = [];
        
        angular.forEach($scope.provinciales, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos*100/totVotos($scope.provinciales)};
            $scope.dataprov.push(aux);
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
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        dataPoints: $scope.dataprov
                    }
                ]
            });
            chart.render();
        }
        
        $scope.intendentes = <?php echo json_encode($intendentes) ?>;
        $scope.dataint = [];

        angular.forEach($scope.intendentes, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos*100/totVotos($scope.intendentes)};
            $scope.dataint.push(aux);
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
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        dataPoints: $scope.dataint
                    }
                ]
            });
            chart.render();
        }

        $scope.concejales = <?php echo json_encode($concejales) ?>;
        $scope.datacon = [];

        angular.forEach($scope.concejales, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos*100/totVotos($scope.concejales)};
            $scope.datacon.push(aux);
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
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        dataPoints: $scope.datacon
                    }
                ]
            });
            chart.render();
        }

       
    });

function totVotos (aux)
{
    var acu =0;
    for (let i = 0; i < aux.length; i++) {
        acu = acu + aux[i].cantidad_votos;
        
    }
    return (acu);
}
</script>