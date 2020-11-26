<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

 
  
}
   

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

          

          <div class="row">

                <div class="col-md-12" id="reportesGeneral">

                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" style="font-size:1.em;">
                      <li class="tabs active"><a href="#tab_1" data-toggle="tab">Ciclo Completo</a></li>
                      <li class="tabs" id="recriaPastoril"><a href="#tab_2" data-toggle="tab">Recr&iacute;a Pastoril</a></li>
                      <li class="tabs" id="recriaCorral"><a href="#tab_3" data-toggle="tab">Recr&iacute;a Corral</a></li>
                      <li class="tabs" id="terminacion"><a href="#tab_4" data-toggle="tab">Terminaci&oacute;n</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        
                        <?php include('reportes/cicloCompleto.php'); ?>
                      
                      </div>

                      <div class="tab-pane recriaPastoril" id="tab_2">
                      <?php include('reportes/recriaPastoril.php'); ?>

                      </div>

                      <div class="tab-pane recriaCorral" id="tab_3">
                      <?php include('reportes/recriaCorral.php'); ?>

                      </div>

                      <div class="tab-pane terminacion" id="tab_4">
                      <?php include('reportes/terminacion.php'); ?>

                      </div>

                    </div>

                  </div>

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
                    <select class="form-control consignatarios" name="consignatario1" id="consignatario1" onchange=(generarProveedores(this.id,'animales'))>
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
                      <select class="form-control proveedores" name="proveedor1" id="proveedor1" onchange=(generarTropas(this.id,'animales'))>
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
 

