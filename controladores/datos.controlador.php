<?php
class ControladorDatos{



	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function ctrMostrarDatos($item, $valor,$orden){

		$tabla = "animales";

		$respuesta = ModeloDatos::MdlMostrarDatos($tabla, $item, $valor,$orden);

		return $respuesta;
	}

	/*=============================================
	CONTAR DATOS
	=============================================*/

	static public function ctrContarDatos($item, $valor,$item2, $valor2, $operador){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarDatos($tabla, $item, $valor,$item2, $valor2, $operador);

		return $respuesta;
	
	}

	
	static public function ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarDatosRango($tabla, $item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR TROPAS
	=============================================*/


	static public function ctrMostrarTropas($variable,$item, $valor){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlMostrarTropas($tabla,$variable, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/


	static public function ctrContarDiasTropa($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarDiasTropa($tabla, $item, $valor);
		return $respuesta;
	
	}

	/*=============================================
	CONTAR ANIMALES
	=============================================*/


	static public function ctrContarAnimales($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarAnimales($tabla, $item, $valor);
		return $respuesta;
	
	}


	/*=============================================
	SUMAR CAMPO
	=============================================*/

	static public function ctrSumarCampo($item, $valor,$campo){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarCampo($tabla, $item, $valor,$campo);
		return $respuesta;
	
	}

	static public function ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarCampoRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

	static public function ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarCampoOperadorRango($tabla, $item, $valor,$campo,$operador,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

	
	static public function ctrSumarAlimento($item,$valor,$item2,$valor2,$campo,$operador){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarAlimento($tabla, $item,$valor,$item2,$valor2,$campo,$operador);
		return $respuesta;
	
	}





















	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

						  	return;

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}


}
	


