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
    mainApp.controller('getInd', function($scope,$http){

        $scope.mesas = <?php echo json_encode($mesas) ?>;
        $scope.General = [];
        
        $scope.$gobernadores = [];
        $scope.$proporcionales = [];
        $scope.$provinciales = [];
        $scope.$intendentes = [];
        $scope.$concejales = [];
        $scope.Title = []
        $scope.Title.push("Gobernadores","Propocionales","Diputados Departamentales", "Intendentes", "Concejales");
        $scope.radioB=-1;
        console.log($scope.mesas);
        var datapoint = [];
        console.log(suma_votos($scope.mesas));
        console.log($scope.datapoint);
        
        $scope.init = function() {
            angular.forEach($scope.mesas[0].candidatos, function(value, key) {
                if(value.funcion_id == 1){
                    $scope.gobernador
                }
                switch (value.funcion_id) {
                    case 1:
                        $scope.gobernador.push(value);
                    break;
                    case 2:
                        $scope.proporcionales.push(value);
                    break;
                    case 3:
                        $scope.provinciales.push(value);
                    break;
                    case 4:
                        $scope.intendentes.push(value);
                    break;
                    case 5:
                        $scope.concejales.push(value);
                    break;
                
                    default:
                        break;
                }
            });
            $scope.General.push($scope.gobernador);
            $scope.General.push($scope.proporcionales);
            $scope.General.push($scope.provinciales);
            $scope.General.push($scope.intendentes);
            $scope.General.push($scope.concejales);
        };
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
        
    });

    function suma_votos (aux){
        var cant_votos = 0;
        debugger;
        for (let i = 0; i < aux[0].candidatos.length; i++) {
            cant_votos = cant_votos + aux[0].candidatos[i]['MesasCandidatos'].votos;
        }
        return cant_votos;
    }
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
        