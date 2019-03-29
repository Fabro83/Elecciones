<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd" ng-init="reload()" style="border-color: #73a83900 !important;">
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
        <center><a href="/Elecciones/mesas-candidatos/individual/{{$index + 1}}" class="btn btn-info" role="button" style="width: 5%;height:10%"><span class="glyphicon glyphicon-arrow-down"></span> </a></center>
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
    }]);

    mainApp.controller('getInd', function($scope,$http,$timeout){

        $scope.General = [];
        $scope.radioB="1";
        $scope.tipoGrafico="column ";
        $scope.tipoLabel =  "{label} - {y}";
        $scope.General.push(<?php echo json_encode($gobernadores) ?>);
        $scope.General.push(<?php echo json_encode($proporcionales) ?>);
        $scope.General.push(<?php echo json_encode($provinciales) ?>);
        $scope.General.push(<?php echo json_encode($intendentes) ?>);
        $scope.General.push(<?php echo json_encode($concejales) ?>);
        $scope.Title = []
        $scope.Title.push("Gobernadores","Propocionales","Diputados Departamentales", "Intendentes", "Concejales");
        
        $scope.funcionGeneral = function () {
            
            localStorage.setItem('radioButton', $scope.radioB);   
            localStorage.setItem('radioButton2', $scope.tipoGrafico);

            for (let i = 0; i < 5; i++) {
                var totVotos = totVotosfunction($scope.General[i]);
                sizeFont = 12;
                var dataP = [];
                
                switch ($scope.radioB) {
                    case "1":
                        dataP=dataPoints($scope.General[i], totVotos); 
                        $scope.tipoLabel = "{y}";   
                        break;

                    case "2":
                        dataP=dataPoints(getMaxOfArray($scope.General[i]), totVotos);
                        sizeFont= 18;
                        $scope.tipoLabel = "{y}";
                        break;
                    
                    case "3":
                        dataP=dataPoints(cabeza_cabeza($scope.General[i]), totVotos);
                        sizeFont= 25;
                        $scope.tipoLabel = "{y}";
                        break;
                        
                    default:
                        break;
                } 
                
                if ($scope.tipoGrafico == "pie") $scope.tipoLabel = "{label} - {y}";
                if ($scope.tipoGrafico == "bar") dataP= dataP.reverse();
               // setColorCanvas();

                
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
                });

                chart.render();
            }
        }//Fin Función General

        $scope.reload = function () {            
            $http.get("http://localhost/Elecciones/mesas-candidatos/todos/2")
                .then(function(response) {                     
            });

            $timeout(function(){
            $scope.reload();
            window.location.reload(false); 
            },30000)
        };
        $scope.reload();
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
    
    for (let i = 0; i < 2; i++) {
        arre_nuevo.push(sin_blancos[i]);
    }
    console.log(sin_blancos[1]);
    CanvasJS.addColorSet("personalizado",
                [
                    "#548ED1",
                    "#F1F417",
                ]);
    return arre_nuevo;
}

function dataPoints(aux,totVotos){
    var dataP=[];

    for (let i = 0; i < aux.length; i++) {
        var auxiliar = {'label':aux[i].Nombre,'y':aux[i].cantidad_votos*100/totVotos};
        dataP.push(auxiliar);    
    }
    
    return dataP;
}

function setColorCanvas(){
    CanvasJS.addColorSet("personalizado",
                [//colorSet Array

                "#0277FC",
                "#FCF802",
                "#EDFC02",
                "#3CB371",
                "#3CB371",
                "#3CB371",
                "#3CB371",
                "#3CB371",
                "#90EE90"                
                ]);
}

</script>