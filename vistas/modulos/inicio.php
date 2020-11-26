<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="row">
      
    <?php

    if($_SESSION["perfil"] =="Administrador"){

      include "inicio/cajas-superiores.php";

    }

    ?>

    </div> 

     <div class="row">
       
        <!-- <div class="col-lg-12">

          <?php

          // if($_SESSION["perfil"] =="Administrador"){
          
          //  include "reportes/grafico-dias.php";


          // }

          ?>

        </div> -->
        <div class="col-md-4">
          <?php

            if($_SESSION["perfil"] =="Administrador"){

            include "inicio/rankingConsignatarios.php";


            }

          ?>
        </div>  
        
        <div class="col-md-4">
          <?php

            if($_SESSION["perfil"] =="Administrador"){

            include "inicio/rankingProveedores.php";


            }

          ?>
        </div>  
        
        <div class="col-md-4">
        <?php

          if($_SESSION["perfil"] =="Administrador"){

          include "inicio/rankingTropas.php";


          }

          ?>
        </div>  

         <div class="col-lg-12">
           
          <?php

          if($_SESSION["perfil"] =="Especial" || $_SESSION["perfil"] =="Vendedor"){

             echo '<div class="box box-success">

             <div class="box-header">

             <h1>Bienvenid@ ' .$_SESSION["nombre"].'</h1>

             </div>

             </div>';

          }

          ?>

         </div>

     </div>

    <div class="row">
          <div class="col-lg-12">
            <br>
            <img src="vistas/img/plantilla/logo-barlovento.png" style="width:100%;">
          
          </div>
    </div>
  </section>
 
</div>
