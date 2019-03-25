<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd">
    <div>
        <label>
            <input type="radio" ng-model="radioB" value="1">
            Todos
        </label>
        <label>
            <input type="radio" ng-model="radioB" value="2">
            Resumidos
        </label>
        <label>
            <input type="radio" ng-model="radioB" value="3">
            Cabeza a cabeza
        </label>
    </div>
    <div ng-if="radioB == 1">
        <div class="card-header">Graficos</div>
        <div id="goberData" ng-init=gob() style="height: 300px; width: 100%;"></div>
        <div id="propData" ng-init=pro() style="height: 300px; width: 100%;"></div>
        <div id="provData" ng-init=prov() style="height: 300px; width: 100%;"></div>
        <div id="intenData" ng-init=inten() style="height: 300px; width: 100%;"></div>
        <div id="conceData" ng-init=conce() style="height: 300px; width: 100%;"></div>
    </div>
    <div ng-if="radioB == 2">
        <div class="card-header">Graficos</div>
        <div id="goberData" ng-init=gob() style="height: 300px; width: 100%;"></div>
        <div id="propData" ng-init=pro() style="height: 300px; width: 100%;"></div>
        <div id="provData" ng-init=prov() style="height: 300px; width: 100%;"></div>
        <div id="intenData" ng-init=inten() style="height: 300px; width: 100%;"></div>
        <div id="conceData" ng-init=conce() style="height: 300px; width: 100%;"></div>
    </div>
    <div ng-if="radioB == 3">
        <div class="card-header">Graficos</div>
        <div id="goberData" ng-init=gob() style="height: 300px; width: 100%;"></div>
        <div id="propData" ng-init=pro() style="height: 300px; width: 100%;"></div>
        <div id="provData" ng-init=prov() style="height: 300px; width: 100%;"></div>
        <div id="intenData" ng-init=inten() style="height: 300px; width: 100%;"></div>
        <div id="conceData" ng-init=conce() style="height: 300px; width: 100%;"></div>
    </div>
</div>


<script type="text/javascript">
    mainApp.controller('getInd', function($scope,$http){

        $scope.tipo_grafico = <?php echo json_encode($tipo_grafico) ?>;
        $scope.radioB=-1;

        /* GOBERNADORES */
        $scope.gobernadores  = <?php echo json_encode($gobernadores) ?>;
        //debugger;
        $scope.gob = function () {
        
            var totVotosGob = totVotos($scope.gobernadores)
            var dataP = [];
            sizeFont = 12;
            
            switch ($scope.radioB) {
                case "1":
                    dataP=dataPoints($scope.gobernadores, totVotosGob);    
                    break;

                case "2":
                    dataP=dataPoints(getMaxOfArray($scope.gobernadores), totVotosGob);
                    sizeFont= 18;
                    break;
                
                case "3":
                    dataP=dataPoints(cabeza_cabeza($scope.gobernadores), totVotosGob);
                    sizeFont= 25;
                    break;
                    
                default:
                    break;
            } 

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
                        indexLabelFontSize: sizeFont,
                        dataPoints: dataP
                     }
                ]
            });
            chart.render();
        }
        
        /* PROPORCIONALES */
        $scope.proporcionales = <?php echo json_encode($proporcionales) ?>;
        
        $scope.pro = function () {

            var totVotosGob = totVotos($scope.proporcionales)
            var dataP = [];
            
            switch ($scope.radioB) {
                case "1":
                    dataP=dataPoints($scope.proporcionales, totVotosGob);    
                    break;

                case "2":
                    dataP=dataPoints(getMaxOfArray($scope.proporcionales), totVotosGob);
                    sizeFont= 18;
                    break;
                
                case "3":
                    dataP=dataPoints(cabeza_cabeza($scope.proporcionales), totVotosGob);
                    sizeFont= 25;
                    break;
                    
                default:
                    break;
            }

            var chart = new CanvasJS.Chart("propData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Diputados Proporcionales"              
                },
                data: [              
                    {
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        indexLabelFontSize: sizeFont,
                        dataPoints: dataP
                    }
                ]
            });
            chart.render();
        }

        /* PROVINCIALES */
        $scope.provinciales = <?php echo json_encode($provinciales) ?>;
        $scope.prov = function () {

            var totVotosGob = totVotos($scope.provinciales)
            var dataP = [];
            
            switch ($scope.radioB) {
                case "1":
                    dataP=dataPoints($scope.provinciales, totVotosGob);    
                    break;

                case "2":
                    dataP=dataPoints(getMaxOfArray($scope.provinciales), totVotosGob);
                    sizeFont= 18;
                    break;
                
                case "3":
                    dataP=dataPoints(cabeza_cabeza($scope.provinciales), totVotosGob);
                    sizeFont= 25;
                    break;
                    
                default:
                    break;
            }

            var chart = new CanvasJS.Chart("provData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Diputados Provinciales"              
                },
                data: [              
                    {
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        indexLabelFontSize: sizeFont,
                        dataPoints: dataP
                    }
                ]
            });
            chart.render();
        }
        /* INTENDENTES */
        $scope.intendentes = <?php echo json_encode($intendentes) ?>;
        $scope.inten = function () {

            var totVotosGob = totVotos($scope.intendentes)
            var dataP = [];
            
            switch ($scope.radioB) {
                case "1":
                    dataP=dataPoints($scope.intendentes, totVotosGob);    
                    break;

                case "2":
                    dataP=dataPoints(getMaxOfArray($scope.intendentes), totVotosGob);
                    sizeFont= 18;
                    break;
                
                case "3":
                    dataP=dataPoints(cabeza_cabeza($scope.intendentes), totVotosGob);
                    sizeFont= 25;
                    break;
                    
                default:
                    break;
            }

            var chart = new CanvasJS.Chart("intenData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Votos Intendentes"              
                },
                data: [              
                    {
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        indexLabelFontSize: sizeFont,
                        dataPoints: dataP
                    }
                ]
            });
            chart.render();
        }
        
        /* CONCEJALES */
        $scope.concejales = <?php echo json_encode($concejales) ?>;
        $scope.conce = function () {

            var totVotosGob = totVotos($scope.concejales)
            var dataP = [];
            
            switch ($scope.radioB) {
                case "1":
                    dataP=dataPoints($scope.concejales, totVotosGob);    
                    break;

                case "2":
                    dataP=dataPoints(getMaxOfArray($scope.concejales), totVotosGob);
                    sizeFont= 18;
                    break;
                
                case "3":
                    dataP=dataPoints(cabeza_cabeza($scope.concejales), totVotosGob);
                    sizeFont= 25;
                    break;
                    
                default:
                    break;
            }

            var chart = new CanvasJS.Chart("conceData", {
                animationEnabled: true, 
		        animationDuration: 2000,
                title:{
                    text: "Votos Concejales"              
                },
                data: [              
                    {
                        type: $scope.tipo_grafico,
                        yValueFormatString: "###0.0\"%\"",
                        indexLabel: "{label} - {y}",
                        indexLabelFontSize: sizeFont,
                        dataPoints: dataP
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

function dataPoints(aux,totVotos){
    var dataP=[];

    for (let i = 0; i < aux.length; i++) {
        var auxiliar = {'label':aux[i].Nombre,'y':aux[i].cantidad_votos*100/totVotos};
        dataP.push(auxiliar);    
    }
    
    return dataP;
}

</script>