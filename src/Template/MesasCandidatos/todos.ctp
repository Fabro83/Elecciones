<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd">
    <div class="card-header" ng-init="cargar()">Graficos</div>
    <div id="gobernadores" style="height: 300px; width: 100%;"></div>
    <div id="propor" style="height: 300px; width: 100%;"></div>
    <div id="prov" style="height: 300px; width: 100%;"></div>
    <div id="inten" style="height: 300px; width: 100%;"></div>
    <div id="conce" style="height: 300px; width: 100%;"></div>
</div>


<script type="text/javascript">
    mainApp.controller('getInd', function($scope,$http){

        //debugger;
        $scope.gobernadores = <?php echo json_encode($gobernadores) ?>;
        $scope.proporcionales = <?php echo json_encode($proporcionales) ?>;
        $scope.provinciales = <?php echo json_encode($provinciales) ?>;
        $scope.intendentes = <?php echo json_encode($intendentes) ?>;
        $scope.concejales = <?php echo json_encode($concejales) ?>;
        //HACER LA FUNCION GENERICA
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