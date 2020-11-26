<?php
 /// OBTENCION DE DATOS


    /*********
             POBLACION SEGUN SEXO
                                    ********/
    // MACHOS
    $item = 'adpvRP';

    $valor = '';

    $item2 = 'sexo';

    $valor2 = 'M';

    $operador = '!=';
    $totalMachos = ControladorDatos::ctrContarDatos($item,$valor,$item2,$valor2,$operador);

    // HEMBRAS
                                    
    $valor2 = 'H';

    $totalHembras = ControladorDatos::ctrContarDatos($item,$valor,$item2,$valor2,$operador);

    /*********
                 % POBLACION
                                    ********/
    $totalAnimalesRP = $totalMachos[0] + $totalHembras[0];

    $restoAnimales = $totalAnimalesCC - $totalAnimalesRP;

                                    
    /*********
                     ADPV
                                    ********/

    $item = NULL;
    $valor = NULL;
    $campo = 'adpvRP';
    $sumaADPV = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalAdpvRP = $sumaADPV[0][0];
    $promedioAdpvRP = number_format(($totalAdpvRP / $totalAnimalesRP),2);

                                
    /*********
                     DIAS 
                                    ********/
    
    $campo = 'diasRP';
    $totalDias = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalDiasRP = $totalDias[0][0];

    $promedioDiasRP = round(($totalDiasRP / $totalAnimalesRP));
            
    /*********
                    KG INGRESO
                                    ********/
    
    $campo = 'kgIngresoRP';
    $kilosIng = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosIngRP = $kilosIng[0][0];

    $promedioKgIngRP = number_format(($kilosIngRP / $totalAnimalesRP),2);

    /*********
                    KG SALIDA
                                    ********/
    
    $campo = 'kgSalidaRP';
    $kilosEgrPR = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosEgrPR = $kilosEgrPR[0][0];

    $promedioKgEgrRP = number_format(($kilosEgrPR / $totalAnimalesRP),2);

                                    
    /*********
                 KG PRODUCCION
                                    ********/

    
    $campo = 'kgProdRP';
    $kilosProd = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosProdRP = $kilosProd[0][0];

    $promedioKgProdRP = number_format(($kilosProdRP / $totalAnimalesRP),2);

?>
<br>

<div class="row">

    <div class="col-md-4">
      <!-- BAR CHART -->
      <div class="box box-success">
          <div class="box-header with-border">
          <h3 class="box-title">ADPV</h3>
          </div>
          <div class="box-body">
          <div class="chart">
              <canvas id="barChartRP" style="height:200px"></canvas>
          </div>
          </div>

      </div>
    
    </div>

    <div class="col-md-4">
      <!-- BAR CHART -->
      <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Días</h3>
          </div>
          <div class="box-body">
            <div class="chart">
                <canvas id="barChart1RP" style="height:230px"></canvas>
            </div>
          </div>

      </div>


    </div>
   
    <div class="col-md-4">  
        
        <!-- DONUT CHART -->
        <div class="box box-danger">
        
            <div class="box-header with-border">
            
            <h3 class="box-title">% Población / Total: <?php echo $totalAnimalesRP;?> Animales</h3>

            </div>
            
            <div class="box-body">

                <canvas id="pieChart1RP" style="height:100px"></canvas>

            </div>
        
        </div>

    </div>  

</div>

<div class="row">

      <div class="col-md-4">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kg Ingreso</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="barChart2RP" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

      <div class="col-md-4">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kg Salida</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="barChart3RP" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

      <div class="col-md-4">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kg Produc.</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="barChart4RP" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

</div>

<script>

var configPSSRP = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
					<?php

					$resultado = $totalMachos[0].",".$totalHembras[0].",";
					echo $resultado;

					?>
					],
					backgroundColor: [
					window.chartColors.red,
					window.chartColors.orange,
					],
					label: 'Sexo'
				}],
				labels: [
				'Macho',
				'Hembra'
				]
			},
			options: {
				responsive: true,
				title: {
					display: false,
                },
                labels:{
                    render:'value',
                    fontSize: 14,
                    fontStyle: 'bold',
                    fontColor: '#000',
                    fontFamily: '"Lucida Console", Monaco, monospace'
                },
                plugins:{
                    labels:{
                        render: 'value'
                    }
                }

			}
};

var configPPRP = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
                        <?php 
                        echo $totalAnimalesRP.",".$restoAnimales.",";
                        ?>
					],
					backgroundColor: [
					window.chartColors.red,
					window.chartColors.orange,
					],
					label: 'value'
				}],
				labels: [
                    'Población RP','Resto Población'
				]
			},
			options: {
				responsive: true,
				title: {
					display: false,
				}

			}
};

var color = Chart.helpers.color;

var configADPVRP = {
  labels: [
    'Prom. Adpv'
  ],
  datasets: [{
    label: 'Kg. Prom',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 

    data: [
    <?php
    echo $promedioAdpvRP;
    ?>
    ]
  }]

};

var configDiasRP = {
  labels: [
    'Prom. Dias'
  ],
  datasets: [{
    label: 'Dias Prom.',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 

    data: [
    <?php
    echo $promedioDiasRP;
    ?>
    ]
  }]

};


var configKgIngRP = {
  labels: [
    'Kg Ingreso Prom.'
  ],
  datasets: [{
    label: 'Kg Ingreso Prom.',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 

    data: [
    <?php
    echo $promedioKgIngRP;
    ?>
    ]
  }]

};

var configKgEgrRP = {
  labels: [
    'Kg Salida Prom.'
  ],
  datasets: [{
    label: 'Kg Salida Prom.',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 

    data: [
    <?php
    echo $promedioKgEgrRP;
    ?>
    ]
  }]

};

var configKgProdRP = {
  labels: [
    'Kg Produc. Promedio'
  ],
  datasets: [{
    label: 'Kg Produc. Promedio',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 

    data: [
    <?php
    echo $promedioKgProdRP;
    ?>
    ]
  }]

};



</script>
