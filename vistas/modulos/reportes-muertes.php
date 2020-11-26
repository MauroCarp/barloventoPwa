<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

 
  
}
   
include 'ajax/datosReporteMuertes.ajax.php';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reportes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reportes</li>
    
    </ol>

  </section>
  
  
  <div class="box">
   
    <section class="content" style="padding-top:0;">

          <!-- // FILTROS -->
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-filtros" data-toggle="modal" data-target="#modalFiltros">
            <b>Filtros </b><i class="fa fa-filter" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-muertesMes" data-toggle="modal" data-target="#modalMuertesMeses">
            <b>Distribuci&oacute;n Mensual de Muertes </b><i class="icon-muerteIco" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-muertesTratadas" data-toggle="modal" data-target="#modalMuertesTratadas">
            <b>Distribuci&oacute;n Muertes Tratadas &nbsp;</b><i class="fa fa-plus-square" style="color:#d834eb;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;">
                  <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          

          <div class="row">

                <div class="col-md-12" id="reportesMuertes">

                <?php include 'reportes/muertes.php'; ?>

                </div>
          </div>
    </section>
    </div>

</div>

<!--=====================================
MODAL FILTROS
======================================-->

<div id="modalFiltros" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Filtros de reportes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Filtros -->

            
            <div class="box-header with-border" id="filtros">
            
              <div class="input-group">
                
                <div class="row">

                  <div class="col-md-8">
                    <label>Rango de Fechas</label>

                    <button type="button" class="btn btn-default" id="daterange-btnMuertes">
                    
                      <span>
                        <i class="fa fa-calendar"></i> 
                          Rango de Fecha
                      </span>

                      <i class="fa fa-caret-down"></i>

                    </button>

                  </div>

                </div>

              </div>
              <br>
              <div class="row">
                
                <div class="col-md-4">

                  <div class="form-group">
                    <label>Consignatario</label>
                    <select class="form-control consignatarios" name="consignatario1" id="consignatario1" onchange=(generarProveedores(this.id,'muertes'))>
                      <option value='Consignatario'>Consignatario</option>";

                    <?php
                      $item = null;
                      $valor = null;
                      $variable = 'consignatario';
                      $consignatarios = ControladorDatosMuertes::ctrMostrarTropas($variable,$item,$valor);
                      asort($consignatarios);
                      foreach ($consignatarios as $key => $value) {
                      echo "<option value='".utf8_decode($value[0])."'>".utf8_decode($value[0])."</option>";
                      }
                    ?>
                    </select>

                  </div>

                </div>

                  <div class="col-md-4">

                    <div class="form-group">
                      <label>Proveedor</label>
                      <select class="form-control proveedores" name="proveedor1" id="proveedor1" onchange=(generarTropas(this.id,'muertes'))>
                      <option value='Proveedor'>Proveedor</option>";
                        <?php
                          
                          $item = null;
                          $valor = null;
                          $variable = 'proveedor';
                          $proveedores = ControladorDatosMuertes::ctrMostrarTropas($variable,$item,$valor);
                          asort($proveedores);
                          foreach ($proveedores as $key => $value) {
                          echo "<option value='".$value[0]."'>".$value[0]."</option>";
                          }
                          
                        ?>
                      </select>

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">
                      <label>Tropa</label>
                      <select class="form-control tropas" name="tropa1" id="tropa1" onchange=(bloquearProveedor(this.id))>
                      <option value='Tropa'>Tropa</option>";
                        <?php
                          
                          $item = null;
                          $valor = null;
                          $variable = 'tropa';
                          $tropas = ControladorDatosMuertes::ctrMostrarTropas($variable,$item,$valor);
                          asort($tropas);
                          foreach ($tropas as $key => $value) {
                          echo "<option value='".$value[0]."'>".$value[0]."</option>";
                          }
                          
                        ?>
                      </select>

                    </div>

                  </div>

              </div>

              <div class="row" id="btn-plus">
                <div class="col-md-1">
                  <button type="button" class="btn btn-info" id="comparar"><i class="fa fa-plus"></i></button>
                </div>
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="generarReporteMuertes">Generar Reporte</button>

        </div>

    </div>

  </div>

</div>
 

<!--=====================================
MODAL GRAFICO DISTRIBUCION MUERTES
======================================-->

