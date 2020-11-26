<?php

error_reporting(0);
$listaPiri = explode(',',$precioPiri);

$minimo = min($listaPiri);
$minimoJson = json_encode($minimo); 
?>



<!--=====================================
GRÁFICO DE COSTOS 
======================================-->


<!-- BAR CHART -->
<div class="box box-success">

  <div class="box-body">

    <div class="chart">

    	<canvas id="canvas"></canvas>

    </div>

  </div>

</div>


<?php


?>
<script>
// AGREGAR COLORES 
var canvas = document.getElementById('canvas');
var minimo = <?php echo $minimoJson;?>;

new Chart(canvas, {
  type: 'bar',
  data: {
      labels: [<?php echo $fechasCompra;?>],
      datasets: [{
      type: 'line',
      label: '$/Kg',
      borderColor: window.chartColors.red,
      fill:false,
      yAxisID: 'A',
      data: [<?php echo $precioKilo;?>]
      }, {
        label: '$ Piri',
        type: 'line',
        borderColor: window.chartColors.blue,
        yAxisID: 'A',
        fill:false,
        data: [<?php echo $precioPiri;?>]
      },{
          label: 'Kg Ingreso',
          type: 'bar',
          backgroundColor: window.chartColors.green,
          yAxisID: 'B',
          data: [
            <?php echo $totalKgIng;?>
          ],
          borderColor: 'white',
          borderWidth: 2
      }
  ]
  },
  options: {
    scales: {
      yAxes: [{
        id: 'A',
        type: 'linear',
        position: 'right',
        ticks: {

            suggestedMin: (minimo - 5),

        }
      }, {
        id: 'B',
        type: 'linear', // BARCHART CON LA CANTIDAD DE KILOS PROMEDIO
        position: 'left',
        ticks: {
          min: 100
        }
      }]
    },
    plugins:{
        labels:{
            render: 'value'
        }
    }
  }
});







</script>