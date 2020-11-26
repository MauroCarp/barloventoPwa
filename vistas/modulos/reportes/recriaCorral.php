<?php
 /// OBTENCION DE DATOS


    /*********
             POBLACION SEGUN SEXO
                                    ********/
    // MACHOS
    $item = 'adpvRC';

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
    $totalAnimalesRC = $totalMachos[0] + $totalHembras[0];

    $restoAnimales = $totalAnimalesCC - $totalAnimalesRC;

                                    
    /*********
                     ADPV
                                    ********/

    $item = NULL;
    $valor = NULL;
    $campo = 'adpvRC';
    $sumaADPV = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalAdpvRC = $sumaADPV[0][0];
    $promedioAdpvRC = number_format(($totalAdpvRC / $totalAnimalesRC),2);

                                
    /*********
                     DIAS 
                                    ********/
    
    $campo = 'diasRC';
    $totalDias = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalDiasRC = $totalDias[0][0];

    $promedioDiasRC = round(($totalDiasRC / $totalAnimalesRC));
            
    /*********
                    KG INGRESO
                                    ********/
    
    $campo = 'kgIngresoRC';
    $kilosIng = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosIngRR = $kilosIng[0][0];

    $promedioKgIngRC = number_format(($kilosIngRR / $totalAnimalesRC),2);

    /*********
                    KG SALIDA
                                    ********/
    
    $campo = 'kgSalidaRC';
    $kilosEgrPR = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosEgrPR = $kilosEgrPR[0][0];

    $promedioKgEgrRC = number_format(($kilosEgrPR / $totalAnimalesRC),2);

                                    
    /*********
                 KG PRODUCCION
                                    ********/

    
    $campo = 'kgProdRC';
    $kilosProd = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosProdRC = $kilosProd[0][0];

    $promedioKgProdRC = number_format(($kilosProdRC / $totalAnimalesRC),2);

?>
<br>
<div class="row">

   

</div>

<div class="row">

    <div class="col-md-4">
      <!-- BAR CHART -->
      <div class="box box-success">
          <div class="box-header with-border">
          <h3 class="box-title">ADPV</h3>
          </div>
          <div class="box-body">
          <div class="chart">
              <canvas id="barChartRC" style="height:230px"></canvas>
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
              <canvas id="barChart1RC" style="height:230px"></canvas>
          </div>
          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
        
        <!-- DONUT CHART -->
        <div class="box box-danger">
        
            <div class="box-header with-border">
            
            <h3 class="box-title">% Población / Total: <?php echo $totalAnimalesRC;?> Animales</h3>

            </div>
            
            <div class="box-body">

                <canvas id="pieChart1RC" style="height:100px"></canvas>

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
              <canvas id="barChart2RC" style="height:230px"></canvas>
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
              <canvas id="barChart3RC" style="height:230px"></canvas>
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
              <canvas id="barChart4RC" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

</div>

<script>

var configPSSRC = {
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

var configPPRC = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
                        <?php 
                        echo $totalAnimalesRC.",".$restoAnimales.",";
                        ?>
					],
					backgroundColor: [
					window.chartColors.red,
					window.chartColors.orange,
					],
					label: 'value'
				}],
				labels: [
                    'Población RC','Resto Población'
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

var configADPVRC = {
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
    echo $promedioAdpvRC;
    ?>
    ]
  }]

};

var configDiasRC = {
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
    echo $promedioDiasRC;
    ?>
    ]
  }]

};


var configKgIngRC = {
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
    echo $promedioKgIngRC;
    ?>
    ]
  }]

};

var configKgEgrRC = {
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
    echo $promedioKgEgrRC;
    ?>
    ]
  }]

};

var configKgProdRC = {
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
    echo $promedioKgProdRC;
    ?>
    ]
  }]

};



</script>