<script>
  $(function () {
    
   
    var url = window.location;
    if(url.toString().includes('activo')){
      
      var activo = url.toString().split("=");
      activo = activo[1];

      $('.tabs').each(function(){
        
        $(this).removeClass('active');
        
        var id = $(this).attr('id');
        
        if(id == activo){
          
          $(this).addClass('active');
          
        }
        
      });

      $('.tab-pane').each(function(){
        
        $(this).removeClass('active');

        var clase = $(this).attr('class');
        
        if(clase.includes(activo)){
        
          $(this).addClass('active');
        
        }

      });

    }; 

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
    // CICLO COMPLETO
      var poblacionSexo = document.getElementById('pieChart').getContext('2d');
      window.myPie = new Chart(poblacionSexo, configPSS);


      // var porcentajePoblacion = document.getElementById('pieChart1').getContext('2d');
      // window.myPie = new Chart(porcentajePoblacion, configPP);
      

      
      var adpv = document.getElementById('barChart').getContext('2d');
      var chartAdpvGeneral = new Chart(adpv, {
        type: 'bar',
        data: configADPV,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvCC;?>
                  }
              }]
          }
        }
      });

      var dias = document.getElementById('barChart1').getContext('2d');
      var chartDiasGeneral = new Chart(dias, {
        type: 'bar',
        data: configDias,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgIng = document.getElementById('barChart2').getContext('2d');
      var chartKgIngGeneral = new Chart(kgIng, {
        type: 'bar',
        data: configKgIng,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Kg Ingreso'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgEgr = document.getElementById('barChart3').getContext('2d');
      var chartkgEgrGeneral = new Chart(kgEgr, {
        type: 'bar',
        data: configKgEgr,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Kg Salida'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      
      var kgProd = document.getElementById('barChart4').getContext('2d');
      var chartkgProdGeneral = new Chart(kgProd, {
        type: 'bar',
        data: configKgProd,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Kg Prod.'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });


    ////// RECRIA PASTORIL ///////

      // var poblacionSexoRP = document.getElementById('pieChartRP').getContext('2d');
      // window.myPie = new Chart(poblacionSexoRP, configPSSRP);


      var porcentajePoblacionRP = document.getElementById('pieChart1RP').getContext('2d');
      window.myPie = new Chart(porcentajePoblacionRP, configPPRP);
      

      
      var adpvRP = document.getElementById('barChartRP').getContext('2d');
      var chartAdpvRPGeneral = new Chart(adpvRP, {
        type: 'bar',
        data: configADPVRP,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvRP;?>
                  }
              }]
          }
        }
      });

      var diasRP = document.getElementById('barChart1RP').getContext('2d');
      var chartDiasRPGeneral = new Chart(diasRP, {
        type: 'bar',
        data: configDiasRP,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgIngRP = document.getElementById('barChart2RP').getContext('2d');
      var chartkgIngRPGeneral = new Chart(kgIngRP, {
        type: 'bar',
        data: configKgIngRP,
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
          }
        }
      });

      var kgEgrRP = document.getElementById('barChart3RP').getContext('2d');
      var chartKgEgrRPGeneral = new Chart(kgEgrRP, {
        type: 'bar',
        data: configKgEgrRP,
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
          }
        }
      });

      var kgProdRP = document.getElementById('barChart4RP').getContext('2d');
      var chartKgProdRPGeneral = new Chart(kgProdRP, {
        type: 'bar',
        data: configKgProdRP,
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
          }
        }
      });


    
    ////// RECRIA CORRAL ///////

      // var poblacionSexoRC = document.getElementById('pieChartRC').getContext('2d');
      // window.myPie = new Chart(poblacionSexoRC, configPSSRC);


      var porcentajePoblacionRC = document.getElementById('pieChart1RC').getContext('2d');
      window.myPie = new Chart(porcentajePoblacionRC, configPPRC);
      

      
      var adpvRC = document.getElementById('barChartRC').getContext('2d');
      var chartAdpvRCGeneral = new Chart(adpvRC, {
        type: 'bar',
        data: configADPVRC,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvRC;?>
                  }
              }]
          }
        }
      });

      var diasRC = document.getElementById('barChart1RC').getContext('2d');
      var chartDiasRCGeneral = new Chart(diasRC, {
        type: 'bar',
        data: configDiasRC,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgIngRC = document.getElementById('barChart2RC').getContext('2d');
      var chartKgIngRCGeneral = new Chart(kgIngRC, {
        type: 'bar',
        data: configKgIngRC,
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
          }
        }
      });

      var kgEgrRC = document.getElementById('barChart3RC').getContext('2d');
      var chartKgEgrRCGeneral = new Chart(kgEgrRC, {
        type: 'bar',
        data: configKgEgrRC,
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
          }
        }
      });

      var kgProdRC = document.getElementById('barChart4RC').getContext('2d');
      var chartKgProdRCGeneral = new Chart(kgProdRC, {
        type: 'bar',
        data: configKgProdRC,
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
          }
        }
      });

        
    ////// TERMINACION ///////

      // var poblacionSexoT = document.getElementById('pieChartT').getContext('2d');
      // window.myPie = new Chart(poblacionSexoT, configPSST);


      var porcentajePoblacionT = document.getElementById('pieChart1T').getContext('2d');
      window.myPie = new Chart(porcentajePoblacionT, configPPT);
      

      
      var adpvT = document.getElementById('barChartT').getContext('2d');
      var chartAdpvTGeneral = new Chart(adpvT, {
        type: 'bar',
        data: configADPVT,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvT;?>
                  }
              }]
          }
        }
      });

      var diasT = document.getElementById('barChart1T').getContext('2d');
      var chartDiasTGeneral = new Chart(diasT, {
        type: 'bar',
        data: configDiasT,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgIngT = document.getElementById('barChart2T').getContext('2d');
      var chartKgIngTGeneral = new Chart(kgIngT, {
        type: 'bar',
        data: configKgIngT,
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
          }
        }
      });

      var kgEgrT = document.getElementById('barChart3T').getContext('2d');
      var chartKgEgrTGeneral = new Chart(kgEgrT, {
        type: 'bar',
        data: configKgEgrT,
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
          }
        }
      });

      var kgProdT = document.getElementById('barChart4T').getContext('2d');
      var chartKgProdTGeneral = new Chart(kgProdT, {
        type: 'bar',
        data: configKgProdT,
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
          }
        }
      });



  })
</script> 
