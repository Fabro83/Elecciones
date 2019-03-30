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
            <input type="radio" ng-model="tipoGrafico" value="pie" ng-change="funcionGeneral()">
            Torta
        </label>
        <label>
            <input type="radio" ng-model="tipoGrafico" value="bar" ng-change="funcionGeneral()">
            Barras
        </label>
    </div>
    </br>
    <div>
        <label>
            <input type="radio" ng-model="radioB" value="1" ng-change="funcionGeneral()">
            Todos
        </label>
        <label>
            <input type="radio" ng-model="radioB" value="2" ng-change="funcionGeneral()">
            Resumidos
        </label>
        <label>
            <input type="radio" ng-model="radioB" value="3" ng-change="funcionGeneral()">
            Cabeza a cabeza
        </label>
    </div>
    </br>
    <div ng-repeat="gen in General" on-finish-render="funcionGeneral()">
        <div id="{{$index}}" style="height: 500px; width: 100%;">
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
    }]);

    mainApp.controller('getInd', function($scope,$http,$timeout){

        $scope.General = [];
        $scope.radioB="1";
        $scope.General.push(<?php echo json_encode($funcionario) ?>);
        $scope.funcion_id = (<?php echo json_encode($funcion_id) ?>);
        $scope.tipoLabel =  "{label} - {y}";
        
        $scope.funcionGeneral = function () {
            
            localStorage.setItem('radioButton', $scope.radioB);   
            localStorage.setItem('radioButton2', $scope.tipoGrafico); 

            for (let i = 0; i < $scope.General.length; i++) {
                var totVotos = totVotosfunction($scope.General[i]);
                sizeFont = 16;
                var dataP = [];
                var dataC = [];
                var dataPC = [];
                switch ($scope.radioB) {
                    case "1":
                        dataPC = dataPointsColor(setOrder($scope.General[i]), totVotos);
                        dataP = dataPC[0];
                        dataC = dataPC[1];
                        setColorCanvas(dataC);
                        break;

                    case "2":
                        // dataP=dataPoints(getMaxOfArray($scope.General[i]), totVotos);
                        dataPC = dataPointsColor(getMaxOfArray($scope.General[i]), totVotos);
                        dataP = dataPC[0];
                        dataC = dataPC[1];
                        setColorCanvas(dataC);
                        sizeFont= 18;
                        $scope.tipoLabel = "{y}";
                        break;
                    
                    case "3":
                        dataPC = dataPointsColor(cabeza_cabeza($scope.General[i]), totVotos);
                        dataP = dataPC[0];
                        dataC = dataPC[1];
                        setColorCanvas(dataC);
                        sizeFont= 25;
                        $scope.tipoLabel = "{y}";
                        break;
                        
                    default:
                        break;
                } 
                
                if ($scope.tipoGrafico == "pie") $scope.tipoLabel = "{label} - {y}";
                if ($scope.tipoGrafico == "bar") {dataP= dataP.reverse(); dataC = dataC.reverse()}
               

                
                var chart = new CanvasJS.Chart(i.toString(), {
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
            }
        }//Fin Función General

        $scope.reload = function () {
                $http.get("<?php echo (Router::url(null, true)); ?>/"+$scope.funcion_id)
                    .then(function(response) {                     
                });   
            };
            $scope.traeCantidad = function(){
                $http.get("<?php echo (Router::url(['controller' => 'mesas_candidatos','action' => 'cantidad'],false)); ?>")
                    .then(function(response) {
                        localStorage.setItem('cantidad', parseInt(response['data'][0]['SUM']));
                });           
                
                $timeout(function(){
                    $scope.traeCantidad();
                
                    var cant=localStorage.getItem('cantidad');
                    var cant_old = localStorage.getItem('cantidad_old');
                    console.log("este " + cant);
                    console.log("este es old " + cant_old);
                    if(cant == 'undefined'){
                        localStorage.setItem('cantidad', 0);                    
                    }
                    if(cant_old == 'undefined'){
                        localStorage.setItem('cantidad_old', 0);                    
                    }
                    if(isNaN(cant)){
                        localStorage.setItem('cantidad', 0); 
                    }
                    if(isNaN(cant_old)){
                        localStorage.setItem('cantidad_old', 0); 
                    }
                    if(cant > cant_old){
                        localStorage.setItem('cantidad_old', cant);
                        $scope.reload();
                        window.location.reload(false); 
                    }
                },30000)
            }
            $scope.traeCantidad();
            $scope.radioB = localStorage.getItem('radioButton');
            $scope.tipoGrafico = localStorage.getItem('radioButton2');
        });
function totVotosfunction (aux)
{
    var acu =0;
    for (let i = 0; i < aux.length; i++) {
        acu = acu + aux[i].cantidad_votos;
        
    }
    return (acu);
}
function setOrder(numArray){
    var sin_blancos = numArray.slice();
    var blancos = numArray.slice();
    var acum = 0;
    var arre_nuevo = [];
    sin_blancos.splice(numArray.length-3,3);    
    blancos.splice(0,numArray.length-3);
    sin_blancos.sort(function(a, b) {
    return b.cantidad_votos - a.cantidad_votos;
    });
    for (let k = 0; k < blancos.length; k++) {
        sin_blancos.push(blancos[k]);
        
    }
    console.log(sin_blancos);
    return sin_blancos;
    
}
function getMaxOfArray(numArray) {
    
    var sin_blancos = numArray.slice();
    var acum = 0;
    var arre_nuevo = [];
    sin_blancos.splice(numArray.length-3,3);

    sin_blancos.sort(function(a, b) {
    return b.cantidad_votos - a.cantidad_votos;
    });
    

    for (let index = 3; index < sin_blancos.length; index++) {
        acum = acum + sin_blancos[index].cantidad_votos;
    }
    for (let j = 0; j < 3; j++) {
        arre_nuevo.push(sin_blancos[j]);
    }

    arre_nuevo.push({"Nombre":"Otros", "cantidad_votos":acum});
 
    for (let i = numArray.length-3; i < numArray.length; i++) {
        arre_nuevo.push(numArray[i]);
    }
    return arre_nuevo;
    // return Math.max.apply(null, arre);
}
function cabeza_cabeza(numArray) {
    
    var sin_blancos = numArray.slice();
    var acum = 0;
    var arre_nuevo = [];
    sin_blancos.splice(numArray.length-3,3);

    sin_blancos.sort(function(a, b) {
    return b.cantidad_votos - a.cantidad_votos;
    });
    

    for (let index = 2; index < sin_blancos.length; index++) {
        acum = acum + sin_blancos[index].cantidad_votos;
    }
    
    for (let i = 0; i < 2; i++) {
        arre_nuevo.push(sin_blancos[i]);
    }
    // arre_nuevo.push({"Nombre":"Otros", "cantidad_votos":acum});
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
    // debugger;
    dataPC[0] = dataP;
    dataPC[1] = dataC;
    return dataPC;
}

function setColorCanvas(colors){
    CanvasJS.addColorSet("personalizado",colors);
}

</script>