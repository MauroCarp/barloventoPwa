<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

 
  
}

function formatearFecha($fecha){
  $nuevaFecha = explode('-',$fecha);
  $nuevaFecha = $nuevaFecha[2]."-".$nuevaFecha[1]."-".$nuevaFecha[0];
  return $nuevaFecha;

}

function porcentaje($dato,$total){
  $porcentaje = ($dato * 100) / $total;
  return $porcentaje;
}

include 'ajax/datosReporteCompras.ajax.php';


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reportes de Compras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reportes de Compras</li>
    
    </ol>

  </section>
  
  
  <div class="box">
   
    <section class="content" style="padding-top:10px;">
      <div class="row">
        <div class="col-md-6">
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-costos" data-toggle="modal" data-target="#modalCostos">
                  <b>Costos &nbsp </b><i class="fa fa-usd" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;">
                  <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>
          
          <p class="btn" style="cursor:default;font-size:1.1em;">Peridodo General: <?php echo formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal);?>  </p>
        </div>
      </div>
       <div class="row">

              <div class="col-md-12" id="reportesGeneral">
                      
                <?php include('reportes/compras.php'); ?>

              </div>

        </div>

    </section>
    </div>

</div>

 
<div id="modalCostos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:1200px;margin-left:-300px">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Relacion Precio Kg Pagado, Precio Piri - Promedio de Kilos Comprados</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Grafico -->

            
            <div class="box-header with-border" id="graficoCosto">
            
              <div class="row">
                
                <div class="col-md-12">

                <?php include "reportes/grafico-costos.php";?>

                </div>

              </div>

            </div>

          </div>

        </div>

    </div>

  </div>

</div>

<script>
  $(function () {


    var dataConsignatario = <?php echo $dataAnimalesConsignatario?>;


    var cantTotal = document.getElementById('cantCabezas').getContext('2d');
    window.myPie = new Chart(cantTotal, confCantTotal);   

    var cantCabezasSexo = document.getElementById('cantCabezasSexo').getContext('2d');
    window.myPie = new Chart(cantCabezasSexo, confCantCabezasSexo);     

 
    var costoCantidadConsignatario = document.getElementById('precioCantidaConsignatario').getContext('2d');
	  new Chart(costoCantidadConsignatario, {
      type: 'bar',
      data: {
        labels: [<?php echo $nombresPorConsignatarioResumidos;?>],
        datasets: [
        {
          type: 'line',
          label: 'Precio Promedio de la Cabeza',
          borderColor: window.chartColors.red,
          fill:false,
          yAxisID: 'A',
          data: [
            <?php echo $precioPromedioTotalPorConsignatario;?>
          ]
        }
        ,
        {
          label: 'Cabezas',
          type: 'bar',
          backgroundColor: window.chartColors.green,
          yAxisID: 'B',
          data: [
            <?php echo $animalesPorConsignatario;?>
          ],
          borderColor: 'white',
          borderWidth: 2
        }
        ]
        },
        options: {
          scaleShowValues: true,
          scales: {
            xAxes: [{
              display:true,
              ticks: {
                autoSkip: false
              }
            }],
            yAxes: [{
              id: 'A',
              type: 'linear',
              position: 'left',
              // ticks: {
              //   suggestedMin: 500000,
              //   suggestedMax: 2000000
              // }
            }, {
              id: 'B',
              type: 'linear', // BARCHART CON LA CANTIDAD DE KILOS PROMEDIO
              position: 'right',
              // ticks: {
              // max: 250,
              // min: 0
              // }
            }]
          },
          plugins:{
            labels:{
              render: 'value'
            }
          },
          legend:{
            labels: {
                  boxWidth: 5
            }
          }
        }
    });


    var cantConsignatario = document.getElementById('cantConsignatario').getContext('2d');
    window.myPie = new Chart(cantConsignatario, confCantConsignatario);   

    var cantConsignatarioSexo = document.getElementById('cantConsignatarioSexo').getContext('2d');

		window.myBar = new Chart(cantConsignatarioSexo, {
				type: 'bar',
				data: confCantConsignatarioSexo,
				options: {
					title: {
						display: false,
						text: 'Cabezas por Consignatario y Sexo'
					},
					tooltips: {
						mode: 'index',
						intersect: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: true,
              display:true,
						}],
						yAxes: [{
							stacked: true
						}]
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          legend:{
            labels: {
                boxWidth: 5
            }
          },
          scaleShowValues: true,
          scales: {
            xAxes: [{
              ticks: {
                autoSkip: false
              }
            }]
          }
				}
    });
    
    var cantProveedor = document.getElementById('cantProveedor').getContext('2d');
			window.myBar = new Chart(cantProveedor, {
				type: 'bar',
				data: confCantProveedor,
				options: {
					responsive: true,
					legend: {
            position: 'top',
            labels: {
                boxWidth: 5
            }
					},
					title: {
						display: false,
						text: 'Cabezas por Proveedor'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
            xAxes: [{
              display:false,
						}],
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: 100
                  }
              }]
          }
				}
			});


  })

</script> 
