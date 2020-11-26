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

include 'ajax/datosReporte.ajax.php';

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
   
    <section class="content">
          <!-- // FILTROS -->
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-filtros" data-toggle="modal" data-target="#modalFiltros">
            <b>Filtros </b><i class="fa fa-filter" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-alimento" data-toggle="modal" data-target="#modalAlimento">
            <b>Alimento Consumido &nbsp </b><i class="icon-corn" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;">
            <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>
          <p class="btn" style="cursor:default;font-size:1.1em;">Peridodo General: <?php echo formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal);?>  </p>
          <div class="row">

                <div class="col-md-12" id="reportesFiltrados">

                  <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs" style="font-size:1.5em;">
                          <li class="tabs active" id="cicloCompletoFiltrado"><a href="#tab_1F" data-toggle="tab">Ciclo Completo</a></li>
                          <li class="tabs" id="recriaPastorilFiltrado"><a href="#tab_2F" data-toggle="tab">Recr&iacute;a Pastoril</a></li>
                          <li class="tabs" id="recriaCorralFiltrado"><a href="#tab_3F" data-toggle="tab">Recr&iacute;a Corral</a></li>
                          <li class="tabs" id="terminacionFiltrado"><a href="#tab_4F" data-toggle="tab">Terminaci&oacute;n</a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1F">
                              
                              <?php include('cicloCompletoFiltrado.php'); ?>
                          
                          </div>

                          <div class="tab-pane recriaPastoril" id="tab_2F">

                              <?php include('recriaPastorilFiltrado.php'); ?>

                          </div>

                          <div class="tab-pane recriaCorral" id="tab_3F">

                              <?php include('recriaCorralFiltrado.php'); ?>

                          </div>

                          <div class="tab-pane terminacion" id="tab_4F">
                          
                              <?php include('terminacionFiltrado.php'); ?>

                          </div>

                      </div>

                  </div>

                </div>
          </div>
    </section>
    </div>

</div>
 

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
                    <label>Rango de Fechas - General -</label>

                    <button type="button" class="btn btn-default" id="daterange-btn">
                    
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
                    <select class="form-control consignatarios" name="consignatario1" id="consignatario1" onchange=(generarProveedores(this.id))>
                      <option value='Consignatario'>Consignatario</option>";

                    <?php
                      $item = null;
                      $valor = null;
                      $variable = 'consignatario';
                      $consignatarios = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
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
                      <select class="form-control proveedores" name="proveedor1" id="proveedor1" onchange=(generarTropas(this.id))>
                      <option value='Proveedor'>Proveedor</option>";
                        <?php
                          
                          $item = null;
                          $valor = null;
                          $variable = 'proveedor';
                          $proveedores = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
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
                          $tropas = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
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

          <button type="submit" class="btn btn-primary" id="generarReporte">Generar Reporte</button>

        </div>

    </div>

  </div>

</div>

