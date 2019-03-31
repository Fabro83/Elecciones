<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd" style="border-color: #73a83900 !important;">
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
    <div ng-repeat="gen in General" on-finish-render="funcionGeneral()">
        <div id="{{$index}}" style="height: 400px; width: 100%;">
    </div>
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
    }]);//Fin Directive

    mainApp.controller('getInd', function($scope,$http,$timeout){

        //Inicialización variables globales;
        
        $scope.radioB="1";
        $scope.tipoGrafico="bar";
        $scope.tipoLabel =  "{y}";

        $scope.Title = [];
        $scope.Title.push("Gobernadores", "Intendentes");

        $scope.General = [];
        $scope.General.push(<?php echo json_encode($gobernadores) ?>);
        $scope.General.push(<?php echo json_encode($intendentes) ?>);

        $scope.TotalesMesa = [];
        $scope.TotalesMesa.push(<?php echo json_encode($totalGobernador) ?>);
        $scope.TotalesMesa.push(<?php echo json_encode($totalIntendente) ?>);
        
        $scope.funcionGeneral = function () {
            
            localStorage.setItem('radioButton2', $scope.tipoGrafico);

            for (let i = 0; i < 2; i++) {
                var totVotos = $scope.TotalesMesa[i][0]['SUM'];
                sizeFont = 12;
                var dataP = []; //Data Points
                var dataC = []; //Arreglo de Colores
                var dataPC = []; //Arrelgo de Data Points y Colores
                
                dataPC = dataPointsColor(setOrder($scope.General[i]), totVotos);
                console.log(totVotos);
                dataP = dataPC[0];
                dataC = dataPC[1];
                setColorCanvas(dataC);

                if ($scope.tipoGrafico == "bar") {dataP= dataP.reverse(); dataC = dataC.reverse()}
               
                var chart = new CanvasJS.Chart(i.toString(), {
                    colorSet: "personalizado",
                    animationEnabled: true, 
                    animationDuration: 1200, 
                    title:{
                        text: "Votos para " + $scope.Title[i]
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
                }); //Fin Char CanvasJS

                chart.render();
            }
        };//Fin Función General

        $scope.reload = function () {            
            $http.get("http://localhost/Elecciones/mesas-candidatostwo/provisorio/1")
                .then(function(response) {                     
                });
        };//Fin función Reload
        
        $scope.traeCantidad = function(){
            $http.get("<?php echo (Router::url(['controller' => 'mesas_candidatostwo','action' => 'cantidad'],false)); ?>")
                .then(function(response) {
                    localStorage.setItem('cantidad2', parseInt(response['data'][0]['SUM']));
            });   

            $timeout(function(){
                $scope.traeCantidad();
             
                var cant=localStorage.getItem('cantidad2');
                var cant_old = localStorage.getItem('cantidad_old2');
           
                if(cant == 'undefined' || isNaN(cant)){
                    localStorage.setItem('cantidad2', 0);                    
                }
                if(cant_old == 'undefined' || isNaN(cant_old)){
                    localStorage.setItem('cantidad_old2', 0);                    
                }
                if(cant > cant_old){
                    localStorage.setItem('cantidad_old2', cant);
                    $scope.reload();
                    window.location.reload(false); 
                }
            },2000)
        };//Fin función Trae Cantidad

        $scope.traeCantidad();
        $scope.tipoGrafico = localStorage.getItem('radioButton2');
    });

function setOrder(numArray){
    var copia = numArray.slice();
    
    copia.sort(function(a, b) {
        return b.cantidad_votos - a.cantidad_votos;
    });


    return copia;
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