<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php


			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>
	
			<li class="treeview">

				<a href="#">

					<i class="icon-COW"></i>
					
					<span>Compras</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="datos-compras">
							
							<i class="fa fa-circle-o"></i>
							<span>Cargar Compras</span>

						</a>

					</li>

					<li>

						<a href="#" data-toggle="modal" data-target="#modalCompras">
							
							<i class="fa fa-bar-chart"></i>
							<span>Generar Reportes</span>

						</a>

					</li>
				</ul>

			</li>


			<li class="treeview">

				<a href="#">

					<i class="fa fa-money"></i>
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="datos">
							
							<i class="fa fa-circle-o"></i>
							<span>Cargar Ventas</span>

						</a>

					</li>

					<li>

						<a href="reportes">
							
							<i class="fa fa-bar-chart"></i>
							<span>Generar Reportes</span>

						</a>

					</li>
				</ul>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="icon-muerteIco"></i>
					<span>Muertes</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="datos-muertes">
							
							<i class="fa fa-circle-o"></i>
							<span>Cargar Muertes</span>

						</a>

					</li>

					<li>

						<a href="reportes-muertes">
							
							<i class="fa fa-bar-chart"></i>
							<span>Generar Reportes</span>

						</a>

					</li>
				</ul>

			</li>

			<li>

				<a href="piri">

					<i class="fa fa-line-chart "></i>
					<span>P.I.R.I</span>

				</a>

			</li>'
			;
		

		?>

		</ul>

	 </section>

</aside>

<div id="modalCompras" class="modal fade" role="dialog" >
  
  <div class="modal-dialog" style="width:300px;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Reporte de Compras</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            
            <div class="box-header with-border">
            
              <div class="input-group">
                
                <div class="row">

                  <div class="col-md-12">

                    <button type="button" class="btn btn-default btn-lg btn-block" id="daterange-btnCompras">
                    
                      <span>
                        <i class="fa fa-calendar"></i> 
                          Rango de Fecha
                      </span>

                      <i class="fa fa-caret-down"></i>

                    </button>

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

          <button type="submit" class="btn btn-primary" id="generarReporteCompras">Generar Reporte</button>

        </div>

    </div>

  </div>

</div>