<div id="modalAlimento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:800px;">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Alimento Diario consumido durante Proceso Productivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Grafico -->

            <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs navTabAlimento">
                  
                  <li class="tabs active" id="tabGeneral"><a href="#general" data-toggle="tab"><b>GENERAL</b></a></li>
                  
              </ul>
              
              <div class="tab-content tabContAlimento">
                
                <div class="tab-pane active" id="general">
                  
                  <div class="box-header with-border">
                  
                    <div class="row">
                      
                      <div class="col-md-12">
                        
                        <div class="box box-success">
                          
                          <div class="box-body">
                            
                            <div class="chart">
                              
                              <canvas id="alimentoConsumidoGeneral"></canvas>
                          
                            </div>
                          
                          </div>
                        
                        </div>

                      </div>

                    </div>

                  </div>
        
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
        function stringToNumber(array){
          for (let index = 0; index < array.length; index++) {
              array[index] = parseFloat(array[index]);
          }
        }

        var cantidad = <?php echo $cantidad;?>;

        var resultados = [<?php echo $label;?>];
  
        var datosGraficos = <?php echo $datosGraficos;?>;
        var kgConsumidos = datosGraficos[0]['kg'].split(',');
        var adpvGeneral = datosGraficos[0]['adpv'].split(',');
        var conversion = datosGraficos[0]['conv'].split(',');
        stringToNumber(adpvGeneral);
        stringToNumber(kgConsumidos);
        stringToNumber(kgConsumidos);
        
        function generarGraficoAlimento(idCanvas,adpvData,kgConsumidos,conversion){

          var ctx = document.getElementById(idCanvas).getContext('2d');
          new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['Ciclo Completo','R. Pastoril', 'R. Corral', 'Terminacion'],
            datasets: [{
              type: 'line',
              label: 'ADPV',
              borderColor: window.chartColors.red,
              fill:false,
              yAxisID: 'A',
              data: adpvData
            },{
              label: 'CONVERSIÓN MS',
              type: 'bar',
              yAxisID: 'A',
              data: conversion,
              fill:false,
              borderColor: window.chartColors.blue,
              backgroundColor: window.chartColors.blue,
              borderWidth: 2

            }
            // ,{
            //   label: 'Kg Alimento Consumido',
            //   type: 'bar',
            //   backgroundColor: window.chartColors.green,
            //   yAxisID: 'B',
            //   data: kgConsumidos,
            //   borderColor: 'white',
            //   borderWidth: 2
            // }
            ]
            },
          options: {
            scales: {
            yAxes: [{
              id: 'A',
              type: 'linear',
              position: 'left',
              ticks: {
                suggestedMin: 0,
                suggestedMax: 2
              }
            }
            // , {
            //   id: 'B',
            //   type: 'linear', // BARCHART CON LA CANTIDAD DE KILOS PROMEDIO
            //   position: 'right',
            //   ticks: {
            //   max: (kgConsumidos.reduce((n,m) => Math.max(n,m), -Number.POSITIVE_INFINITY) + 5),
            //   min: 0
            //   }
            // }
            ]
            },
            plugins:{
              labels:{
                render: 'value'
              }
            }
          }
          });

        }

        generarGraficoAlimento('alimentoConsumidoGeneral',adpvGeneral,kgConsumidos,conversion);
        var contador = 1;


        resultados.forEach(element => {
          var tab = '<li class="tabs" id="tabFiltro' + contador + '"><a href="#filtro' + contador + '" data-toggle="tab"><b>' + element + '</b></a></li>';

          var grafico = '<div class="tab-pane" id="filtro' + contador + '">'
          grafico    +=   '<div class="box-header with-border"><div class="row">';
          grafico    +=     '<div class="col-md-12">';
          grafico    +=       '<div class="box box-success">';
          grafico    +=         '<div class="box-body">';
          grafico    +=           '<div class="chart">';
          grafico    +=             '<canvas id="alimentoConsumidoFiltro' + contador + '"></canvas>';
          grafico    +=           '</div></div></div></div></div></div></div>';

          $('.navTabAlimento').append(tab);
          $('.tabContAlimento').append(grafico);

          var idCanvas = 'alimentoConsumidoFiltro' + contador;
          var adpvData =  datosGraficos[contador]['adpv'].split(',');
          var kgConsumidos =  datosGraficos[contador]['kg'].split(',');
          conversion = datosGraficos[contador]['conv'].split(',');
          stringToNumber(adpvData);
          stringToNumber(kgConsumidos);
          
          generarGraficoAlimento(idCanvas,adpvData,kgConsumidos,conversion);
          contador++;
        });

        var color = Chart.helpers.color;

        function opciones(configuracion){
          var opciones = {
            type: 'bar',
            data: configuracion,
            options: {
              responsive: true,
              legend: {
                position: 'top',
              },
              title: {
                display: false,
              },
              plugins: {
                labels: {
                  render: 'value'
                }
              },
              legend: {
                labels: {
                    boxWidth: 5
                }
              },
              scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
            }
          }
          return opciones;
        }


        //POBLACION
        var configPCC = {
          type: 'pie',
          data: {
            datasets: [{
              data: [
                <?php echo $poblacionCC;?>
              ],
              backgroundColor: [
                <?php echo $coloresCC;?> 
              ],
              label: 'Porcentaje'
            }],
            labels: [
              <?php   echo $label;?>
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

        var configPRP = {
          type: 'pie',
          data: {
            datasets: [{
              data: [
                <?php echo $poblacionRP;?>
              ],
              backgroundColor: [
                <?php echo $coloresRP;?> 
              ],
              label: 'Porcentaje'
            }],
            labels: [
              <?php   echo $label;?>
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

        var configPRC = {
          type: 'pie',
          data: {
            datasets: [{
              data: [
                <?php echo $poblacionRC;?>
              ],
              backgroundColor: [
                <?php echo $coloresRC;?> 
              ],
              label: 'Porcentaje'
            }],
            labels: [
              <?php   echo $label;?>
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

        var configPT = {
          type: 'pie',
          data: {
            datasets: [{
              data: [
                <?php echo $poblacionT;?>
              ],
              backgroundColor: [
                <?php echo $coloresT;?> 
              ],
              label: 'Porcentaje'
            }],
            labels: [
              <?php   echo $label;?>
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

        // CANTIDAD

          //CC
          var configCantidadCC = {
            labels: [
              'Animales'
            ],
            datasets:[
              <?php 
                echo $cantidadCC;
              ?> 
            ]
          };

          //RP
          var configCantidadRP = {
            labels: [
              'Animales'
            ],
            datasets:[
              <?php 
                echo $cantidadRP;
              ?> 
            ]
          };

          //RC
          var configCantidadRC = {
            labels: [
              'Animales'
            ],
            datasets:[
              <?php 
                echo $cantidadRC;
              ?> 
            ]
          };

          //T
          var configCantidadT = {
            labels: [
              'Animales'
            ],
            datasets:[
              <?php 
                echo $cantidadT;
              ?> 
            ]
          };


        // ADPV

          //CC
          var configAdpvCC = {
            labels: [
              'Kg Prom'
            ],
            datasets:[
              <?php 
                echo $adpvCC;
              ?> 
            ]
          };

          //RP
          var configAdpvRP = {
            labels: [
              'Kg Prom'
            ],
            datasets:[
              <?php 
                echo $adpvRP;
              ?> 
            ]
          };

          //RC
          var configAdpvRC = {
            labels: [
              'Kg Prom'
            ],
            datasets:[
              <?php 
                echo $adpvRC;
              ?> 
            ]
          };

          //T
          var configAdpvT = {
            labels: [
              'Kg Prom'
            ],
            datasets:[
              <?php 
                echo $adpvT;
              ?> 
            ]
          };


        // DIAS

          //CC
          var configDiasCC = {
            labels: [
              'Días Prom.'
            ],
            datasets:[
              <?php 
                echo $diasCC;
              ?> 
            ]
          };

          //RP
          var configDiasRP = {
            labels: [
              'Días Prom.'
            ],
            datasets:[
              <?php 
                echo $diasRP;
              ?> 
            ]
          };

          //RC
          var configDiasRC = {
            labels: [
              'Días Prom.'
            ],
            datasets:[
              <?php 
                echo $diasRC;
              ?> 
            ]
          };

          //T
          var configDiasT = {
            labels: [
              'Días Prom.'
            ],
            datasets:[
              <?php 
                echo $diasT;
              ?> 
            ]
          };


        
        

        // KG ING

          //CC
          var configKgIngCC = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgIngCC;
              ?> 
            ]
          };

          //RP
          var configKgIngRP = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgIngRP;
              ?> 
            ]
          };

          //RC
          var configKgIngRC = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgIngRC;
              ?> 
            ]
          };

          //T
          var configKgIngT = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgIngT;
              ?> 
            ]
          };


        // KG EGR 

          //CC
          var configKgEgrCC = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgEgrCC;
              ?> 
            ]
          };

          //RP
          var configKgEgrRP = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgEgrRP;
              ?> 
            ]
          };

          //RC
          var configKgEgrRC = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgEgrRC;
              ?> 
            ]
          };

          //T
          var configKgEgrT = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgEgrT;
              ?> 
            ]
          };


        // KG PROD 

          //CC
          var configKgProdCC = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgProdCC;
              ?> 
            ]
          };

          //RP
          var configKgProdRP = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgProdRP;
              ?> 
            ]
          };

          //RC
          var configKgProdRC = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgProdRC;
              ?> 
            ]
          };

          //T
          var configKgProdT = {
            labels: [
              'Kg Prom.'
            ],
            datasets:[
              <?php 
                echo $kgProdT;
              ?> 
            ]
          };

        // GRAFICOS ADPV
          var barChartFiltrado = document.getElementById('barChartFiltrado').getContext('2d');      
          var adpvCC = new Chart(barChartFiltrado, opciones(configAdpvCC) );

          var barChartRPFiltrado = document.getElementById('barChartRPFiltrado').getContext('2d');
          var adpvRP = new Chart(barChartRPFiltrado, opciones(configAdpvRP) );

          var barChartRCFiltrado = document.getElementById('barChartRCFiltrado').getContext('2d');
          var adpvRC = new Chart(barChartRCFiltrado, opciones(configAdpvRC) );

          var barChartTFiltrado = document.getElementById('barChartTFiltrado').getContext('2d');
          var adpvT = new Chart(barChartTFiltrado, opciones(configAdpvT) );

       
        // GRAFICOS DIAS
          var barChart1Filtrado = document.getElementById('barChart1Filtrado').getContext('2d');      
          var diasCC = new Chart(barChart1Filtrado, opciones(configDiasCC) );

          var barChart1RPFiltrado = document.getElementById('barChart1RPFiltrado').getContext('2d');
          var diasRP = new Chart(barChart1RPFiltrado, opciones(configDiasRP) );

          var barChart1RCFiltrado = document.getElementById('barChart1RCFiltrado').getContext('2d');
          var diasRC = new Chart(barChart1RCFiltrado, opciones(configDiasRC) );

          var barChart1TFiltrado = document.getElementById('barChart1TFiltrado').getContext('2d');
          var diasT = new Chart(barChart1TFiltrado, opciones(configDiasT) );

        // GRAFICOS KG ING
          var barChart2Filtrado = document.getElementById('barChart2Filtrado').getContext('2d');      
          var kgIngCC = new Chart(barChart2Filtrado, opciones(configKgIngCC) );

          var barChart2RPFiltrado = document.getElementById('barChart2RPFiltrado').getContext('2d');
          var kgIngRP = new Chart(barChart2RPFiltrado, opciones(configKgIngRP) );

          var barChart2RCFiltrado = document.getElementById('barChart2RCFiltrado').getContext('2d');
          var kgIngRC = new Chart(barChart2RCFiltrado, opciones(configKgIngRC) );

          var barChart2TFiltrado = document.getElementById('barChart2TFiltrado').getContext('2d');
          var kgIngT = new Chart(barChart2TFiltrado, opciones(configKgIngT) );
        
        // GRAFICOS KG EGR
          var barChart3Filtrado = document.getElementById('barChart3Filtrado').getContext('2d');      
          var kgEgrCC = new Chart(barChart3Filtrado, opciones(configKgEgrCC) );

          var barChart3RPFiltrado = document.getElementById('barChart3RPFiltrado').getContext('2d');
          var kgEgrRP = new Chart(barChart3RPFiltrado, opciones(configKgEgrRP) );

          var barChart3RCFiltrado = document.getElementById('barChart3RCFiltrado').getContext('2d');
          var kgEgrRC = new Chart(barChart3RCFiltrado, opciones(configKgEgrRC) );

          var barChart3TFiltrado = document.getElementById('barChart3TFiltrado').getContext('2d');
          var kgEgrT = new Chart(barChart3TFiltrado, opciones(configKgEgrT) );

        // GRAFICOS KG PROD
          var barChart4Filtrado = document.getElementById('barChart4Filtrado').getContext('2d');      
          var kgProdCC = new Chart(barChart4Filtrado, opciones(configKgProdCC) );

          var barChart4RPFiltrado = document.getElementById('barChart4RPFiltrado').getContext('2d');
          var kgProdRP = new Chart(barChart4RPFiltrado, opciones(configKgProdRP) );

          var barChart4RCFiltrado = document.getElementById('barChart4RCFiltrado').getContext('2d');
          var kgProdRC = new Chart(barChart4RCFiltrado, opciones(configKgProdRC) );

          var barChart4TFiltrado = document.getElementById('barChart4TFiltrado').getContext('2d');
          var kgProdT = new Chart(barChart4TFiltrado, opciones(configKgProdT) );

        // GRAFICOS POBLACION
          var porcentajePoblacion = document.getElementById('pieChart1Filtrado').getContext('2d');
          var poblacionCC = new Chart(porcentajePoblacion, configPCC);

          var porcentajePoblacionRP = document.getElementById('pieChart1RPFiltrado').getContext('2d');
          var poblacionRP = new Chart(porcentajePoblacionRP, configPRP);

          var porcentajePoblacionRC = document.getElementById('pieChart1RCFiltrado').getContext('2d');
          var poblacionRC = new Chart(porcentajePoblacionRC, configPRC);

          var porcentajePoblacionT = document.getElementById('pieChart1TFiltrado').getContext('2d');
          var poblacionT = new Chart(porcentajePoblacionT, configPT);

})
</script> 
