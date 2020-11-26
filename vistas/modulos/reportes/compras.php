<br>

<div class="row">

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cantidad de Animales comprados:</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantCabezas" style="height:230px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas Según Sexo</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantCabezasSexo" style="height:230px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
    
      <div class="box box-danger">
      
          <div class="box-header with-border">
          
            <h3 class="box-title">Costo Promedio de cabeza según Consignatario</h3>

          </div>
          
          <div class="box-body">

            <canvas id="precioCantidaConsignatario" style="height:230px"></canvas>
            
          </div>
      
      </div>

    </div> 

</div>

<div class="row">

      <div class="col-md-4">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas por Consignatario</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantConsignatario" style="height:230px"></canvas>

            </div>

          </div>


        </div>
        

      </div>

      <div class="col-md-4">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas por Consignatario y Sexo</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantConsignatarioSexo" style="height:230px"></canvas>

            </div>

          </div>

        </div>
        

      </div>

      <div class="col-md-4">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas por Proveedor TOP 5 Según Cantidad</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantProveedor" style="height:230px"></canvas>

            </div>

          </div>

        </div>
        

      </div>

</div>



<script>

var confCantTotal = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
            <?php echo $cantidadTotal[0][0];?>
					],
					backgroundColor: [
					window.chartColors.red,
					],
					label: 'Cantidad de Animales'
				}],
				labels: [
				'Total'
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
        },
        legend: {
          labels: {
              boxWidth: 5
          }
        }

			}
}

var confCantCabezasSexo = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
            <?php echo $cantMachosHembras?>
					],
					backgroundColor: [
					window.chartColors.blue,
					window.chartColors.red,
					],
					label: 'Cantidad de Animales por Sexo'
				}],
				labels: [
          'Macho','Hembra',
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
        },
        legend: {
          labels: {
              boxWidth: 5
          }
        }
			}
};

var confCantConsignatario = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
            <?php echo $animalesPorConsignatario  ;?>
					],
					backgroundColor: [
            <?php echo $coloresConsignatario;?>  
					],
					label: 'Cantidad de Animales por Consignatario'
				}],
				labels: [
          <?php echo $nombresPorConsignatario;?>,
				]
			},
			options: {
				responsive: true,
				title: {
					display: false,
        },
        legend: {
          labels: {
              boxWidth: 5
          }
        }

			}
};

var color = Chart.helpers.color;

var confCantConsignatarioSexo = {
  labels: [<?php echo $nombresPorConsignatarioResumidos;?>,
  ],
  datasets: [{
    label: '% Macho',
    backgroundColor: window.chartColors.blue,
    stack: 'Stack 0',
    data: [
      <?php echo $machosPorConsignatarioPorcentaje;?>
    ]
  }, {
    label: '% Hembra',
    backgroundColor: window.chartColors.red,
    stack: 'Stack 0',
    data: [
      <?php echo $hembrasPorConsignatarioPorcentaje;?>,
    ]
  }, {  
    label: 'Cantidad Cabezas',
    backgroundColor: window.chartColors.green,
    stack: 'Stack 1',
    data: [
      <?php echo $animalesPorConsignatario;?>
    ]
  }]

};

var confCantProveedor = {
  datasets: [

      <?php echo $cantidadAnimalesProveedores;?>

  ]
};




</script>
