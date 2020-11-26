
/*=============================================
AGREGAR FILTROS
=============================================*/
var contador = 2;
$('#comparar').click(function(){
  var URLactual = window.location;
  URLactual = URLactual['href'];

  var tabla = (URLactual.includes('muertes') || URLactual.includes('reportesFiltradosMuertes')) ? 'muertes' : 'animales';
  
  var contenido = '';
  contenido += '<hr>';
  contenido +=      '<div class="row">';
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Consignatario</label>';
  contenido +=          '<select class="form-control consignatarios" id="consignatario' + contador + '" onchange="(generarProveedores(this.id,\''+ tabla +'\'))">';
  contenido +=            '<option value="Consignatario">Consignatario</option>';


  var consignatarios = localStorage.getItem("consignatarios").split(',');
console.log(consignatarios);
  consignatarios.forEach(valor => {
    contenido += '<option value="' + valor + '">' + valor + '</option>';
  });
  
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Proveedor</label>';
  contenido +=          '<select class="form-control tropas" id="proveedor' + contador + '" onchange="(generarTropas(this.id,\''+ tabla +'\'))">';
  contenido +=            '<option value="Proveedor">Proveedor</option>';

  var proveedores = localStorage.getItem("proveedores").split(',');

  proveedores.forEach(valor => {
    contenido += '<option value="' + valor + '">' + valor + '</option>';
  });
   
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Tropa</label>';
  contenido +=          '<select class="form-control tropas" id="tropa' + contador + '" onchange="(bloquearProveedor(this.id))">';
  contenido +=            '<option value="Tropa">Tropa</option>';

  var tropas = localStorage.getItem("tropas").split(',');

  tropas.forEach(valor => {
    contenido += '<option value="' + valor + '">' + valor + '</option>';
  });
   
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '</div>';
  contenido +=     '</div>';

  $("#btn-plus").before(contenido);

  contador++;

});


/*=============================================
GENERAR REPORTE
=============================================*/

$('#generarReporte').click(()=>{


    var contador = 1;
    var datosConsignatarios = "";
    var datosProveedores = "";
    var datosTropas = "";
    var arrayValidacion = [];

    $('.consignatarios').each(function(){
      
      var id = $(this).attr('id');
      
      var numeroId = id.substr(-1);
      
      
      
      var tropa = $('#tropa' + numeroId).val();
      
      datosTropas += 'tropa' + contador + '=' + tropa + '&';

      var proveedor = $('#proveedor' + numeroId).val();
      
      datosProveedores += 'proveedor' + contador + '=' + proveedor + '&';

      
      var consignatario = $(this).val();
  
      datosConsignatarios += 'consignatario' + contador + '=' + consignatario + '&';


      // VALIDACION 

      var consignatarioValido = false;
      var tropaValido = false;
      var proveedorValido = false;
    
      if(!consignatarioValido){
        
        consignatarioValido = (consignatario != 'Consignatario') ? true : false;
        
      } 

        console.log(consignatario);
        
        if(!proveedorValido){
          
          proveedorValido = (proveedor != 'Proveedor') ? true : false; 
          
        } 
        
        
        console.log(proveedor);    
        
        
        if(!tropaValido){
          
          tropaValido = (tropa != 'Tropa' ) ? true : false; 
          
        } 
              
        console.log(tropa);    

      formularioValido = (consignatarioValido || proveedorValido || tropaValido) ? true : false;

      arrayValidacion.push(formularioValido);


      contador++;
    });

    datosTropas = datosTropas.slice(0, -1);
    datosProveedores = datosProveedores.slice(0,-1);
    datosConsignatarios = datosConsignatarios.slice(0,-1);
    
    var rango = localStorage.getItem('rango');

    var camposValidos = true;

    for (let index = 0; index < arrayValidacion.length; index++) {
      
        if (arrayValidacion[index] == false) {
            camposValidos = false;
            break;
        }

    }

    
    if (!camposValidos) {

      swal({
        type: "error",
        title: "En algún filtro, no se seleccionó ninguno",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        });
      

    }else{
      
      window.location = 'index.php?ruta=reportes/reportesFiltrados&' + datosConsignatarios + '&' + datosProveedores + '&' + datosTropas + '&rango=' + rango + '&cantidad=' + (contador - 1);

    }


});


