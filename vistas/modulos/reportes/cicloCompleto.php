<?php
 /// OBTENCION DE DATOS


  /*********
            POBLACION SEGUN SEXO
                                  ********/
  // MACHOS
  $item = 'sexo';

  $valor = 'M';

  $totalMachos = ControladorDatos::ctrContarAnimales($item,$valor);

  // HEMBRAS
                                  
  $valor = 'H';

  $totalHembras = ControladorDatos::ctrContarAnimales($item,$valor);

  $totalAnimalesCC = ($totalMachos[0] + $totalHembras[0]);
  /*********
                % POBLACION
                                  ********/


                                  
  /*********
                    ADPV
                                  ********/

  $item = NULL;
  $valor = NULL;
  $campo = 'adpvCC';
  $sumaADPV = ControladorDatos::ctrSumarCampo($item,$valor,$campo);
  $totalAnimales = ($totalMachos[0] + $totalHembras[0]);

  $totalAdpvCC = $sumaADPV[0][0];

  $promedioAdpvCC = number_format(($totalAdpvCC / $totalAnimales),2);

                                
  /*********
                    DIAS 
                                  ********/

  $campo = 'diasCC';
  $totalDias = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

  $totalDiasCC = $totalDias[0][0];

  $promedioDiasCC = round(($totalDiasCC / $totalAnimales));
            
  /*********
                  KG INGRESO
                                  ********/

  $campo = 'kgIngresoCC';
  $kilosIng = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

  $kilosIngCC = $kilosIng[0][0];

  $promedioKgIngCC = round(($kilosIngCC / $totalAnimales));

  /*********
                  KG SALIDA
                                  ********/

  $campo = 'kgSalidaCC';
  $kilosEgr = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

  $kilosEgrCC = $kilosEgr[0][0];

  $promedioKgEgrCC = round(($kilosEgrCC / $totalAnimales));

                                  
  /*********
                KG PRODUCCION
                                  ********/


  $campo = 'kgProdCC';
  $kilosProd = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

  $kilosProdCC = $kilosProd[0][0];

  $promedioKgProdCC = round(($kilosProdCC / $totalAnimales));


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
              <canvas id="barChart" style="height:230px"></canvas>
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
              <canvas id="barChart1" style="height:230px"></canvas>
          </div>
          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
    
      <!-- DONUT CHART -->
      <div class="box box-danger">
      
          <div class="box-header with-border">
          
          <h3 class="box-title">Población según Sexo / Total: <?php echo $totalAnimalesCC;?> Animales</h3>


          </div>
          
          <div class="box-body">

              <canvas id="pieChart" style="height:100px"></canvas>
            
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
              <canvas id="barChart2" style="height:230px"></canvas>
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
              <canvas id="barChart3" style="height:230px"></canvas>
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
              <canvas id="barChart4" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

</div>



<script>
var configPSS = {
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
        plugins:{
          labels:{
            render: 'value'
          }
        }

			}
};

var configPP = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
            <?php echo $totalAnimalesCC;?>
          ],
					backgroundColor: [
					window.chartColors.red,
					window.chartColors.orange,
					],
					label: 'Porcentaje'
				}],
				labels: [
          'Población'
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

var configADPV = {
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
    echo $promedioAdpvCC;
    ?>
    ]
  }]

};

var configDias = {
  labels: [
    'Prom. Dias'
  ],
  datasets: [{
    label: 'Dias',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 
    data: [
    <?php
    echo $promedioDiasCC;
    ?>
    ]
  }]

};

var configKgIng = {
  labels: [
    'Prom. Kg Ingreso'
  ],
  datasets: [{
    label: 'Kg',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 
    data: [
    <?php
    echo $promedioKgIngCC;
    ?>
    ]
  }]

};

var configKgEgr = {
  labels: [
    'Prom. Kg Egreso'
  ],
  datasets: [{
    label: 'Kg',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 
    data: [
    <?php
    echo $promedioKgEgrCC;
    ?>
    ]
  }]

};

var configKgProd = {
  labels: [
    'Prom. Kg Produc.'
  ],
  datasets: [{
    label: 'Kg',
    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
    borderColor: window.chartColors.red,
    borderWidth: 1, 
    data: [
    <?php
    echo $promedioKgProdCC;
    ?>
    ]
  }]

};





</script>