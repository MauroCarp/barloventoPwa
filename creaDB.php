<?php
define('MYSQL_SERVIDOR','localhost');
define('MYSQL_USUARIO','root');
define('MYSQL_CONTRASENA','');
define('MYSQL_BD','hoteleria');
$conexion = mysqli_connect(MYSQL_SERVIDOR, MYSQL_USUARIO, MYSQL_CONTRASENA, MYSQL_BD);


$tablas = array();
$tablas['VARCHAR(50)'] = array('hotelero','caravana','categoria','raza','tropa','motivo','destinoVenta','actividad','cab','kgIngreso','kgSalida','kgProd','dias','advp','convMS','kgI','kgE','dias2','kgP','adpv3','CMS','kgI4','kgE5','dias6','kgP7','Adpv8','CMS9','kgI10','kgE11','dias12','kgP13','adpv14','CMS15','convTC','totalKgTC','totalKgMS','costoKG','costoCompra','otrosCompra','total','total$Consumo','total$Estructura','ingresoVenta','gastoVenta','margen','margenKilo','transaccion','kilosCarcasaIngreso','kilos3raBalanza','kilosCarne4ta','dressing','ADPC','convMSCarcasa','establecimiento','consignatario','proveedor','localidad','provincia','estadoProduccion','tipoOperacion','estadoEgreso','estadoIngreso','clasificacion','sexo','trazadoSino','zona','columna16');

$tablas['INT(4)'] = array('anio');
$tablas['DATE'] = array('fechaIngreso','fechaSalida','fechaRomaneo');
$sql = "CREATE TABLE animales (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY";
foreach ($tablas as $tipo => $campos) {
	if (sizeof($campos) > 1) {
		for ($i=0; $i < sizeof($campos) ; $i++) { 
			$sql = $sql.', '.$campos[$i].' '.$tipo.' NULL';
		}
	}
}
$sql = $sql.')';
mysqli_query($conexion,$sql);
echo mysqli_error($conexion);
?>