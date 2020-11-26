<?php

$colores = array('red','blue','green','yellow','orange','purple','grey');

$colores2 = array('#F5B7B1','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff');

$rango = $_GET['rango'];
$rango = explode('/',$rango);
$fechaInicial = $rango[0];
$fechaFinal = $rango[1];




/*********
           CANTIDAD DE ANIMALES
                            ********/
$item = null;
$valor = null;
$item2 = 'fecha';
$campo = 'cantidad';
$cantidadTotal = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);
/*********
 CANTIDAD DE MACHOS
 ********/

$campo = 'machos';
$cantidadMachos = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);


/*********
 CANTIDAD DE HEMBRAS
 ********/

$campo = 'hembras';
$cantidadHembras = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);



/*********
 CANTIDAD DE ANIMALES Y PRECIO POR CONSIGNATARIO
 ********/
$campo = 'consignatario';
$consignatarios = ControladorDatosCompras::ctrMostrarDatosDistincRango($item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);
if(!empty($consignatarios)){

    $dataAnimalesConsignatario = array();

    $campo = 'cantidad';
    $campo2 = 'precioTotalKg';
    $campo3 = 'machos';
    $campo4 = 'hembras';
    $item = 'consignatario';
    $item2 = 'fecha';

    for ($i=0; $i < sizeof($consignatarios) ; $i++) { 
        
        $consignatario = $consignatarios[$i][0];

        // $consignatario = (strlen($consignatario) > 20) ? substr($consignatario,0,20) : $consignatario;

        $dataAnimalesConsignatario[$i]['nombre'] = $consignatario;

        $cantAnimales = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['animales'] = $cantAnimales[0];

        $precioTotal = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo2,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['precio'] = $precioTotal[0];
    
        $cantMachos = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo3,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['machos'] = $cantMachos[0];

        $cantHembras = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo4,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['hembras'] = $cantHembras[0];


    }


    /*********
     CANTIDAD DE ANIMALES POR PROVEEDOR
    ********/

    $cantidadAnimalesProveedores = '';
    $campo = 'proveedor';
    $item = null;
    $valor = null;
    $item2 = 'fecha';  
    $proveedores = ControladorDatosCompras::ctrMostrarDatosDistincRango($item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);

    $cantAnimalesProveedores = array();

    $item = 'proveedor';

    for ($i=0; $i < sizeof($proveedores) ; $i++) { 
        
        $valor = $proveedores[$i][0];
        
        $proveedor = (strlen($valor) > 20) ? substr($valor,0,20) : $valor;


        $cantAnimalesProveedores[$i]['nombre'] = $proveedor;

        $campo = 'cantidad';
        
        $cantidadAnimales = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);

        $cantAnimalesProveedores[$i]['cantidad'] = $cantidadAnimales[0];

    }

    $arrayProveedorCantidad = array();

    for ($aa=0; $aa < sizeof($cantAnimalesProveedores) ; $aa++) { 
        
        $proveedor = $cantAnimalesProveedores[$aa]['nombre'];
        $cantidad = $cantAnimalesProveedores[$aa]['cantidad'];
        $arrayProveedorCantidad[$proveedor] = $cantidad;

    }      

    arsort($arrayProveedorCantidad);
    $cantidadAnimalesProveedores = '';
    $nombreProveedores = '';

    $contador = 0;
    foreach ($arrayProveedorCantidad as $key => $value) {
        
        if ($contador == 5) {
        break;
        }
        $cantidadAnimalesProveedores = $cantidadAnimalesProveedores."{
            label: '".$key."',
            backgroundColor:'".$colores2[$contador]."',
            borderColor: '".$colores2[$contador]."',
            borderWidth: 1,
            data: [".$value."]
        },";
        
        $nombreProveedores = $nombreProveedores."'".$key."',";
        
        $contador++;
    }

    $cantidadAnimalesProveedores = substr($cantidadAnimalesProveedores,0,-1);
    $nombreProveedores = substr($nombreProveedores,0,-1);

    /*********
     FECHAS ,$/Kg, KgTotalIngreso  DE CADA COMPRA
    ********/
    $item = null;
    $valor = null;
    $campo = 'fecha,kgComprado,precioTotalKg';
    $item2 = 'fecha';

    $data = ControladorDatosCompras::ctrMostrarDatosRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);
    $dataCostos = array();

    $campo = 'precio';

    for ($i=0; $i < sizeof($data) ; $i++) { 

        $fecha = $data[$i][0]; 

        $dataCostos[$i]['fecha'] = "'".formatearFecha($fecha)."'";
        
        $piri = ControladorDatosCompras::ctrBuscarPiri($item2,$fecha,$campo);

        $dataCostos[$i]['piri'] = $piri[0];

        $precioKg = ($data[$i][1] > 0) ? ($data[$i][2] / $data[$i][1]) : 0;

        $dataCostos[$i]['totalKg'] = $data[$i][1];

        $dataCostos[$i]['precioKg'] = number_format($precioKg,2,'.','');

    }

    $cantMachosHembras = $cantidadMachos[0][0].','.$cantidadHembras[0][0];

    $nombresPorConsignatarioResumidos = "'".substr($dataAnimalesConsignatario[0]['nombre'],0,6)."'";

    $nombresPorConsignatario = "'".$dataAnimalesConsignatario[0]['nombre']."'";
    
    $animalesPorConsignatario = $dataAnimalesConsignatario[0]['animales'];
    
    $dataSetAnimalesPorConsignatario = "{
        label: '".$dataAnimalesConsignatario[0]['nombre']."',
        type: 'bar',
        backgroundColor: window.chartColors.".$colores[0].",
        yAxisID: 'B',
        data: [". $dataAnimalesConsignatario[0]['animales']."],
        borderColor: 'white',
        borderWidth: 2
    }";


    $machosPorConsignatario = $dataAnimalesConsignatario[0]['machos'];
    $hembrasPorConsignatario = $dataAnimalesConsignatario[0]['hembras'];

    $hembrasPorConsignatarioPorcentaje = round(porcentaje($dataAnimalesConsignatario[0]['hembras'], $dataAnimalesConsignatario[0]['animales']));
    $machosPorConsignatarioPorcentaje = round(porcentaje($dataAnimalesConsignatario[0]['machos'], $dataAnimalesConsignatario[0]['animales']));
    
    $precioTotalPorConsignatario = $dataAnimalesConsignatario[0]['precio'];
    $precioPromedioTotalPorConsignatario = round($dataAnimalesConsignatario[0]['precio'] / $dataAnimalesConsignatario[0]['animales']);

    $coloresConsignatario = 'window.chartColors.'.$colores[0];


    for ($i=1; $i < sizeof($dataAnimalesConsignatario) ; $i++) { 

        $nombresPorConsignatario = $nombresPorConsignatario.",'".$dataAnimalesConsignatario[$i]['nombre']."'";

        $nombresPorConsignatarioResumidos = $nombresPorConsignatarioResumidos.",'".substr($dataAnimalesConsignatario[$i]['nombre'],0,5)."'";

        $animalesPorConsignatario = $animalesPorConsignatario.','.$dataAnimalesConsignatario[$i]['animales'];

        $dataSetAnimalesPorConsignatario = $dataSetAnimalesPorConsignatario.",{
            label: '".$dataAnimalesConsignatario[$i]['nombre']."',
            type: 'bar',
            backgroundColor: window.chartColors.".$colores[$i].",
            yAxisID: 'B',
            data: [". $dataAnimalesConsignatario[$i]['animales']."],
            borderColor: 'white',
            borderWidth: 2
        }";



        $machosPorConsignatario = $machosPorConsignatario.','.$dataAnimalesConsignatario[$i]['machos'];
        $hembrasPorConsignatario = $hembrasPorConsignatario.','.$dataAnimalesConsignatario[$i]['hembras'];

        $hembrasPorConsignatarioPorcentaje = $hembrasPorConsignatarioPorcentaje.','.round(porcentaje($dataAnimalesConsignatario[$i]['hembras'], $dataAnimalesConsignatario[$i]['animales']));
        $machosPorConsignatarioPorcentaje = $machosPorConsignatarioPorcentaje.','.round(porcentaje($dataAnimalesConsignatario[$i]['machos'], $dataAnimalesConsignatario[$i]['animales']));


        $precioTotalPorConsignatario = $precioTotalPorConsignatario.','.$dataAnimalesConsignatario[$i]['precio'];
        $precioPromedioTotalPorConsignatario = $precioPromedioTotalPorConsignatario.','.round($dataAnimalesConsignatario[$i]['precio'] / $dataAnimalesConsignatario[$i]['animales']);


        $coloresConsignatario = $coloresConsignatario.',window.chartColors.'.$colores[$i];

        
    }


    $fechasCompra = $dataCostos[0]['fecha'];
    $precioKilo = $dataCostos[0]['precioKg'];
    $precioPiri = $dataCostos[0]['piri'];
    $totalKgIng = $dataCostos[0]['totalKg'];


    for ($i=1; $i < sizeof($dataCostos) ; $i++) { 

        
        $fechasCompra = $fechasCompra.','.$dataCostos[$i]['fecha'];

        $precioKilo = $precioKilo.','.$dataCostos[$i]['precioKg'];

        $precioPiri = $precioPiri.','.$dataCostos[$i]['piri'];

        $totalKgIng = $totalKgIng.','.$dataCostos[$i]['totalKg'];


    }


    $dataAnimalesConsignatario = json_encode($dataAnimalesConsignatario);

}

?>