/*=============================================
GENERAR GRAFICOS
=============================================*/

function generarGraficos(chart,data,titulo,label,canvas){

  var color = Chart.helpers.color;
  
  var config = {
    labels: [
      titulo
    ],
    datasets:[
      data
    ]
  };

  var canvas = document.getElementById(canvas).getContext('2d');
  var chart = new Chart(canvas, {
    type: 'bar',
    data: config,
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

}

/*=============================================
BLOQUEAR PROVEEDOR Y CONSIG
=============================================*/

function bloquearProveedor(id){
  
  var numeroId = id.substr(-1);
  var valor = $('#tropa' + numeroId).val();
  if(valor == 'Tropa'){

    $('#proveedor' + numeroId).removeAttr('disabled');
    if($('#proveedor' + numeroId).val() == 'Proveedor'){

      $('#consignatario' + numeroId).removeAttr('disabled');
    
    }

  }

    
  if (valor != 'Tropa') {

    $('#proveedor' + numeroId).attr('disabled','disabled');
    $('#consignatario' + numeroId).attr('disabled','disabled');

  }

}


/*=============================================
CARGAR TROPA SEGUN PROVEEDOR
=============================================*/


function generarTropas(id,tabla){
  
  var numeroId = id.substr(-1);
  var tropa = $('#tropa' + numeroId).val();

  console.log(tabla);

  var proveedor = $('#proveedor' + numeroId).val();
  
  if(proveedor == 'Proveedor'){

    $('#consignatario' + numeroId).removeAttr('disabled');


  }

    
  if (proveedor != 'Proveedor') {
    $('#consignatario' + numeroId).attr('disabled','disabled');

  }

  
  // AJAX
  var datos = 'proveedor=' + proveedor + '&tabla=' + tabla;
  $.ajax({
    
    url: "ajax/cargarTropaProveedores.ajax.php",
    
    method: "POST",
    
    data: datos,
    
    success: function(respuesta){

      $('#tropa' + numeroId).html(respuesta);

    }

  });

}

/*=============================================
CARGAR SEGUN CONSIGNATARIO
=============================================*/

function generarProveedores(id,tabla){
  
  var numeroId = id.substr(-1);
  // var tropa = $('#tropa' + numeroId).val();

  var consignatario = $('#consignatario' + numeroId).val();

  console.log(tabla);

  // if(proveedor == 'Proveedor'){

  //   $('#consignatario' + numeroId).removeAttr('disabled');


  // }

    
  // if (proveedor != 'Proveedor') {
  //   $('#consignatario' + numeroId).attr('disabled','disabled');

  // }

  
  // AJAX
  var datos = 'consignatario=' + consignatario + '&tabla=' + tabla;


  $.ajax({
    
    url: "ajax/cargarTropaConsignatario.ajax.php",
    
    method: "POST",
    
    data: datos,
    
    success: function(respuesta){

      $('#proveedor' + numeroId).html(respuesta);

    }

  });

}


/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("capturarRango") != null){

	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));


}else{

	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn').daterangepicker(
  {
    ranges   : {

    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('DD/MM/Y') + ' - ' + end.format('DD/MM/YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    localStorage.setItem('rango', fechaInicial + '/' + fechaFinal);
    var capturarRango = $("#daterange-btn span").html();


  }

)

$('#daterange-btnCompras').daterangepicker(
  {
    ranges   : {

    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btnCompras span').html(start.format('d/m/Y') + ' - ' + end.format('DD/MM/YYYY'));

    var fechaInicial = start.format('YYYY-MM-d');

    var fechaFinal = end.format('YYYY-MM-d');

    localStorage.setItem('rangoCompras', fechaInicial + '/' + fechaFinal);
    var capturarRango = $("#daterange-btnCompras span").html();


  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
  localStorage.clear();
  $('#daterange-btn').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

});



