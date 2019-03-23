<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd">
    <div class="card-header" ng-init="cargar()">Graficos</div>
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
</div>


<script type="text/javascript">
    mainApp.controller('getInd', function($scope,$http){

        //debugger;
        $scope.candidatos = <?php echo json_encode($candidatos) ?>;
        $scope.mesas_candidatos = <?php echo json_encode($mesas_candidatos) ?>;
        console.log($scope.mesas_candidatos);
        var datapoint = [];
        // debugger;
        angular.forEach($scope.mesas_candidatos, function(value, key) {
            var aux = {'label':value.Nombre,'y':value.cantidad_votos};
            datapoint.push(aux);
            //console.log(value.id + ': ' + value.nombre_establecimiento);
        });
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                title:{
                    text: "Votos por candidatos"              
                },
                data: [              
                {
                    // Change type to "doughnut", "line", "splineArea", etc.
                    type: "column",
                    dataPoints: datapoint
                }
                ]
            });
            chart.render();
        }
       
    });

</script>