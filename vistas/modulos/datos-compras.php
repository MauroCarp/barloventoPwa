<?php
function formatearFecha($fecha){
  $fecha = explode('-',$fecha);
  $nuevaFecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
  return $nuevaFecha;
}

$alertaValida = array_key_exists('alerta',$_GET);

if($alertaValida){
  echo'<script>

					swal({
						  type: "error",
						  title: "Los registros del mes y año que se quisieron cargar, ya estan cargados.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "datos-compras";

									}
								})

					</script>';
}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Cargar Datos de Compras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Cargar Datos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCargarDatos">
          
          Cargar Datos

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Consignatario</th>
           <th style="width:400px">Proveedor</th>
           <th>Tropa</th>
           <th>Fecha de Compra</th>
           <th>Cantidad</th>
           <th>Kg Ingreso</th>
           <th>$ Kg</th> 

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = NULL;
          $valor = NULL;
          $orden = 'fecha';
          $datos = ControladorDatosCompras::ctrMostrardatos($item, $valor,$orden);

          foreach ($datos as $key => $value){
            
            $fecha = strtotime($value['fecha']);
            $fecha = date('d-m-Y',$fecha);

            echo ' <tr>
                    <td>'.$value["consignatario"].'</td>
                    <td>'.$value["proveedor"].'</td>
                    <td>'.$value["tropa"].'</td>
                    <td>'.$fecha.'</td>
                    <td>'.$value["cantidad"].'</td>
                    <td>'.number_format($value["kgIng"],2,',','.').' Kg</td>
                    <td>$ '.number_format(($value["precioTotalKg"] / $value["kgIng"]),2,',','.').'</td>
                  </tr>';
          }
        

        ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalCargarDatos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" action="cargar-datos-compras.php">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cargar Datos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">Seleccionar Archivo</div>

              <input type="file" class="nuevosDatos" name="nuevosDatos">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Cargar Datos</button>

        </div>

      </form>

    </div>

  </div>

</div>






