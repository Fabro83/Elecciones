<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesasCandidato $mesasCandidato
 */
use Cake\Routing\Router;
?>

<div class="card border-success mb-3" ng-controller="getInd" ng-init="reload()">
    <div>
        <label>
            <input id="fede" name="fede" type="radio" ng-model="radioB" value="1">
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
    <div ng-init=funcionGeneral() ng-if="radioB == 1">
        <div id="0" style="height: 500px; width: 100%;"></div>
        <div id="1" style="height: 500px; width: 100%;"></div>
        <div id="2" style="height: 500px; width: 100%;"></div>
        <div id="3" style="height: 500px; width: 100%;"></div>
        <div id="4" style="height: 500px; width: 100%;"></div>    
    </div>
    <div ng-init=funcionGeneral() ng-if="radioB == 2">
        <div id="0" style="height: 500px; width: 100%;"></div>
        <div id="1" style="height: 500px; width: 100%;"></div>
        <div id="2" style="height: 500px; width: 100%;"></div>
        <div id="3" style="height: 500px; width: 100%;"></div>
        <div id="4" style="height: 500px; width: 100%;"></div>    
    </div>
    <div ng-init=funcionGeneral() ng-if="radioB == 3">
        <div id="0" style="height: 500px; width: 100%;"></div>
        <div id="1" style="height: 500px; width: 100%;"></div>
        <div id="2" style="height: 500px; width: 100%;"></div>
        <div id="3" style="height: 500px; width: 100%;"></div>
        <div id="4" style="height: 500px; width: 100%;"></div>    
    </div>
</div>


<script type="text/javascript">

    mainApp.controller('getInd', function($scope,$http,$timeout){
        
        $scope.General = [];
        $scope.General.push(<?php echo json_encode($gobernadores) ?>);
        $scope.General.push(<?php echo json_encode($proporcionales) ?>);
        $scope.General.push(<?php echo json_encode($provinciales) ?>);
        $scope.General.push(<?php echo json_encode($intendentes) ?>);
        $scope.General.push(<?php echo json_encode($concejales) ?>);
        $scope.Title = []
        $scope.Title.push("Gobernadores","Propocionales","Diputados Departamentales", "Intendentes", "Concejales");

        $scope.tipo_grafico = <?php echo json_encode($tipo_grafico) ?>;
        // $scope.radioB=-1;
        
        $scope.funcionGeneral = function () {
        
        for (let i = 0; i < 5; i++) {
            var totVotos = totVotosfunction($scope.General[i]);
            sizeFont = 12;
            var dataP = [];
            
            switch ($scope.radioB) {
                case "1":
                    dataP=dataPoints($scope.General[i], totVotos);    
                    break;

                case "2":
                    dataP=dataPoints(getMaxOfArray($scope.General[i]), totVotos);
                    sizeFont= 18;
                    break;
                
                case "3":
                    dataP=dataPoints(cabeza_cabeza($scope.General[i]), totVotos);
                    sizeFont= 25;
                    break;
                    
                default:
                    break;
            } 
        
                var chart = new CanvasJS.Chart(i.toString(), {
                    animationEnabled: true, 
                    animationDuration: 2000,
                    title:{
                        text: "Votos para " + $scope.Title[i]
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
        }//Fin Función General
        $scope.reload = function () {
            this.radioB="1";
            $http.get("http://localhost/Elecciones/mesas-candidatos/todos/2")
                .then(function(response) {
                     
            });

            $timeout(function(){
            $scope.reload();
            window.location.reload(false); 
            },30000)
        };
        $scope.reload();
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