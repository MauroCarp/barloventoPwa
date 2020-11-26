<br>

<div class="row">

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Muertes según Causa:</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="muertesMotivo" style="height:300px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">% según Causa</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="porcentajeMotivo" style="height:300px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
    
      <div class="box box-success">
      
          <div class="box-header with-border">
          
            <h3 class="box-title">Muertes por Sexo</h3>

          </div>
          
          <div class="box-body">

            <canvas id="muertesSexo" style="height:250px"></canvas>
            
          </div>
      
      </div>

    </div> 

</div>

<div class="row">

      <div class="col-md-6">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Muertes por Consignatario</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="muertesConsignatario" style="height:250px"></canvas>

            </div>

          </div>


        </div>
        

      </div>

      <div class="col-md-6">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Muertes por Proveedor</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="muertesProveedor" style="height:250px"></canvas>

            </div>

          </div>

        </div>
        

      </div>

</div>



<script>

var color = Chart.helpers.color;

var configMuertesCausa = {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?php echo $muertesCausas?>],
					backgroundColor: [<?php echo $colorsPieStr; ?>],
			  }],
		  labels: [
          <?php echo $labelsCausas;?>,
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
          },
          position:'left'

        }
			}
};

var configPorcentajeMuertesCausa = {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?php echo $muertesCausas?>],
					backgroundColor: [<?php echo $colorsPieStr; ?>],
			  }],
		  labels: [
          <?php echo $labelsCausas;?>,
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
          },
          position:'left'
        }
			}
};
   

var confMuertesConsignatario = {
  labels: [
    'Consignatarios'
  ],
  datasets: [
    <?php
       echo $chartDataConsignatarios;
      ?>

  ]
};

var confMuertesProveedor = {
  labels: [<?php echo $proveedoresResum;?>],
  datasets: [
    {
        label: 'Muertes por Proveedor',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [<?php echo $dataProveedor;?>]
        
    }

  ]
};

var configMuertesSexo = {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?php echo $muertesSexo?>],
					backgroundColor: [<?php echo "'#7FB3D5','#F5B7B1'"; ?>],
			  }],
		  labels: [
          'Machos','Hembras',
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
          },
          position:'left'

        }
			}
};



</script>