<div id="modalMuertesMeses" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:70%;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Distribuci&oacute;n Mensual de Muertes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Filtros -->

            
            <div class="box-header with-border" id="graficoMuertesMeses">
                   
              <div class="box box-success">

                <div class="box-header with-border">

                  <h3 class="box-title">Distribución Mensual de Muertes General</h3>

                </div>

                <div class="box-body">

                  <div class="chart">

                    <canvas id="muertesMesGeneral" style="height:100%"></canvas>

                  </div>

                </div>

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL GRAFICO  MUERTES TRATADAS
======================================-->

<div id="modalMuertesTratadas" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:70%;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Distribuci&oacute;n de Muertes Tratadas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Filtros -->

            
            <div class="box-header with-border" id="graficoMuertesMeses">
                   
              <div class="box box-success">

                <div class="box-header with-border">

                  <h3 class="box-title">Distribución de Muertes Tratadas General</h3>

                </div>

                <div class="box-body">

                  <div class="chart">

                    <canvas id="muertesTratadasGeneral" style="height:100%"></canvas>

                  </div>

                </div>

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

    </div>

  </div>

</div>


<script>
  $(function () {
    

    var tropas = [];
    <?php 
      foreach ($tropas as $key => $value) {
    ?>
    tropas.push(<?php echo "'".$value[0]."'";?>);
    <?php
      }
    ?>

    localStorage.setItem("tropas", tropas);

    var proveedores = [];
    <?php 
      foreach ($proveedores as $key => $value) {
    ?>
    proveedores.push(<?php echo "'".$value[0]."'";?>);
    <?php
      }
    ?>

   localStorage.setItem("proveedores", proveedores);


   var consignatarios = [];
    <?php 
      foreach ($consignatarios as $key => $value) {
    ?>
    consignatarios.push(<?php echo "'".$value[0]."'";?>);
    <?php
      }
    ?>

   localStorage.setItem("consignatarios", consignatarios);

   function opciones(configuracion){
    var opciones = {
      type: 'bar',
        data: configuracion,
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
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scaleShowValues: true,

          scales: {
              xAxes: [{
                ticks: {
                  autoSkip: false
                }
              }],
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                  }
              }]
          }
        }
      }
    return opciones;
  }

  
      var muertesSexo = document.getElementById('muertesSexo').getContext('2d');
      var chartMuertesSexo = new Chart(muertesSexo, configMuertesSexo);

      var muertesMotivo = document.getElementById('muertesMotivo').getContext('2d');
      var chartMuertesMotivo = new Chart(muertesMotivo, configMuertesCausa);

      var porcentajeMotivo = document.getElementById('porcentajeMotivo').getContext('2d');
      var chartPorcentajeMotivo = new Chart(porcentajeMotivo, configPorcentajeMuertesCausa);

  
      var muertesConsignatario = document.getElementById('muertesConsignatario').getContext('2d');
      var chartMuertesConsignatario = new Chart(muertesConsignatario, opciones(confMuertesConsignatario));
     
      var muertesProveedor = document.getElementById('muertesProveedor').getContext('2d');
      var chartMuertesProveedor = new Chart(muertesProveedor, {
        type: 'bar',
        data: confMuertesProveedor,
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
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scaleShowValues: true,

          scales: {
              xAxes: [{
                ticks: {
                  autoSkip: false
                }
              }],
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                  }
              }]
          }
        }
      });


      
      var datos = <?php echo $datosJson;?>;
      
      var dataSet = datos['muertesMesesGeneral'];
      dataSet.shift();        
      
      var labelsMeses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

      var id = 'muertesMesGeneral';
      
      var valor = 'value';
      
      var colorChart = '#ff6b6b';
     
      graficoChart(dataSet,labelsMeses,id,valor,colorChart);

 
      var muertesTratadas = <?php echo $muertesTratadasJson;?>;
      
      colorChart = ['#ff6b6b','#f06bff'];

      var id = 'muertesTratadasGeneral';
      
      var etiqueta = ['','No Tratados','Tratados'];
      
      cantidad = 2;

      graficoChartStack(muertesTratadas,labelsMeses,etiqueta,id,valor,colorChart,cantidad);



  })
</script> 
