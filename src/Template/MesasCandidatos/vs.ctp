<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd" ng-init="traeCantidad()" style="border-color: #73a83900 !important;">
<div>
        <label>
            <input type="radio" ng-model="tipoGrafico" value="column" ng-change="funcionGeneral()">
            Columnas
        </label>
        <label>
            <input type="radio" ng-model="tipoGrafico" value="bar" ng-change="funcionGeneral()">
            Barras
        </label>
    </div>
    </br>
    <div id="individual" style="height: 500px; width: 100%;" ng-init="funcionGeneral()">
</div>


<script type="text/javascript">
    mainApp.directive('onFinishRender', ['$timeout', '$parse', function ($timeout, $parse) {
    return {
            restrict: 'A',
            link: function (scope, element, attr) {
                if (scope.$last === true) {
                    $timeout(function () {
                        scope.$emit('funcionGeneral');
                        if ( !! attr.onFinishRender) {
                            $parse(attr.onFinishRender)(scope);
                        }
                    });
                }
            }
        }
    }]);

    mainApp.controller('getInd', function($scope,$http,$timeout){

        $scope.tipoLabel =  "{y}";
        $scope.tipoGrafico =  "bar";
        $scope.General = <?php echo json_encode($funcionario) ?>;
        $scope.funcion_id = (<?php echo json_encode($funcion_id) ?>);
        
        $scope.funcionGeneral = function () {
            
            if ($scope.tipoGrafico ==  "pie") {$scope.tipoGrafico =  "bar";}
            localStorage.setItem('radioButton2', $scope.tipoGrafico); 

            var totVotos = totVotosfunction($scope.General);
            sizeFont = 20;
            var dataP = [];
            var dataC = [];
            var dataPC = [];

            dataPC = dataPointsColor(ruben_vs_garcia($scope.General), totVotos);
            dataP = dataPC[0];
            dataC = dataPC[1];
            setColorCanvas(dataC);
            
            if ($scope.tipoGrafico == "bar") {dataP= dataP.reverse(); dataC = dataC.reverse()}
            
            var chart = new CanvasJS.Chart("individual", {
                colorSet: "personalizado",
                animationEnabled: true, 
                animationDuration: 1200, 
                title:{
                    text: "Grafico"
                    },
                axisX:{
                    labelFontSize: sizeFont
                },
                axisY:{
                    labelFontSize: 0,
                    tickLength: 0
                },
                data: [              
                    {
                        type: $scope.tipoGrafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: $scope.tipoLabel,
                        indexLabelFontSize: sizeFont,
                        dataPoints: dataP
                    }
                ]
            });

            chart.render();
        };//Fin Función General
        
         $scope.reload = function () {            
            $http.get("<?php echo (Router::url(null, true)); ?>/"+$scope.funcion_id)
                .then(function(response) {                     
                });
        };//Fin función Reload
        
        $scope.traeCantidad = function(){
            $http.get("<?php echo (Router::url(['controller' => 'mesas_candidatos','action' => 'cantidad'],false)); ?>")
                .then(function(response) {
                    localStorage.setItem('cantidad', parseInt(response['data'][0]['SUM']));
            });   

            $timeout(function(){
                $scope.traeCantidad();
             
                var cant=localStorage.getItem('cantidad');
                var cant_old = localStorage.getItem('cantidad_old');
           
                if(cant == 'undefined' || isNaN(cant)){
                    localStorage.setItem('cantidad', 0);                    
                }
                if(cant_old == 'undefined' || isNaN(cant_old)){
                    localStorage.setItem('cantidad_old', 0);                    
                }
                if(cant > cant_old){
                    localStorage.setItem('cantidad_old', cant);
                    $scope.reload();
                    window.location.reload(false); 
                }
            },2000)
        };//Fin función Trae Cantidad

        $scope.traeCantidad();
        $scope.tipoGrafico = localStorage.getItem('radioButton2');
    });

//Función que calcula el total de votos
function totVotosfunction (aux){
    var acu =0;
    for (let i = 0; i < aux.length; i++) {
        acu = acu + aux[i].cantidad_votos;
    }
    return (acu);
}

function ruben_vs_garcia(aux) {
    
    var sin_blancos = aux.slice();
    var acum = 0;
    var arre_nuevo = [];
    sin_blancos.splice(aux.length-3,3);
    for (let i = 0; i < sin_blancos.length; i++) {
        if (sin_blancos[i].id == 33 || sin_blancos[i].id == 34){
            arre_nuevo.push(sin_blancos[i]);
        }
    }
    
    arre_nuevo.sort(function(a, b) {
        return b.cantidad_votos - a.cantidad_votos;
    });

    return arre_nuevo;
}

function dataPointsColor(aux,totVotos){
    var dataP=[];    
    var dataC=[];
    var dataPC = [];

    for (let i = 0; i < aux.length; i++) {
        var auxiliar = {'label':aux[i].Nombre,'y':aux[i].cantidad_votos*100/totVotos};
        dataP.push(auxiliar);
        var color = aux[i].color;
        dataC.push(color);      
    }
    dataPC[0] = dataP;
    dataPC[1] = dataC;
    return dataPC;
}

function setColorCanvas(colors){
    CanvasJS.addColorSet("personalizado",colors);
}

</script>